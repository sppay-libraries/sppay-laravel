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
                        <label for="exampleFormControlInput1" class="form-label">Select Recipient Account Code</label>
                        <select class="form-select" name="recipient_account_code"  aria-label="Default select example">
                            <option selected>Select Account Code</option>
                            <option {{old('recipient_account_code') === 'SPP' ? 'selected' : ''}} value="SPP">SPP</option>
                            <option {{old('recipient_account_code') === 'MTN' ? 'selected' : ''}} value="MTN">MTN</option>
                            <option {{old('recipient_account_code') === 'VOD' ? 'selected' : ''}} value="VOD">Telecel</option>
                            <option {{old('recipient_account_code') === 'ALT' ? 'selected' : ''}} value="ATL">AirtelTigo</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter Recipient Account Number</label>
                        <input type="text" name="recipient_account" value="{{old('recipient_account')}}" class="form-control" id="exampleFormControlInput1" placeholder="0556684934">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter First Name</label>
                        <input type="text" name="firstname" value="{{old('firstname')}}" class="form-control" id="exampleFormControlInput1" placeholder="Patrick">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter Last Name</label>
                        <input type="text" name="lastname" value="{{old('lastname')}}" class="form-control" id="exampleFormControlInput1" placeholder="Wilson">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter Address</label>
                        <input type="text" name="address" value="{{old('address')}}" class="form-control" id="exampleFormControlInput1" placeholder="0608 MC Tadi">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter City</label>
                        <input type="text" name="city" value="{{old('city')}}" class="form-control" id="exampleFormControlInput1" placeholder="Tadi">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter Country Code</label>
                        <input type="text" name="country_code" value="{{old('country_code')}}" class="form-control" id="exampleFormControlInput1" placeholder="GH">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter State/Region Code</label>
                        <input type="text" name="state" value="{{old('state')}}" class="form-control" id="exampleFormControlInput1" placeholder="GA">
                    </div>

                    <div class="mb-3">
                        <select class="form-select" name="id_type"  aria-label="Default select example">
                            <option selected>Select ID Type</option>
                            <option {{old('id_type') === 'GH_CARD' ? 'selected' : ''}} value="GHANA_CARD">Ghana Card</option>
                            <option {{old('id_type') === 'Passport' ? 'selected' : ''}} value="Passport">Passport</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter ID Number</label>
                        <input type="text" name="id_number" value="{{old('id_number')}}" class="form-control" id="exampleFormControlInput1" placeholder="1234">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Enter Sender Account Number</label>
                        <input type="number" name="sender_account_number" value="{{old('sender_account_number')}}" class="form-control" id="exampleFormControlInput1" placeholder="1001">
                    </div>


                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Reason For Sending</label>
                        <input type="text" name="reason" value="{{old('reason')}}" class="form-control" id="exampleFormControlInput1" placeholder="Testing">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Reference</label>
                        <input type="text" name="reference" value="{{old('reference')}}" class="form-control" id="exampleFormControlInput1" placeholder="Sample Payment">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
