<?php

namespace App\Http\Requests\Pdf;

use App\Services\Pdf\Enums\PdfTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class GeneratePdfRequest extends FormRequest
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
        $types = implode(',', array_column(PdfTypeEnum::cases(), 'value'));

        return [
            'type'  => 'required|string|in:' . $types,
            'id'    => 'required|integer|exists:' . $this->route('type') . ',id',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'type' => $this->route('type'),
            'id' => $this->route('id'),
        ]);
    }
}
