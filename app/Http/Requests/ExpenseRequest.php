<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'value' => ['required', 'numeric', 'min:0.01'],
            'salary_id' => ['required', 'exists:salaries,id'],
            'category_id' => ['required', 'exists:categories,id']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'value' => $this->formatValue($this->value)
        ]);
    }

    private function formatValue($value)
    {
        if (!is_string($value)) {
            return $value;
        }

        $value = str_replace(',', '', $value);
        return $value;
    }
}
