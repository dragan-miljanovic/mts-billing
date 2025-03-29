<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pdf\GeneratePdfRequest;
use App\Services\Pdf\Contracts\GeneratePdfServiceInterface;
use App\Utils\Contracts\LoggerInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use RuntimeException;

class PdfController extends Controller
{
    public function __construct(
        private GeneratePdfServiceInterface $createPdfServiceInterface,
        private LoggerInterface $logger,
    ) {
        //
    }

    public function generate(GeneratePdfRequest $request): RedirectResponse|Response
    {
        $type = $request->get('type');
        $id = $request->get('id');


        try {
            return $this->createPdfServiceInterface->generatePdf($type, $id);
        } catch (RuntimeException $e) {
            $this->logger ->error('Error while generate pdf: ', ['message' => $e]);

            request()->session()->flash('message', 'Unexpected error, please try again later.');
        }

        return redirect()->back();
    }
}
