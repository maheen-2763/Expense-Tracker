<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseStoreRequest extends FormRequest
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
        'title' => ['required', 'string', 'max:255'],
        'amount' => ['required', 'numeric', 'min:0.01', 'max:999999.99'],
        'type' => ['required', 'in:income,expense'],
        'date' => ['required', 'date', 'before_or_equal:today'],
    ];
}

public function messages(): array
{
    return [
        'title.required' => 'Please enter a title for the transaction.',
        'amount.required' => 'Please enter an amount.',
        'amount.numeric' => 'Amount must be a valid number.',
        'amount.min' => 'Amount must be at least 0.01.',
        'type.required' => 'Please select a transaction type.',
        'type.in' => 'Type must be either income or expense.',
        'date.required' => 'Please select a date.',
        'date.date' => 'Invalid date format.',
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
