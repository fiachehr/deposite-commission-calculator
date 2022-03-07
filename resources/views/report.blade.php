@php
$counter = 1;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Report</title>
</head>

<body>
    <div class="container">
        <div class="card  mt-3">
            <h5 class="card-header">Calculate Withdraw's Commission And Deposite's Charge</h5>
            <div class="card-body">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">User ID</th>
                            <th scope="col" class="text-center">Amount In €</th>
                            <th scope="col" class="text-center">Current Amount</th>
                            <th scope="col" class="text-center">Type</th>
                            <th scope="col" class="text-center">Operation</th>
                            <th scope="col" class="text-center">Date</th>
                            <th scope="col" class="text-center">Charge</th>
                            <th scope="col" class="text-center">Commission</th>
                            <th scope="col" class="text-center">Currency</th>
                            <th scope="col" class="text-center">Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $item)
                        <tr>
                            <td>{{$counter}}</td>
                            <td scope="col" class="text-center">{{$item['user_id']}}</td>
                            <td scope="col" class="text-center">{{number_format($item['amount'])}}</td>
                            <td scope="col" class="text-center">{{number_format($item['currentAmount'])}}</td>
                            <td scope="col" class="text-center">{{$item['type']}}</td>
                            <td scope="col" class="text-center">{{$item['operation']}}</td>
                            <td scope="col" class="text-center">{{$item['date']}}</td>
                            <td scope="col" class="text-center">{{number_format($item['charge'])}}</td>
                            <td scope="col" class="text-center">{{number_format($item['commission'])}}</td>
                            <td scope="col" class="text-center">{{$item['currency']}}</td>
                            <td scope="col" class="text-center">{{number_format($item['currencyRate'])}}</td>
                        </tr>
                        @php
                        $counter++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>



</body>

</html>
