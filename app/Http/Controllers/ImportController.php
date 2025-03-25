<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportRequest;

class ImportController extends Controller
{
    public function import(ImportRequest $request): void
    {
        $file = $request->file('file');
        // Read the input data from a text file
        $data = file_get_contents($file);

        // Split the log data into individual records based on the delimiter
        $records = explode("\n", $data);

        dd($records);
    }
}
