<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ClassroomRegistrationsController extends Controller
{
    /**
     * @author medilies
     */
    public function __invoke(int $classroom_id): View|Factory
    {
        /** @var Classroom */
        $classroom = Classroom::with([
            'establishmentYear',
            'classType',
        ])
            ->withRequestsCount()
            ->withSum('rooms', 'capacity_min')->withSum('rooms', 'capacity_max')
            ->find($classroom_id);

        return view('classrooms.registrations')
            ->with('classroom', $classroom);
    }
}
