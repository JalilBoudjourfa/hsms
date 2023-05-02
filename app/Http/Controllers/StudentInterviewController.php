<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentInterview\StoreStudentInterviewRequest;
use App\Http\Requests\StudentInterview\UpdateStudentInterviewRequest;
use App\Models\StudentInterview;
use App\Models\StudentRegistration;

class StudentInterviewController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function index()
    {
        return view('student_interviews.index');
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function store(StoreStudentInterviewRequest $request)
    {
        $reg = StudentRegistration::findOrFail($request->student_registration_id);

        $reg->studentInterviews()->create($request->safe(['schedule', 'interrogators', 'father', 'mother', 'title', 'note', 'type']));

        return to_route('students.board', ['student' => $reg->student_id]);
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function edit(StudentInterview $studentInterview)
    {
        $studentInterview->load([
            'studentRegistration.student.user',
        ]);

        $studentInterview->studentRegistration->student->setRelation('latestRegistration', $studentInterview->studentRegistration);

        $studentInterview->studentRegistration->student->latestRegistration->load(['classroom.classType', 'exRegistration.classType']);

        return view('student_interviews.edit')
            ->with('interview', $studentInterview);
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function update(UpdateStudentInterviewRequest $request, StudentInterview $studentInterview)
    {
        $studentInterview->update($request->validated());

        return back();
    }
}
