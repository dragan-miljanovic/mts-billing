@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary"><i class="bi bi-book"></i> Call Charges</h3>
        </div>

        <!-- Table Card -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-list-task"></i> Call Charges List</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover mb-0">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">Charge Mode</th>
                            <th scope="col">Sequence Total</th>
                            <th scope="col">Imsi</th>
                            <th scope="col">Traffic Type</th>
                            <th scope="col">Tariff</th>
                            <th scope="col">Account Id</th>
                            <th scope="col">Account Type</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($callCharges as $callCharge)
                            <tr>
                                <td>{{ $callCharge->charge_mode }}</td>
                                <td>{{ $callCharge->sequence_total }}</td>
                                <td>{{ $callCharge->imsi }}</td>
                                <td>{{ $callCharge->traffic_type }}</td>
                                <td>{{ $callCharge->tariff }}</td>
                                <td>{{ $callCharge->account_id }}</td>
                                <td>{{ $callCharge->account_type }}</td>
                                <td>
                                    <form action="{{ route('call-charges.destroy', $callCharge->id) }}" method="post" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button title="delete" type="submit" class="btn btn-outline-danger btn-lg">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('call-charges.show', $callCharge->id) }}" title="show"
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
            {{ $callCharges->links('pagination::bootstrap-5') }}
        </div>
    </div>
@stop
