<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class StudentBoardController extends Controller
{
    /**
     * @author medilies
     */
    public function __invoke(Student $student): View|Factory
    {

        $student->load([
            'user',
            'studentRegistrations' => [
                'classroom' => [
                    'establishmentYear',
                    'classType',
                    'expenses',
                ],
                'studentInterviews',
                'payments',
            ],
            'comments' => [
                'user',
            ],
        ]);

        // TODO ensure last when many regs
        $student->setRelation('latestRegistration', $student->studentRegistrations->last());

        return view('students.board')
            ->with('student', $student);
    }
}
