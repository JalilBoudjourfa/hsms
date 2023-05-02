<?php

namespace Tests\Feature\Http\Controllers\Users;

use App\Models\Client;
use App\Models\Family;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FamilyBoardControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function invoke(): void
    {
        $this->authenticate();

        $fam = Family::factory()
            ->has(Client::factory()->isFather()
                ->has(
                    User::factory()
                        ->has(Phone::factory()->isPrimary())
                ))
            ->create();

        $fam->load('clients.user.primaryPhone');
        $father = $fam->clients->first();

        $this->get(route('families.board', ['family' => $fam->id]))
            ->assertOk()
            ->assertSeeText([
                'Le père',
                $father->user->fname,
                $father->user->lname,
                $father->user->email,
                $father->user->primaryPhone?->number,
                $father->profession,
                $father->address,
                'Ajouter la mère',
            ]);
    }
}
