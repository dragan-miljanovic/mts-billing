@php
    use App\Services\Pdf\Enums\PdfTypeEnum;
@endphp

@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-primary"><i class="fa fa-phone"></i> Call Charge Details</h3>
            <div>
                <a href="{{ route('call-charges.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
                <a href="{{ route('generate.pdf', ['type' => PdfTypeEnum::Cdr->value, 'id' => $callCharge->id]) }}"
                   class="btn btn-outline-warning ms-2">
                    <i class="fa fa-file-pdf"></i> Create PDF
                </a>
            </div>
        </div>

        <!-- Card for Header Details -->
        <div class="card shadow-lg mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="fa fa-list-alt"></i> Header Information</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        @foreach ($callCharge->header->getAttributes() as $key => $value)
                            @if (!in_array($key, ['id', 'headerable_type', 'headerable_id', 'created_at', 'updated_at']))
                                <tr>
                                    <th class="text-capitalize" style="width: 300px">{{ str_replace('_', ' ', $key) }}</th>
                                    <td>
                                        @if (in_array($key, ['ticket_timestamp', 'session_creation_timestamp']) && !is_null($value))
                                            {{ \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s') }}
                                        @elseif (is_bool($value) || $key === 'success')
                                            <span class="badge {{ $value ? 'bg-success' : 'bg-secondary' }}">{{ $value ? 'Yes' : 'No' }}</span>
                                        @elseif (is_null($value))
                                            -
                                        @else
                                            {{ $value }}
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Card for CallCharge Details -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fa fa-info-circle"></i> Charge Information</h5>
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
                                        <span
                                            class="badge bg-success">{{ number_format($value, 2) }} {{ $callCharge->currency }}</span>
                                    @elseif (is_bool($value) || in_array($key, ['roaming', 'charge_free_action']))
                                        <span class="badge {{ $value ? 'bg-danger' : 'bg-secondary' }}">
                                            {{ $value ? 'Yes' : 'No' }}
                                        </span>
                                    @elseif (is_null($value))
                                        -
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
