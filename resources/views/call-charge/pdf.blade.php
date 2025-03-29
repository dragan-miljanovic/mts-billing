<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Call Charge PDF</title>
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
<h2>Header Details</h2>
<table>
    <tbody>
    @foreach ($callCharge->header->getAttributes() as $key => $value)
        @if (!in_array($key, ['id', 'headerable_type', 'headerable_id', 'created_at', 'updated_at']))
            <tr>
                <th class="text-capitalize" style="width: 300px">{{ str_replace('_', ' ', $key) }}</th>
                <td>
                    @if (in_array($key, ['ticket_timestamp', 'session_creation_timestamp']) && !is_null($value))
                        {{ \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s') }}
                    @elseif (is_bool($value) || $key === 'success')
                        {{ $value ? 'Yes' : 'No' }}
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

<h2>Call Charge Details</h2>
<table>
    <tbody>
    @foreach ($callCharge->getAttributes() as $key => $value)
        <tr>
            <th class="text-capitalize" style="width: 300px">{{ str_replace('_', ' ', $key) }}</th>
            <td>
                @if (is_numeric($value) && in_array($key, ['call_duration', 'ticket_call_duration', 'charged_duration', 'ticket_charged_duration']))
                    {{ gmdate("H:i:s", $value) }} (hh:mm:ss)
                @elseif (is_numeric($value) && in_array($key, ['charge_amount', 'closing_balance', 'max_call_cost']))
                    {{ number_format($value, 2) }} {{ $callCharge->currency }}
                @elseif (is_bool($value) || in_array($key, ['roaming', 'charge_free_action']))
                    {{ $value ? 'Yes' : 'No' }}
                @elseif (is_string($value) || $key === 'additional_rating_info')
                    {{ wordwrap($value, 50, "\n", true) }}
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
