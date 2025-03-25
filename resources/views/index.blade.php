@extends('layouts.master')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h3>Upload Your File</h3>
            </div>
            <div class="card-body">
                <!-- File upload form -->
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Select a file to upload</label>
                        <input type="file" class="form-control" id="file" name="file">
                        @error('file')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>

@stop
