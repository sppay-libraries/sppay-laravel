<?php

namespace SPPAY\SPPAYLaravel\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:1',
            'network' => 'required|string',
            'email' => 'required|string|email',
            'reference' => 'required|string',
            'number' => 'required|string',
            'otp' => 'nullable|string',
        ];
    }
}
