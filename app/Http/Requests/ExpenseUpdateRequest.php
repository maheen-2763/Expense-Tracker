<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseUpdateRequest extends FormRequest
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
        'title' => ['sometimes','required', 'string', 'max:255'],
        'amount' => ['sometimes','required', 'numeric', 'min:0.01', 'max:999999.99'],
        'type' => ['sometimes','required', 'in:income,expense'],
        'date' => ['sometimes','required', 'date', 'before_or_equal:today'],
    ];
}

public function messages(): array
{
    return [
        'title.required' => 'Please enter a title.',
        'amount.required' => 'Please enter an amount.',
        'amount.numeric' => 'Amount must be a valid number.',
        'amount.min' => 'Amount must be at least 0.01.',
        'type.required' => 'Please select a type.',
        'type.in' => 'Type must be income or expense.',
        'date.required' => 'Please select a date.',
        'date.before_or_equal' => 'Date cannot be in the future.',
    ];
}

protected function prepareForValidation()
{
    $this->merge([
        'title' => trim($this->title),
    ]);
}
    
}
