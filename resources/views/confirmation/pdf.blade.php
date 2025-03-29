<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Confirmation Details</h2>
<table>
    <tbody>
    @foreach ($confirmation->getAttributes() as $key => $value)
        <tr>
            <th class="text-capitalize" style="width: 300px">{{ str_replace('_', ' ', $key) }}</th>
            <td>
                @if (is_numeric($value) && in_array($key, ['transaction_fee', 'old_value', 'new_value', 'add_amount', 'set_balance', 'closing_balance']))
                    {{ number_format($value, 2) }} {{ $confirmation->currency }}
                @elseif (is_numeric($value) && in_array($key, ['billing_period_start_date', 'billing_period_end_date', 'subscriber_activation_date', 'subscriber_expiry_date']))
                    {{ \Carbon\Carbon::parse($value)->format('Y-m-d') }}
                @elseif (is_bool($value) || in_array($key, ['active_feature', 'fnf_action']))
                    {{ $value ? 'Yes' : 'No' }}
                @else
                    {{ $value }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
