<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
        $ar_fname_max = config('rules.ar_fname.max');
        $ar_lname_max = config('rules.ar_lname.max');
        $bday_min = config('rules.bday.min');
        $bday_max = config('rules.bday.max');
        $bwilaya_max = config('rules.wilaya.max');
        $bplace_max = config('rules.bplace.max');
        $nationality_max = config('rules.nationality.max');

        return [
            'fname' => ['required', "max:$fname_max"],
            'lname' => ['required', "max:$lname_max"],
            'ar_fname' => ['required', "max:$ar_fname_max"],
            'ar_lname' => ['required', "max:$ar_lname_max"],
            'bday' => ['required', 'date', "before:$bday_max", "after:$bday_min"],
            'bwilaya' => ['nullable', "max:$bwilaya_max"],
            'bplace' => ['required', "max:$bplace_max"],
            'email' => ['nullable', 'email'],
            'sex' => ['required', Rule::in(config('rules.sex.in'))],
            'nationality' => ['nullable', "max:$nationality_max"],
        ];
    }
}
