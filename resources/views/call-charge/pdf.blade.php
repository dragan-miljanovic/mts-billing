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

<h2>Call Charge Details</h2>
<table>
    <tbody>
    @foreach ($callCharge->getAttributes() as $key => $value)
        <tr>
            <th class="text-capitalize">{{ str_replace('_', ' ', $key) }}</th>
            <td>
                @if (is_numeric($value) && in_array($key, ['call_duration', 'ticket_call_duration', 'charged_duration', 'ticket_charged_duration']))
                    {{ gmdate("H:i:s", $value) }} (hh:mm:ss)
                @elseif (is_numeric($value) && in_array($key, ['charge_amount', 'closing_balance', 'max_call_cost']))
                    {{ number_format($value, 2) }} {{ $callCharge->currency }}
                @elseif (is_bool($value) || in_array($key, ['roaming', 'charge_free_action']))
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
