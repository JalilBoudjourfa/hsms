<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InfstructureSeedersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cycles(): void
    {
        $this->assertDatabaseHas('cycles', ['id' => 'moyen']);
        $this->assertDatabaseHas('cycles', ['id' => 'primaire']);
        $this->assertDatabaseHas('cycles', ['id' => 'secondaire']);
    }

    /** @test */
    public function class_types(): void
    {
        $this->assertDatabaseHas('class_types', ['id' => 1, 'cycle_id' => 'primaire', 'name' => 'pre-scolaire']);
        $this->assertDatabaseHas('class_types', ['id' => 2, 'cycle_id' => 'primaire', 'name' => '1re AP']);
        $this->assertDatabaseHas('class_types', ['id' => 3, 'cycle_id' => 'primaire', 'name' => '2e AP']);
        $this->assertDatabaseHas('class_types', ['id' => 4, 'cycle_id' => 'primaire', 'name' => '3e AP']);
        $this->assertDatabaseHas('class_types', ['id' => 5, 'cycle_id' => 'primaire', 'name' => '4e AP']);
        $this->assertDatabaseHas('class_types', ['id' => 6, 'cycle_id' => 'primaire', 'name' => '5e AP']);
        $this->assertDatabaseHas('class_types', ['id' => 7, 'cycle_id' => 'moyen', 'name' => '1re AM']);
        $this->assertDatabaseHas('class_types', ['id' => 8, 'cycle_id' => 'moyen', 'name' => '2e AM']);
        $this->assertDatabaseHas('class_types', ['id' => 9, 'cycle_id' => 'moyen', 'name' => '3e AM']);
        $this->assertDatabaseHas('class_types', ['id' => 10, 'cycle_id' => 'moyen', 'name' => '4e AM']);
        $this->assertDatabaseHas('class_types', ['id' => 11, 'cycle_id' => 'secondaire', 'name' => '1re AS TC sciences et technologie']);
        $this->assertDatabaseHas('class_types', ['id' => 12, 'cycle_id' => 'secondaire', 'name' => '1re AS TC lettres']);
        // $this->assertDatabaseHas('class_types', ['id' => 13, 'cycle_id' => 'secondaire', 'name' => '2e AS sciences expérimentales']);
        $this->assertDatabaseHas('class_types', ['id' => 13, 'cycle_id' => 'secondaire', 'name' => '2e AS sciences experimentales']);
        $this->assertDatabaseHas('class_types', ['id' => 14, 'cycle_id' => 'secondaire', 'name' => '2e AS gestion et economie']);
        $this->assertDatabaseHas('class_types', ['id' => 15, 'cycle_id' => 'secondaire', 'name' => '2e AS math']);
        $this->assertDatabaseHas('class_types', ['id' => 16, 'cycle_id' => 'secondaire', 'name' => '2e AS technique mathematique']);
        // $this->assertDatabaseHas('class_types', ['id' => 17, 'cycle_id' => 'secondaire', 'name' => '2e AS langues étrangères']);
        $this->assertDatabaseHas('class_types', ['id' => 17, 'cycle_id' => 'secondaire', 'name' => '2e AS langues etrangeres']);
        $this->assertDatabaseHas('class_types', ['id' => 18, 'cycle_id' => 'secondaire', 'name' => '2e AS lettres - philosophie']);
        // $this->assertDatabaseHas('class_types', ['id' => 19, 'cycle_id' => 'secondaire', 'name' => '3e AS sciences expérimentales']);
        $this->assertDatabaseHas('class_types', ['id' => 19, 'cycle_id' => 'secondaire', 'name' => '3e AS sciences experimentales']);
        $this->assertDatabaseHas('class_types', ['id' => 20, 'cycle_id' => 'secondaire', 'name' => '3e AS gestion et economie']);
        $this->assertDatabaseHas('class_types', ['id' => 21, 'cycle_id' => 'secondaire', 'name' => '3e AS math']);
        $this->assertDatabaseHas('class_types', ['id' => 22, 'cycle_id' => 'secondaire', 'name' => '3e AS technique mathematique']);
        // $this->assertDatabaseHas('class_types', ['id' => 23, 'cycle_id' => 'secondaire', 'name' => '3e AS langues étrangères']);
        $this->assertDatabaseHas('class_types', ['id' => 23, 'cycle_id' => 'secondaire', 'name' => '3e AS langues etrangeres']);
        $this->assertDatabaseHas('class_types', ['id' => 24, 'cycle_id' => 'secondaire', 'name' => '3e AS lettres - philosophie']);
    }
}
