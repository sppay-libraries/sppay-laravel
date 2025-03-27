@extends('layouts')
@section('contents')
    <div class="flex items-top min-h-screen justify-center items-center">
        <table class="table table-stripped table-responsive">
            <tbody>
            @foreach($transaction as $key => $value)
                <tr>
                    <th>{{ucwords(str_replace('_', ' ', $key))}}</th>
                    @if(in_array($key, ['debit_account_institution_logo', 'credit_account_institution_logo']))
                        <td><img src="{{$value}}" width="100px"  alt="logo"/> </td>
                    @elseif(in_array($key, ['created_at', 'updated_at']))
                        <td>{{\Carbon\Carbon::parse($value)->format('D, d F Y')}}</td>
                        <td>{{gettype($value) === 'array' ? json_encode($value) : $value}}</td>
                    @else
                        <td>{{ gettype($value) === 'array' ? json_encode($value) : $value}} </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
