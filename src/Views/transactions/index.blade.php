@extends('layouts')
@section('contents')
    <div class="flex items-top min-h-screen justify-center items-center">
        <table class="table table-stripped table-responsive">
            <thead>
            <tr>
                <th>Reference</th>
                <th>Debit Account Number</th>
                <th>Debit Amount</th>
                <th>Debit Currency</th>
                <th>Credit Account Number</th>
                <th>Credit Amount</th>
                <th>Credit Currency</th>
                <th>Status</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($response->transactions->data))
                @foreach($response->transactions->data as $transaction)
                    <tr>
                        <td>{{$transaction->reference}}</td>
                        <td>{{$transaction->debit_account_no}}</td>
                        <td>{{$transaction->debit_amount}}</td>
                        <td>{{$transaction->debit_currency_code}}</td>
                        <td>{{$transaction->credit_account_no}}</td>
                        <td>{{$transaction->credit_amount}}</td>
                        <td>{{$transaction->credit_currency_code}}</td>
                        <td>
                            @php  $transaction->status = match ((int) $transaction->status_id) {
                                    1 => 'Created',
                                    2 => 'Submitted',
                                    3 => 'Processing',
                                    4 => 'Success',
                                    5 => 'Error',
                                    6 => 'Cancelled',
                                };
                            @endphp
                            {{$transaction->status}}
                        </td>
                        <td>{{$transaction->type_code}}</td>
                        <td><a href="{{route('transactions.show', ['reference' => $transaction->reference])}}" class="btn btn-sm btn-primary">View</a> </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
