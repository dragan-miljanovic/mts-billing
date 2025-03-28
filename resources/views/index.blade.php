@extends('layouts.master')

@section('content')

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">File Management</h3>
            </div>
            <div class="card-body">
                <!-- File upload form -->
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Select a file to upload</label>
                        <input type="file" class="form-control" id="file" name="file">
                        @error('file')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="submit" class="btn btn-primary me-md-2">
                            <i class="bi bi-upload me-2"></i>Upload File
                        </button>
                    </div>
                </form>

                <!-- PDF Creation Section -->
                <div class="border-top pt-4">
                    <h5 class="mb-3">Generate PDF</h5>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="{{ route('generate.pdf') }}" class="btn btn-outline-success me-md-2">
                            <i class="bi bi-file-earmark-pdf me-2"></i>Create PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
