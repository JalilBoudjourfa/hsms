<?php

namespace Database\Populators;

use App\Models\Client;
use App\Models\Family;
use App\Models\Phone;
use App\Models\User;

class ClientPopulator
{
    public function populate(string $family_title, Family $fam): Client
    {
        // TODO add nullables
        $fam ??= Family::factory()->create(); // !..

        $is = 'is'.ucfirst(strtolower($family_title));

        $client = Client::factory()->$is()->for($fam)->create();

        $user = User::factory()->for($client, 'profilable')->create();

        $phone = Phone::factory()->isPrimary()->for($user)->create();

        $user->setRelation('primaryPhone', $phone);
        $client->setRelation('user', $user);
        $client->setRelation('family', $fam);
        $fam->setRelation($family_title, $client);

        return $client;
    }
}
