@extends('layouts')
@section('contents')
    <div class="container">
        <div class="col-md-8">
            <form method="POST" action="{{$action}}">
                @csrf
                @include('errors')
                <div class="row">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter Amount</label>
                        <input type="number" name="amount" value="{{old('amount')}}" class="form-control" id="exampleFormControlInput1" placeholder="10">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="network"  aria-label="Default select example">
                            <option selected>Select Network</option>
                            <option {{old('network') === 'MTN' ? 'selected' : ''}} value="MTN">MTN</option>
                            <option {{old('network') === 'Telecel' ? 'selected' : ''}} value="Telecel">Telecel</option>
                            <option {{old('network') === 'AT' ? 'selected' : ''}} value="AT">AirtelTigo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter Account Number</label>
                        <input type="number" name="number" value="{{old('number')}}" class="form-control" id="exampleFormControlInput1" placeholder="10">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Reference</label>
                        <input type="text" name="reference" value="{{old('reference')}}" class="form-control" id="exampleFormControlInput1" placeholder="Sample Payment">
                    </div>

                    @if($action === route('payment.send.otp'))
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Enter OTP</label>
                            <input type="text" name="otp" value="{{old('otp')}}" class="form-control" id="exampleFormControlInput1" placeholder="Enter OTP">
                        </div>
                    @endif

                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
