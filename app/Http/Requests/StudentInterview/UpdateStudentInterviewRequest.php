<?php

namespace App\Http\Requests\StudentInterview;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentInterviewRequest extends FormRequest
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
        $registration_interview_participant_max = config('rules.registration_interview_participant.max');

        return [
            'schedule' => ['nullable'],
            'participants' => ['nullable', 'string', "max:$registration_interview_participant_max"],
            'title' => ['nullable', 'string', 'max:64'],
            'note' => ['nullable', 'string'],
            'conclusion' => ['nullable', 'string'],
        ];
    }
}
