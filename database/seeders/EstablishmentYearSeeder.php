<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Establishment;
use App\Models\EstablishmentYear;
use App\Models\Year;

class EstablishmentYearSeeder extends Seeder
{

    public function run(): void
    {
        $years = Year::pluck('id');

        $establishments = Establishment::pluck('id');

        foreach ($years as $year) {
            foreach ($establishments as $establishment) {
                EstablishmentYear::Create(['establishment_id' => $establishment, 'year_id' => $year]);
            }
        }
    }
}
