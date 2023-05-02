<?php

namespace Tests\Feature\Http\Controllers\Rooms;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomsCapacitiesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function canRemoveClassroomAffectation(): void
    {
        $this->authenticate();

        $classroom = $this->makeClassroom();

        $room = Room::factory()
            ->for($classroom)
            ->for($classroom->establishmentYear)
            ->create();

        $this->post(route('rooms_capacities.update', ['establishment_year' => $classroom->establishmentYear->composed_key]), [
            'year_id' => $classroom->establishmentYear->year_id,
            'establishment_id' => $classroom->establishmentYear->establishment_id,
            'room' => [$room->id => $room->id],
            'classroom' => [$room->id => '0'],
            'capacity_min' => [$room->id => $room->capacity_min],
            'capacity_max' => [$room->id => $room->capacity_max],
        ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();
    }
}
