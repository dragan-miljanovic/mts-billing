<?php

namespace App\Jobs;

use App\Models\ImportLog;
use App\Repositories\Contracts\ConfirmationRepositoryInterface;
use App\Repositories\Contracts\ImportLogRepositoryInterface;
use App\Services\Import\Contracts\ConfirmationMapperInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;
use Throwable;

class ConfImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout = 60;

    /**
     * Indicate if the job should be marked as failed on timeout.
     *
     * @var bool
     */
    public bool $failOnTimeout = true;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 5;

    /**
     * The number of seconds to wait before retrying.
     *
     * Retry after 1 minute, 2 minutes, and 5 minutes
     */
    public array $backoff = [60, 120, 300];

    private ?ImportLog $importLog;

    private int $inserted = 0;
    private int $updated = 0;

    private ImportLogRepositoryInterface $importLogRepository;
    private ConfirmationRepositoryInterface $confirmationRepository;
    private ConfirmationMapperInterface $confirmationMapper;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly UuidInterface $uid,
        private readonly Collection $chunk,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(
        ImportLogRepositoryInterface $importLogRepository,
        ConfirmationRepositoryInterface $confirmationRepository,
        ConfirmationMapperInterface $confirmationMapper,
    ): void
    {
        $this->makeDependenciesVisible($importLogRepository, $confirmationRepository, $confirmationMapper);
        $this->startImport();

        foreach ($this->chunk as $productData) {
            $this->processData($productData);
        }

        $this->endImport();
    }

    private function makeDependenciesVisible(
        ImportLogRepositoryInterface $importLogRepository,
        ConfirmationRepositoryInterface $confirmationRepository,
        ConfirmationMapperInterface $confirmationMapper
    ): void
    {
        $this->importLogRepository = $importLogRepository;
        $this->confirmationRepository = $confirmationRepository;
        $this->confirmationMapper = $confirmationMapper;
    }

    private function startImport(): void
    {
        //TODO if no log throw exception
        $this->importLog = $this->importLogRepository->findOneBy(['uid' => $this->uid]);
        $this->importLogRepository->update($this->importLog, [
            'total_chunks' => $this->importLog->total_chunks - 1,
        ]);
    }

    private function processData(
        array $productData,
    ): void
    {
        $mappedData = $this->confirmationMapper->mapToModel($productData);
        $confInfo = $this->confirmationRepository->updateOrCreate($mappedData);

        if ($confInfo->wasChanged(['updated_at'])) {
            $this->updated++;

            return;
        }

        $this->inserted++;
    }

    private function endImport(): void
    {
        $this->importLogRepository->update($this->importLog, [
            'inserted' => $this->importLog->inserted + $this->inserted,
            'updated' => $this->importLog->updated + $this->updated,
        ]);

        $this->importLog = $this->importLog->fresh();

        if ($this->importLog->total_chunks === 0) {
            //TODO send success notification / create log
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        $this->importLogRepository->update($this->importLog, [
            'total_chunks' => $this->importLog->total_chunks + 1,
        ]);

        //TODO send failed notification / create log
    }
}
