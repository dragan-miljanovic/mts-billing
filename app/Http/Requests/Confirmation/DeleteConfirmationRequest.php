<?php

namespace App\Http\Requests\Confirmation;

use Illuminate\Foundation\Http\FormRequest;

class DeleteConfirmationRequest extends FormRequest
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
            'confirmation' => 'required|integer|exists:confirmations,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'confirmation' => $this->route('confirmation')
        ]);
    }
}
