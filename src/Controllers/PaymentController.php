<?php

namespace SPPAY\SPPAYLaravel\Controllers;

use Illuminate\Support\Arr;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SPPAY\SPPAYLaravel\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function init()
    {
        $action = route('payment.validate');
        return view('sppay::payments.init', compact('action'));
    }

    public function initiate(PaymentRequest $request)
    {
        $payload = $this->prepPayload($request);

        $response = $this->sendRequest('/v1/api/payments/initiate', $payload);
        $response = json_decode($response->getBody()->getContents(), true);

        session()->put('transaction_reference', Arr::get($response, 'transaction.reference'));
        $message = Arr::get($response, 'message');

        if ($message === 'OTP Required') {
            session()->flash('success', 'Payment initiated');
            $action = route('payment.send.otp');
        } elseif ($message === 'Charge attempted') {
            session()->flash('success', 'Check and authorize the payment prompt');
            return redirect()->route('transactions.index');
        } else {
            session()->flash('error', 'Payment validation failed.');
            $action = route('payment.validate');
        }

        session()->flashInput($request->input());
        return view('sppay::payments.init')->with('action', $action);
    }

    public function validate(PaymentRequest $request)
    {
        $payload = $this->prepPayload($request);

        $response = $this->sendRequest('/v1/api/payments/validate', $payload);
        $response = json_decode($response->getBody()->getContents(), true);
        $status = Arr::get($response, 'status');

        if ($status === 'success') {
            session()->flash('success', 'Payment validated. Click on submit to initiate payment.');
            $action = route('payment.init.submit');
        } else {
            session()->flash('error', 'Payment validation failed.');
            $action = route('payment.validate');
        }

        session()->flashInput($request->input());
        return view('sppay::payments.init')->with('action', $action);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function sendOTP(PaymentRequest $request)
    {
        $payload = [
            "otp" => $request->input('otp'),
            "transaction_reference" => session()->get('transaction_reference'),
        ];

        $response = $this->sendRequest('/v1/api/payments/otp/submit', $payload);
        $response = json_decode($response->getBody()->getContents(), true);
        $message = Arr::get($response, 'status');

        if ($message === 'success') {
            session()->flash('success', 'Check and authorize the payment prompt');
            return redirect()->route('transactions.index');
        } else {
            session()->flash('error', 'OTP validation failed.');
            session()->flashInput($request->input());
            return back()->withInput($request->input());
        }
    }

    private function prepPayload($request): array
    {
        return [
            "receive_account_no" => "1001",
            "amount" => $request->get('amount'),
            "payer" => [
                "email" => $request->input('email'),
                "account" => [
                    "code" => $request->input('network'),
                    "number" => $request->input('number')
                ]
            ],
            "reference" => $request->input('reference'),
            "callback_url" => config('services.sspay.base_url') . "/v1/sp-pay/webhook"
        ];
    }
}
