@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary"><i class="fa fa-book"></i> Confirmations</h3>
        </div>

        <!-- Table Card -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fa fa-list"></i> Confirmation List</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover mb-0">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">Crce Operation</th>
                            <th scope="col">Sequence Total</th>
                            <th scope="col">Imsi</th>
                            <th scope="col">Traffic Type</th>
                            <th scope="col">Tariff</th>
                            <th scope="col">New Tariff</th>
                            <th scope="col">Account Id</th>
                            <th scope="col">Account Type</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($confirmations as $confirmation)
                            <tr>
                                <td>{{ $confirmation->crce_operation }}</td>
                                <td>{{ $confirmation->sequence_total }}</td>
                                <td>{{ $confirmation->imsi }}</td>
                                <td>{{ $confirmation->traffic_type }}</td>
                                <td>{{ $confirmation->tariff }}</td>
                                <td>{{ $confirmation->new_tariff }}</td>
                                <td>{{ $confirmation->account_id }}</td>
                                <td>{{ $confirmation->account_type }}</td>
                                <td>
                                    <form action="{{ route('confirmations.destroy', $confirmation->id) }}" method="post"
                                          style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button title="delete" type="submit" class="btn btn-outline-danger btn-lg">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('confirmations.show', $confirmation->id) }}" title="show"
                                       class="btn btn-outline-info btn-lg">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="" title="pdf" class="btn btn-outline-warning btn-lg">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="mt-3 d-flex justify-content-center">
            {{ $confirmations->links('pagination::bootstrap-5') }}
        </div>
    </div>
@stop
