<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    /**
     * @author medilies
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @author medilies
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'value' => ['required', 'numeric', 'min:0'],
            'mondatory' => ['required', 'boolean'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'expense_type' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
        ];
    }
}
