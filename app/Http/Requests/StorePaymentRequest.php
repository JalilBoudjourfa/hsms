<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'paid' => ['required', 'integer'],
            'ez_mode' => ['required', 'boolean'],
            'reduction' => ['integer'],
        ];
    }
}
