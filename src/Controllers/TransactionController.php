<?php

namespace SPPAY\SPPAYLaravel\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use SPPAY\SPPAYLaravel\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $endpoint = '/v1/api/transactions';
        $response = $this->fetchData($endpoint);
        $response = json_decode($response->getBody()->getContents());
        $this->storeTransactions($response);

        return view('sppay::transactions.index', compact('response'));
    }

    public function show(Request $request)
    {
        $endpoint = "/v1/api/transactions/{$request->reference}";
        $response = $this->fetchData($endpoint);
        $response = json_decode($response->getBody()->getContents(), true);
        $transaction = Arr::except($response['transaction'], ['status_history']);

        $endpoint = "/v1/api/transactions/{$request->reference}/status";
        $response = $this->fetchData($endpoint);
        $response = json_decode($response->getBody()->getContents(), true);
        $transaction['status'] = Arr::get($response, 'transaction_status.name');
        return view('sppay::transactions.show', compact('transaction'));
    }

    private function storeTransactions($response): void
    {
        if(count($response->transactions->data) > 0) {
            foreach($response->transactions->data as $transaction) {
                Transaction::updateOrCreate(['reference' => $transaction->reference],(array) $transaction);
            }
        }
    }
}
