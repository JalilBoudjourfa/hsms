<?php

namespace Tests\Feature\Rules;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CantDisableClassroomThatHasRoomsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function example(): void
    {
        $this->authenticate();

        $classroom = $this->makeClassroom();

        $room = Room::factory()
            ->for($classroom)
            ->for($classroom->establishmentYear)
            ->create();

        $this->post(route('classrooms_states.update', ['establishment_year' => $classroom->establishmentYear->composed_key]), [
            'year_id' => $classroom->establishmentYear->year_id,
            'establishment_id' => $classroom->establishmentYear->establishment_id,
            'classroom' => [$classroom->id => $classroom->id],
            'state' => [$classroom->id => '0'],
        ])
            ->assertRedirect()
            ->assertSessionHasErrors("state.{$classroom->id}");
    }
}
