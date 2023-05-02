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

class ClientControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function index(): void
    {
        $this->authenticate();

        $fams = app()->make(MakeFamilies::class)(10, 0, ['father']);

        $response = $this->get(route('clients.index'))
            ->assertOk();

        foreach ($fams as $fam) {
            $response->assertSee([
                $fam->father->user->name,
                $fam->father->user->email,
                $fam->father->user->primaryPhone?->number,
                $fam->father->profession,
                // $fam->father->address,
                $fam->father->id,
                $fam->father->family_id,
            ]);
        }
    }

    /** @test */
    public function store(): void
    {
        $this->authenticate();

        $fam = Family::factory()->create();
        $user = User::factory()->make();
        $client = Client::factory()->for($fam)->make();
        $phone = Phone::factory()->isPrimary()->make();

        $user_data = collect($user->toArray())->only(['fname', 'lname', 'email'])->toArray();
        $client_data = $client->toArray();
        $number = $phone->number;

        $this->post(
            route('clients.store'),
            $user_data + $client_data + compact('number')
        )
            ->assertRedirect(route('families.board', ['family' => $fam->id]));

        $this->assertOneFullClientOnDb($user_data, $client_data, $number);
    }

    /** @test */
    public function show_and_edit(): void
    {
        $this->authenticate();

        $client = Client::factory()
            ->isFather()
            ->for(Family::factory())
            ->has(
                User::factory()
                    ->has(Phone::factory()->isPrimary())
            )
            ->create();

        $client->load('user.primaryPhone');

        $see = [
            $client->user->name,
            $client->user->email,
            $client->profession,
            $client->user->primaryPhone?->number,
            $client->address,
            $client->id,
            $client->family_id,
        ];

        $this->get(route('clients.show', ['client' => $client->id]))
            ->assertOk()
            ->assertSee($see);

        $this->get(route('clients.edit', ['client' => $client->id]))
            ->assertOk()
            ->assertSee($see);
    }

    /** @test */
    public function update(): void
    {
        $this->authenticate();

        $client = Client::factory()
            ->isFather()
            ->for(Family::factory())
            ->has(
                User::factory()
                    ->has(Phone::factory()->isPrimary())
            )
            ->create();

        $user = User::factory()->make();
        $client2 = Client::factory()->isFather()->make();
        $phone = Phone::factory()->isPrimary()->make();

        $user_update_data = collect($user->toArray())->only(['fname', 'lname', 'email'])->toArray();
        $client_update_data = $client2->toArray();
        $number = $phone->number;

        $this->put(
            route('clients.update', ['client' => $client->id]),
            $client_update_data + $user_update_data + compact('number')
        )
            ->assertRedirect(route('clients.show', ['client' => $client->id]));

        $this->get(route('clients.show', ['client' => $client->id]))
            ->assertOk()
            ->assertSeeText([
                $user_update_data['fname'],
                $user_update_data['lname'],
                $user_update_data['email'],
                $client_update_data['profession'],
                $number,
                $client_update_data['address'],
            ]);

        $this->assertOneFullClientOnDb($user_update_data, $client_update_data, $number);
    }
}
