<?php

namespace Tests\Feature\Rules;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhoneTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function fail_creating_new_family_when_client_has_no_number(): void
    {
        $this->authenticate();

        $user = User::factory()->make();
        $client = Client::factory()->isFather()->make();

        $user_data = collect($user->toArray())->only(['fname', 'lname', 'email'])->toArray();
        $client_data = $client->toArray();

        $this->post(
            route('families.store'),
            $client_data + $user_data
        )
            ->assertSessionHasErrors('number', null, 'father')
            ->assertRedirect(url('/'));
    }

    // /** @test */
    // public function can_add_mother_with_no_phone_when_father_already_has_one(): void
    // {
    //     $this->authenticate();

    //     $fam = Family::factory()->has(
    //         Client::factory()
    //             ->isFather()
    //             ->for(
    //                 User::factory()
    //                     ->has(Phone::factory()->isPrimary())
    //             )
    //     )
    //         ->create();

    //     $user = User::factory()->make();
    //     $client = Client::factory()->ismother()->for($fam)->make();

    //     $user_data = collect($user->toArray())->only(['fname', 'lname', 'email'])->toArray();
    //     $client_data = $client->toArray();

    //     $this->post(
    //         route('clients.store'),
    //         $user_data + $client_data
    //     )
    //         ->assertSessionHasNoErrors()
    //         ->assertRedirect(route('families.board', ['family' => $fam->id]));
    // }
}
