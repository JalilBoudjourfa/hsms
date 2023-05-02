<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'class_type_id' => $this->ex_registration_class_type_id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->errorBag = 'student';
        //

        $fname_max = config('rules.fname.max');
        $lname_max = config('rules.lname.max');
        $ar_fname_max = config('rules.ar_fname.max');
        $ar_lname_max = config('rules.ar_lname.max');
        $bday_min = config('rules.bday.min');
        $bday_max = config('rules.bday.max');
        $wilaya_max = config('rules.wilaya.max');
        $bplace_max = config('rules.bplace.max');
        $nationality_max = config('rules.nationality.max');

        $deposition_date_min = config('rules.deposition_date.min');
        $deposition_date_max = config('rules.deposition_date.max');
        $establishment_name_min = config('rules.establishment_name.min');
        $establishment_name_max = config('rules.establishment_name.max');
        $establishment_type_in = config('rules.establishment_type.in');

        $class_types_ids = DB::table('class_types')->pluck('id')->toArray();

        return [
            'fname' => ['required', "max:$fname_max"],
            'lname' => ['required', "max:$lname_max"],
            'ar_fname' => ['nullable', "max:$ar_fname_max"],
            'ar_lname' => ['nullable', "max:$ar_lname_max"],
            'bday' => ['required', 'date', "before:$bday_max", "after:$bday_min"],
            'bwilaya' => ['nullable', 'string', "max:$wilaya_max"],
            'bplace' => ['required', "max:$bplace_max"],
            'email' => ['nullable', 'email'],
            'sex' => ['required', Rule::in(config('rules.sex.in'))],
            'nationality' => ['nullable', "max:$nationality_max"],

            'family_id' => ['required', 'integer'],

            'classroom_id' => ['required', 'integer'], // Rule::in(nonArchivedActiveClassroomsIds)
            'deposition_date' => ['nullable', 'date'],

            'establishment_name' => ['nullable', "min:$establishment_name_min", "max:$establishment_name_max"],
            'establishment_type' => ['nullable', Rule::in($establishment_type_in)],
            'class_type_id' => ['nullable', 'integer', Rule::in($class_types_ids)],
            'ex_est_wilaya' => ['nullable', 'string', "max:$wilaya_max"],
            'ex_registration_class_type_id' => ['nullable', 'integer', Rule::in($class_types_ids)],
            'grade_1' => ['nullable', 'numeric', 'between:0,20'],
            'grade_2' => ['nullable', 'numeric', 'between:0,20'],
            'grade_3' => ['nullable', 'numeric', 'between:0,20'],

            'bultin_1' => ['nullable', 'image'],
            'bultin_2' => ['nullable', 'image'],
            'bultin_3' => ['nullable', 'image'],
        ];
    }

    // unique(['fname', 'lname', 'bday']);
}
