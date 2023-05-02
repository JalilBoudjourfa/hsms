<?php

namespace App\Http\Controllers;

use App\Http\Requests\studentComments\StoreStudentCommentRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;

class StudentCommentController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function store(StoreStudentCommentRequest $request): RedirectResponse
    {
        $student = Student::findOrFail($request->student_id);
        $student->comment($request->validated('content'));

        return to_route('students.board', ['student' => $student->id]);
    }
}
