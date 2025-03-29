<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            background: #fff;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            page-break-inside: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>PDF Report Details</h2>
    <h3>Call Charge</h3>
    @php
        $columnsPerPage = 53; // Adjust based on paper size
        $attributes = array_keys($callCharges[0]->getAttributes());
        $totalAttributes = count($attributes);
        $pages = ceil($totalAttributes / $columnsPerPage);
    @endphp

    @for ($page = 0; $page < $pages; $page++)
        @if ($page > 0)
            <div class="page-break"></div>
        @endif
        <table>
            <thead>
            <tr>
                <th>Attribute</th>
                @foreach($callCharges as $index => $callCharge)
                    <th>Column {{ $index + 1 }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach(array_slice($attributes, $page * $columnsPerPage, $columnsPerPage) as $attribute)
                <tr>
                    <th style="width: 200px">{{ $attribute }}</th>
                    @foreach($callCharges as $callCharge)
                        <td>{{ wordwrap($callCharge[$attribute], 30, "<br>\n", true) }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    @endfor

    <h3>Confirmation</h3>
    @php
        $columnsPerPage = 35; // Adjust based on paper size
        $attributes = array_keys($confirmations[0]->getAttributes());
        $totalAttributes = count($attributes);
        $pages = ceil($totalAttributes / $columnsPerPage);
    @endphp

    @for ($page = 0; $page < $pages; $page++)
        @if ($page > 0)
            <div class="page-break"></div>
        @endif
        <table>
            <thead>
            <tr>
                <th>Attribute</th>
                @foreach($confirmations as $index => $callCharge)
                    <th>Column {{ $index + 1 }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach(array_slice($attributes, $page * $columnsPerPage, $columnsPerPage) as $attribute)
                <tr>
                    <th style="width: 200px">{{ $attribute }}</th>
                    @foreach($confirmations as $callCharge)
                        <td>{{ wordwrap($callCharge[$attribute], 30, "<br>\n", true) }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    @endfor
</div>
</body>
</html>
