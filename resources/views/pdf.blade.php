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
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        .section-header {
            background-color: #555;
            color: white;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>PDF Report Details</h2>
    <table>
        <tr>
            <th>Attribute</th>
        </tr>
        @foreach($callCharges as $index => $callCharge)
            @foreach($callCharge->getAttributes() as $section => $attribute)
                <tr>
                    @if($index === 0)
                        <th>{{ $section }}</th>
                    @endif
                    <td>{{ $attribute }}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
</div>
</body>
</html>
