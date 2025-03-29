@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-primary"><i class="bi bi-file-earmark-check"></i> Confirmation Details</h3>
            <div>
                <a href="{{ route('confirmations.index') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
                <a href="" class="btn btn-outline-warning ms-2">
                    <i class="fa fa-file-pdf-o"></i> Create PDF
                </a>
            </div>
        </div>

        <!-- Card for Confirmation Details -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Confirmation Information</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        @foreach ($confirmation->getAttributes() as $key => $value)
                            <tr>
                                <th class="text-capitalize">{{ str_replace('_', ' ', $key) }}</th>
                                <td>
                                    @if (is_numeric($value) && in_array($key, ['transaction_fee', 'old_value', 'new_value', 'add_amount', 'set_balance', 'closing_balance']))
                                        <span class="badge bg-success">{{ number_format($value, 2) }} {{ $confirmation->currency }}</span>
                                    @elseif (is_numeric($value) && in_array($key, ['billing_period_start_date', 'billing_period_end_date', 'subscriber_activation_date', 'subscriber_expiry_date']))
                                        {{ \Carbon\Carbon::parse($value)->format('Y-m-d') }}
                                    @elseif (is_bool($value) || in_array($key, ['active_feature', 'fnf_action']))
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
