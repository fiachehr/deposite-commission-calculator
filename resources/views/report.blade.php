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
                            <th scope="col">#</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Type</th>
                            <th scope="col">Operation</th>
                            <th scope="col">Date</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Commission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $item)
                        <tr>
                            <td>{{$counter}}</td>
                            <td scope="col">{{$item['user_id']}}</td>
                            <td scope="col">{{$item['amount']}}</td>
                            <td scope="col">{{$item['type']}}</td>
                            <td scope="col">{{$item['operation']}}</td>
                            <td scope="col">{{$item['date']}}</td>
                            <td scope="col">{{$item['charge']}}</td>
                            <td scope="col">{{$item['commission']}}</td>
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
