<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearSeeder extends Seeder
{
    /**
     * @author medilies
     */
    public function run(): void
    {
        DB::table('years')->insert([
            // ['id' => 2021, 'state' => 'archived', 'created_at' => now()->toDateTimeString()],
            ['id' => 2022, 'state' => 'current', 'created_at' => now()->toDateTimeString()],
            ['id' => 2023, 'state' => 'current', 'created_at' => now()->toDateTimeString()],
        ]);
    }
}
