<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Requests\Rooms\StoreRoomRequest;
use App\Models\Classroom;
use App\Models\EstablishmentYear;

class RoomController extends \App\Http\Controllers\Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function store(StoreRoomRequest $request)
    {
        extract($request->safe(['classroom_id', 'year_id', 'establishment_id']));

        // TODO model route bind
        $establishment_year = EstablishmentYear::where('year_id', $year_id)->where('establishment_id', $establishment_id)->firstOrFail();

        if ($classroom_id) {
            Classroom::findOrFail($classroom_id);
        }

        $establishment_year->rooms()->create($request->validated());

        return back();
    }
}
