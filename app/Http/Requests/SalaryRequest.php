<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SalaryRequest extends FormRequest
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
            'value' => ['required', 'regex:/^\d{1,4}\.\d{2}$/'],
            'user_id' => ['required', 'exists:users,id']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'value' => $this->formatValue($this->value),
            'user_id' => Auth::id()
        ]);
    }

    private function formatValue($value)
    {
        if (!is_string($value)) {
            return $value;
        }

        $value = str_replace(['.', ','], ['', '.'], $value);
        return $value;
    }
}
