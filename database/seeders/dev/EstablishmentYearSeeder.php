<?php

namespace Database\Seeders\Dev;

use App\Models\Establishment;
use App\Models\EstablishmentYear;
use App\Models\Year;
use Illuminate\Database\Seeder;

class EstablishmentYearSeeder extends Seeder
{
    /**
     * @author medilies
     */
    public function run(): void
    {
        $years = Year::pluck('id');

        $establishments = Establishment::pluck('id');

        foreach ($years as $year) {
            foreach ($establishments as $establishment) {
                EstablishmentYear::factory(['establishment_id' => $establishment, 'year_id' => $year])->create();
            }
        }
    }
}
