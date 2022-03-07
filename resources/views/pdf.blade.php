@php
    $counter = 1;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        td,
        th {
            height: 30px;
            text-align: center;
            border: #000 solid 1px;
            width: 10%
        }

        h5 {
            font-size: 12px;
            ;
            font-weight: bold;
        }

        table {
            border: 1px solid #000;
            width: 100%
        }

        .date {
            width: 30%
        }
    </style>
    <title>Report</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Amount In €</th>
                <th>Current Amount</th>
                <th>Type</th>
                <th>Operation</th>
                <th>Date</th>
                <th>Charge</th>
                <th>Commission</th>
                <th>Currency</th>
                <th>Rate</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $item)
            <tr>
                <td>{{$counter}}</td>
                <td>{{$item['user_id']}}</td>
                <td>{{number_format($item['amount'])}}</td>
                <td>{{number_format($item['currentAmount'])}}</td>
                <td>{{$item['type']}}</td>
                <td>{{$item['operation']}}</td>
                <td>{{$item['date']}}</td>
                <td>{{number_format($item['charge'])}}</td>
                <td>{{number_format($item['commission'])}}</td>
                <td>{{$item['currency']}}</td>
                <td>{{number_format($item['currencyRate'])}}</td>
            </tr>
            @php
                $counter++;
            @endphp
            @endforeach
        </tbody>
    </table>


</body>

</html>
