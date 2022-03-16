<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 37px !important;
        }
    </style>
    <title>Commission Fee Calculator</title>
</head>
<body>
    <div class="container">
        <div class="card  mt-3">
            <h5 class="card-header">Calculate Withdraw's Commission And Deposite's Charge</h5>
            <div class="card-body">
                @if (session()->has("data-not-valid"))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Somthing is wrong!</strong> {{session()->get('data-not-valid')}}.
                </div>
                @endif



                {!! Form::open(['method' => 'POST', 'url' => 'calculate' , 'class'=>'row g-3 mt-3' ,"files"=>true]) !!}

                <div class="form-group">
                    {!! Form::label('data', 'How To Calculate Commission?') !!}
                    {!! Form::select('data', ['u' => 'Upload File', 'd' => 'Generate Dummy Data' , 's' => 'Static Dummy
                    Data'], 'u', ['class' => 'select2 form-control', 'tabindex' => '1' ,'id'=>'data']) !!}
                    @error('data')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group" id="upload">
                    {!! Form::label('file', 'Upload CSV File') !!}
                    {!! Form::file('file', ['class' => $errors->has('file') ? 'form-control is-invalid' : 'form-control', 'tabindex' => '2']) !!}
                    @error('file')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" id="count">
                    {!! Form::label('countData', 'How Many Data Rows Do You Need?') !!}
                    {!! Form::number('countData', '1000', ['step' => '500' ,'id' =>
                    'countData', 'tabindex' => '3', 'class' => $errors->has('countData') ?
                    'form-control is-invalid' : 'form-control']) !!}
                    @error('countData')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('freeWithdrawLimit', 'Free Withdraw Limit') !!}
                    {!! Form::number('freeWithdrawLimit', '3', ['id' => 'freeWithdrawLimit', 'tabindex' => '4', 'class'
                    => $errors->has('freeWithdrawLimit') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('freeWithdrawLimit')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('freeWithdrawAmountLimit', 'Free Withdraw Amount Limit') !!}
                    {!! Form::number('freeWithdrawAmountLimit', '1000', ['step' => '500' ,'id' =>
                    'freeWithdrawAmountLimit', 'tabindex' => '5', 'class' => $errors->has('freeWithdrawAmountLimit') ?
                    'form-control is-invalid' : 'form-control']) !!}
                    @error('freeWithdrawAmountLimit')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('depositCharge', 'Deposite Charge') !!}
                    {!! Form::number('depositCharge', '0.03', ['step' => '0.01' ,'id' => 'depositCharge', 'tabindex' =>
                    '6', 'class' => $errors->has('depositCharge') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('depositCharge')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group col-md-6">
                    {!! Form::label('businessWithdrawCommission', 'Business Clients Withdraw') !!}
                    {!! Form::number('businessWithdrawCommission', '0.5', ['step' => '0.1' ,'id' =>
                    'businessWithdrawCommission', 'tabindex' => '7', 'class' =>
                    $errors->has('businessWithdrawCommission') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('businessWithdrawCommission')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    {!! Form::label('privateWithdrawCommission', 'Private Clients Withdraw') !!}
                    {!! Form::number('privateWithdrawCommission', '0.3', ['step' => '0.1' ,'id' =>
                    'privateWithdrawCommission', 'tabindex' => '8', 'class' =>
                    $errors->has('privateWithdrawCommission') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('privateWithdrawCommission')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('export', 'Export Method') !!}
                    {!! Form::select('export', ['h' => 'HTML', 'p' => 'PDF' , 'e' => 'Excel'], 'h', ['class' => 'select2
                    form-control', 'tabindex' => '10']) !!}
                    @error('export')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::submit('Calculate', ['class' => 'btn btn-primary btn-block']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            if($("#data").val() == 'u'){
                $('#upload').css('display','block');
                $('#count').css('display','none');
            }else if($("#data").val() === 'd'){
                $('#upload').css('display','none');
                $('#count').css('display','block');
            }else{
                $('#upload').css('display','none');
                $('#count').css('display','none');
            }

            $("#data").change(function(){
                var selectedItem = this.value;
                if(selectedItem === 'u'){
                    $('#upload').css('display','block');
                    $('#count').css('display','none');
                }else if(selectedItem === 'd'){
                    $('#upload').css('display','none');
                    $('#count').css('display','block');
                }else{
                    $('#upload').css('display','none');
                    $('#count').css('display','none');
                }

            });

        });
    </script>

</body>

</html>
