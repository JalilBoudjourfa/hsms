<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Dev\ClassroomsAndRoomsSeeder;
use Database\Seeders\EstablishmentSeeder;
use Database\Seeders\Dev\EstablishmentYearSeeder;
use Database\Seeders\Dev\ExpenseSeeder;
use Database\Seeders\Dev\ExpenseTypesSeeder;
use Database\Seeders\Dev\FamilySeeder;
use Database\Seeders\Dev\YearSeeder;
use ElaborateCode\AlgerianEducationSystem\Database\Seeders\AlgerianEducationSystemSeeder;
use ElaborateCode\AlgerianEducationSystem\Database\Seeders\MergePrescolaireIntoPrimaireCycleSeeder;
use ElaborateCode\AlgerianProvinces\Database\Seeders\WilayaSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@admin.com',
            'fname' => 'abdi',
            'lname' => 'Mohammed',
            'password' => Hash::make('123')
        ]);

        $this->call(
            [
                AlgerianEducationSystemSeeder::class,
                MergePrescolaireIntoPrimaireCycleSeeder::class,
                // WilayaSeeder::class,
                // EstablishmentSeeder::class,
                // YearSeeder::class,
                // EstablishmentYearSeeder::class,
                // ClassroomsAndRoomsSeeder::class,
            ]
        );

        if (config('app.env') === 'local') {

            User::factory()->create([
                'email' => 'y@y.y',
            ]);

            User::factory()->count(10)->create();

            $this->call(
                [
                    EstablishmentSeeder::class,
                    YearSeeder::class,
                    EstablishmentYearSeeder::class,
                    ClassroomsAndRoomsSeeder::class,
                    // ExpenseTypesSeeder::class,
                    // ExpenseSeeder::class,
                    // FamilySeeder::class,
                ]
            );
        }
    }
}
