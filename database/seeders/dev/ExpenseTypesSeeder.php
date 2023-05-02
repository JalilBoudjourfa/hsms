<?php

namespace Database\Seeders\Dev;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseTypesSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $expense_types = [
            ['name' => 'Scolarity'],
            ['name' => 'Restauration'],
            ['name' => 'Transport'],
        ];

        DB::table('expense_types')->insert($expense_types);
    }
}
