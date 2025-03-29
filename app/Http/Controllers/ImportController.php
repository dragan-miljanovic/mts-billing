<?php

namespace App\Http\Controllers;

use App\Exceptions\ImportException;
use App\Http\Requests\Import\ImportRequest;
use App\Services\Import\ImportService;
use App\Utils\Contracts\LoggerInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ImportController extends Controller
{
    public function index(): View|Application|Factory
    {
        return view('import.index');
    }

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
