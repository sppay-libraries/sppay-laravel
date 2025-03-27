<?php

namespace SPPAY\SPPAYLaravel\Controllers;

use Illuminate\Support\Arr;
use SPPAY\SPPAYLaravel\Requests\TransferRequest;

class TransferController extends Controller
{
    public function index()
    {
        $action = route('validate.account');

        return view('sppay::transfers.index', compact('action'));
    }

    public function validateAccount(TransferRequest $request)
    {
        $payload = [
            "institution_code" => $request->recipient_account_code,
            "account_number" => $request->recipient_account
        ];

        $response = $this->sendRequest('/v1/api/transfers/validate-account', $payload);
        $response = json_decode($response->getBody()->getContents(), true);
        $status = Arr::get($response, 'status');

        if ($status === 'success') {
            session()->flash('success', 'Successfully validated account. Submit to validate transfer.');
            $action = route('validate.transfer');
        } else {
            session()->flash('error', 'Account validation failed.');
            $action = route('validate.account');
        }

        session()->flashInput($request->input());
        return view('sppay::transfers.index')->with('action', $action);
    }

    public function validateTransfer(TransferRequest $request)
    {
        $payload = $this->prepPayload($request);

        $response = $this->sendRequest('/v1/api/transfers/validate', $payload);
        $response = json_decode($response->getBody()->getContents(), true);
        $status = Arr::get($response, 'status');

        if ($status === 'success') {
            session()->flash('success', 'Successfully validated transfer. Proceed to Submit transfer.');
            $action = route('submit.transfer');
        } else {
            session()->flash('error', 'Failed to validate transfer!. ' . $response['message']);
            $action = route('validate.account');
        }

        session()->flashInput($request->input());
        return view('sppay::transfers.index')->with('action', $action);
    }

    public function submitTransfer(TransferRequest $request)
    {
        $payload = $this->prepPayload($request);

        $response = $this->sendRequest('/v1/api/transfers/submit', $payload);
        $response = json_decode($response->getBody()->getContents(), true);
        $status = Arr::get($response, 'status');

        if ($status === 'success') {
            session()->flash('success', 'Transfer is being processed.');
            return redirect()->route('transactions.index');
        } else {
            session()->flash('error', 'Transfer failed. ' . $response['message']);
            session()->flashInput($request->input());
            return back()->withInput($request->input());
        }
    }

    private function prepPayload($request): array
    {
        return [
            "send_account_no" => $request->sender_account_number,
            "amount" => $request->amount,
            "recipient" => [
                "account" => [
                    "code"=> $request->recipient_account_code,
                    "number"=> $request->recipient_account
                ],
                "first_name" => $request->firstname,
                "last_name" => $request->lastname,
                "town_or_city" => $request->city,
                "address" => $request->address,
                "reason_for_sending" => $request->reason,
                "country_code" => $request->country_code,
                "state_or_region_code" => $request->state,
                "id_type" => $request->id_type,
                "id_reference" => $request->id_number,
            ],
            "reference" => $request->reference,
            "callback_url" => config('services.sspay.base_url') . "/v1/sp-pay/webhook"
        ];
    }
}
