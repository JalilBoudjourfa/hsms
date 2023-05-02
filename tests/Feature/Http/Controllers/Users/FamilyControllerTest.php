<?php

namespace Tests\Feature\Http\Controllers\Users;

use App\Models\Client;
use App\Models\Family;
use App\Models\Phone;
use App\Models\User;
use Database\Seeders\Helpers\MakeFamilies;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FamilyControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function index(): void
    {
        $this->authenticate();

        $fams = app()->make(MakeFamilies::class)(10);

        $response = $this->get(route('families.index'))
            ->assertOk();

        foreach ($fams as $fam) {
            $response->assertSeeText([
                $fam->father ? $fam->father->user->name : '',
                $fam->mother ? $fam->mother->user->name : '',
                $fam->students->count(),
            ]);
        }
    }

    /** @test */
    public function store(): void
    {
        $this->authenticate();

        $user = User::factory()->make();
        $client = Client::factory()->make();
        $phone = Phone::factory()->isPrimary()->make();

        $user_data = collect($user->toArray())->only(['fname', 'lname', 'email'])->toArray();
        $client_data = $client->toArray();
        $number = $phone->number;

        $this->post(
            route('families.store'),
            $client_data + $user_data + compact('number')
        )
            ->assertRedirect(route('families.board', ['family' => Family::latest('id')->first()->id]));

        $this->assertOneFullClientOnDb($user_data, $client_data, $number);
    }
}
