<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Services\Import\ImportService;
use App\Exceptions\ImportException;
use App\Utils\Contracts\LoggerInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{

    public function import(
        LoggerInterface $logger,
        ImportService $importService,
        ImportRequest $request
    ): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $file = $request->file('file');

            $importService->import($file);
        } catch (ImportException $e) {
            DB::rollBack();

            $logger ->error('Error while getting authors: ', ['message' => $e]);

            request()->session()->flash('message', 'Unexpected error, please try again later.');
        }

        DB::commit();

        request()->session()->flash('message', 'Import successfully ended.');

        return redirect()->back();
    }
}
