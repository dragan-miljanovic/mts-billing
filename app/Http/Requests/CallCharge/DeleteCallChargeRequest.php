<?php

namespace App\Http\Requests\CallCharge;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCallChargeRequest extends FormRequest
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
            'call_charge' => 'required|integer|exists:call_charges,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'call_charge' => $this->route('call_charge')
        ]);
    }
}
