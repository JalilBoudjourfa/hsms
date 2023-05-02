<?php

namespace App\Http\Requests\StudentComments;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentCommentRequest extends FormRequest
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
            'student_id' => ['required', 'integer'],
            'content' => ['required', 'min:5'],
        ];
    }
}
