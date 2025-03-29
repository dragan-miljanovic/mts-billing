@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-primary"><i class="bi bi-telephone-inbound"></i> Call Charge Details</h3>
            <div>
                <a href="{{ route('call-charges.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Back to List
                </a>
                <a href="" class="btn btn-outline-success ms-2">
                    <i class="bi bi-file-earmark-pdf"></i> Create PDF
                </a>
            </div>
        </div>

        <!-- Card for CallCharge Details -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Charge Information</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        @foreach ($callCharge->getAttributes() as $key => $value)
                            <tr>
                                <th class="text-capitalize">{{ str_replace('_', ' ', $key) }}</th>
                                <td>
                                    @if (is_numeric($value) && in_array($key, ['call_duration', 'ticket_call_duration', 'charged_duration', 'ticket_charged_duration']))
                                        {{ gmdate("H:i:s", $value) }} (hh:mm:ss)
                                    @elseif (is_numeric($value) && in_array($key, ['charge_amount', 'closing_balance', 'max_call_cost']))
                                        <span class="badge bg-success">{{ number_format($value, 2) }} {{ $callCharge->currency }}</span>
                                    @elseif (is_bool($value) || in_array($key, ['roaming', 'charge_free_action']))
                                        <span class="badge {{ $value ? 'bg-danger' : 'bg-secondary' }}">
                                            {{ $value ? 'Yes' : 'No' }}
                                        </span>
                                    @else
                                        {{ $value }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
