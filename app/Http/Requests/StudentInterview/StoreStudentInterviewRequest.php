<?php

namespace App\Http\Requests\StudentInterview;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentInterviewRequest extends FormRequest
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
        $this->errorBag = 'student_interview';
        //

        $full_name_max = config('rules.full_name.max');
        $registration_interview_participant_max = config('rules.registration_interview_participant.max');

        return [
            'student_registration_id' => ['required', 'integer'],
            'schedule' => ['required'],
            // 'participants' => ['required', 'string', "max:$registration_interview_participant_max"],
            'interrogators' => ['required', 'string', "max:$full_name_max"],
            'title' => ['nullable', 'string', 'max:64'],
            'note' => ['nullable', 'string', 'max:512'],
            'type' => ['required'],
            'father' => ['boolean'],
            'mother' => ['boolean'],
        ];
    }
}
