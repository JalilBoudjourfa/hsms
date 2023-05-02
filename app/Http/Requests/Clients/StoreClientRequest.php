<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $this->errorBag = $this->family_title;
        //

        $fname_max = config('rules.fname.max');
        $lname_max = config('rules.lname.max');
        $number_max = config('rules.number.max');
        $number_regex = config('rules.number.regex');
        $cni_max = config('rules.cni.max');
        $address_max = config('rules.address.max');
        $profession_max = config('rules.profession.max');
        $family_title_max = config('rules.family_title.max');
        $family_title_in = config('rules.family_title.in');

        return [
            'fname' => ['required', "max:$fname_max"],
            'lname' => ['required', "max:$lname_max"],
            'number' => ['required', "max:$number_max", "regex:$number_regex", 'unique:phones,number'],
            'home'=>['nullable','unique:clients,home'],
            'whatsapp'=>['nullable','unique:clients,whatsapp'],
            'email' => ['nullable', 'email'],
            'cni' => ['nullable', "max:$cni_max"],
            'address' => ['required', "max:$address_max"],
            'profession' => ['required', "max:$profession_max"],

            'family_id' => ['nullable', 'integer'],
            'family_title' => [Rule::in($family_title_in), "max:$family_title_max"],
        ];
    }
}
