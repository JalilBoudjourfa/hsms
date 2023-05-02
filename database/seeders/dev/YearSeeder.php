<?php

namespace Database\Seeders\Dev;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('years')->insert([
            // ['id' => 2021, 'state' => 'archived', 'created_at' => now()->toDateTimeString()],
            // ['id' => 2022, 'state' => 'archived', 'created_at' => now()->toDateTimeString()],
            ['id' => 2023, 'state' => 'current', 'created_at' => now()->toDateTimeString()],
        ]);
    }
}
