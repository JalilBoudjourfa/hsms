<?php

namespace Database\Seeders\Dev;

use Database\Seeders\Helpers\MakeFamilies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * @author medilies
     */
    public function run(): void
    {
        app()->make(MakeFamilies::class)(200);
    }
}
