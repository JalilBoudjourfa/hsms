<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassType;
use App\Models\EstablishmentYear;
use App\Models\Year;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EstablishmentYearControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index(): void
    {
        $this->authenticate();

        // TODO insert archived, current and upcoming years
        foreach ($this->establishments as $est) {
            EstablishmentYear::create([
                'establishment_id' => $est,
                'year_id' => $this->upcomingYear,
            ]);
        }

        $this->get(route('establishment-years.index'))
            // Sees not archived years on nav bar
            ->assertSeeTextInOrder(
                [
                    'index des années scolaires',
                    $this->upcomingYear,
                    __('Upcoming'),
                ]
                    +
                    $this->establishments->map(fn ($est) => $this->upcomingYear.' '.$est)->reverse()->toArray()
            );
    }

    /** @test */
    public function store(): void
    {
        $this->authenticate();

        foreach ($this->establishments as $est) {
            $this->post(route('establishment-years.store'), [
                'establishment' => $est,
                'year' => $this->upcomingYear,
            ])
                ->assertRedirect(route('establishment-years.index'));
        }

        // Check creation of all establishment-years
        $this->assertEquals(
            count($this->establishments),
            EstablishmentYear::all()->count()
        );

        // Check creation of classrooms for all establishment-years
        $this->assertEquals(
            count($this->establishments) * ClassType::all()->count(),
            Classroom::all()->count()
        );
    }

    /** @test */
    public function store_fail_for_archived_year(): void
    {
        $this->authenticate();

        $archived_year = Year::factory()->create([
            'id' => $this->upcomingYear - 1,
            'state' => 'archived',
        ]);

        $this->post(route('establishment-years.store'), [
            'establishment' => $this->establishments[0],
            'year' => $archived_year->id,
        ])
            ->assertRedirect()
            ->assertSessionHasErrors(['year_state' => 'selected year state is invalid.']);
    }

    /** @test */
    public function store_fail_not_found_year(): void
    {
        $this->authenticate();

        $this->post(route('establishment-years.store'), [
            'establishment' => $this->establishments[0],
            'year' => $this->upcomingYear + 1,
        ])
            ->assertNotFound();
    }

    /** @test */
    public function store_fail_not_found_establishment(): void
    {
        $this->authenticate();

        $this->post(route('establishment-years.store'), [
            'establishment' => time(),
            'year' => $this->upcomingYear,
        ])
            ->assertNotFound();
    }

    /** @test */
    public function show(): void
    {
        $this->authenticate();

        $est_year = EstablishmentYear::create([
            'year_id' => $this->upcomingYear,
            'establishment_id' => $this->establishments->first(),
        ]);

        $this->get(route('establishment-years.show', ['establishment_year' => $est_year->composed_key]))
            ->assertSee($est_year->composed_key);
    }
}
