<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $fname_max = config('rules.fname.max');
        $lname_max = config('rules.lname.max');
        $number_max = config('rules.number.max');
        $number_regex = config('rules.number.regex');
        $cni_max = config('rules.cni.max');
        $address_max = config('rules.address.max');
        $profession_max = config('rules.profession.max');

        return [
            'fname' => ['required', "max:$fname_max"],
            'lname' => ['required', "max:$lname_max"],
            'number' => [
                'required',
                "max:$number_max", "regex:$number_regex",
            ],
            'email' => ['nullable', 'email'],
            'cni' => ['nullable', "max:$cni_max"],
            'address' => ['required', "max:$address_max"],
            'profession' => ['required', "max:$profession_max"],
        ];
    }
}
