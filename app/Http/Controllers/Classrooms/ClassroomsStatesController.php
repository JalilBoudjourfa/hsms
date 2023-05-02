<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Requests\Classrooms\UpdateClassroomsStatesRequest;
use App\Models\Classroom;
use App\Models\EstablishmentYear;
use Illuminate\Support\Facades\DB;

class ClassroomsStatesController extends \App\Http\Controllers\Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function edit(EstablishmentYear $establishment_year)
    {
        $classroomsByCycle = $establishment_year->classrooms()
            ->with([
                'classType',
                'rooms',
            ])
            ->withCount(['rooms'])
            ->withSum('rooms', 'capacity_min')->withSum('rooms', 'capacity_max')
            ->get()
            ->groupBy(['classType.cycle_id']);

        return view('classrooms_states.edit')
            ->with('establishment_year', $establishment_year)
            ->with('classroomsByCycle', $classroomsByCycle);
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function update(UpdateClassroomsStatesRequest $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->validated()['state'] as $id => $state) {
                $classroom = Classroom::findOrFail($id);

                if ($classroom->active != $state) {
                    $classroom->update(['active' => $state]);
                }
            }
        });

        return back();
    }
}
