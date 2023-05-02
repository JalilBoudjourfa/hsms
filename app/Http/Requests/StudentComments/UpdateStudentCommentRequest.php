<?php

namespace App\Http\Requests\StudentComments;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentCommentRequest extends FormRequest
{
    /**
     * @author medilies
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * @author medilies
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
