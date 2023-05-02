<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Requests\Rooms\UpdateRoomsRequest;
use App\Models\EstablishmentYear;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

/**
 * Handles capacities and classrooms affectation change
 */
class RoomsCapacitiesController extends \App\Http\Controllers\Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function edit(EstablishmentYear $establishment_year)
    {
        $establishment_year->load('rooms.classroom.classType');

        return view('rooms_capacities.edit')
            ->with('establishment_year', $establishment_year)
            ->with(
                'rooms_by_cycle',
                $establishment_year->rooms->groupBy('classroom.classType.cycle_id')
            )
            // ! unoptimized queries
            ->with(
                'active_classrooms',
                $establishment_year->classrooms()->with('classType')->where('active', true)->get()
            );
    }

    /**
     * @author medilies
     */
    public function update(UpdateRoomsRequest $request): RedirectResponse
    {
        extract($request->validated());

        $establishment_year = EstablishmentYear::where('year_id', $year_id)->where('establishment_id', $establishment_id)
            ->firstOrFail();

        $target_rooms = $establishment_year->rooms;

        DB::transaction(function () use ($classroom, $capacity_min, $capacity_max, $target_rooms) {
            foreach ($target_rooms as $room) {
                $classroom_id = $classroom[$room->id];
                $min = $capacity_min[$room->id];
                $max = $capacity_max[$room->id];

                // Update if one thing changes
                if (
                    $room->classroom_id !== $classroom_id || $room->capacity_min !== $min || $room->capacity_max !== $max
                ) {
                    $room->update([
                        'classroom_id' => $classroom_id ? $classroom_id : null,
                        'capacity_min' => $min,
                        'capacity_max' => $max,
                    ]);
                }
            }
        });

        return back();
    }
}
