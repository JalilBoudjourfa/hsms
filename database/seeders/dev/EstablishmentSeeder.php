<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstablishmentSeeder extends Seeder
{
    /**
     * @author medilies
     */
    public function run(): void
    {
        DB::table('establishments')->insert([
            ['id' => 'Sabah'],
            ['id' => 'Gambetta'],
        ]);
    }
}
