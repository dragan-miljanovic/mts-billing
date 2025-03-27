<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;
use App\Services\Import\ImportService;
use App\Exceptions\ImportException;
use App\Utils\Contracts\LoggerInterface;
use Illuminate\Http\RedirectResponse;

class ImportController extends Controller
{

    public function import(
        LoggerInterface $logger,
        ImportService $importService,
        ImportRequest $request
    ): RedirectResponse
    {
        try {
            $file = $request->file('file');

            $importService->import($file);
        } catch (ImportException $e) {

            $logger ->error('Error while getting authors: ', ['message' => $e]);

            request()->session()->flash('message', 'Unexpected error, please try again later. Import Has not started.');
        }

        request()->session()->flash('message', 'Import successfully started.');

        return redirect()->back();
    }
}
