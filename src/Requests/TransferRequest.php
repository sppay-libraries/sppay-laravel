<?php

namespace SPPAY\SPPAYLaravel\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'recipient_account_code' => 'bail|required|string',
            'amount' => 'bail|required|numeric',
            'recipient_account' => 'bail|required|string',
            'firstname' => 'bail|required|string',
            'lastname' => 'bail|required|string',
            'address' => 'bail|required|string',
            'city' => 'bail|required|string',
            'state' => 'bail|required|string',
            'country_code' => 'bail|required|string',
            'id_type' => 'bail|required|string',
            'id_number' => 'bail|required|string',
            'sender_account_number' => 'bail|required|string',
            'reason' => 'bail|required|string',
            'reference' => 'bail|required|string',
        ];
    }
}
