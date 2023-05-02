<?php

namespace Database\Seeders\Dev;

use App\Models\Expense;
use App\Models\Year;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * @author medilies
     */
    public function run(): void
    {
        $year = Year::where('state', 'current')->first();

        $classrooms = $year->classrooms()->with('classType')->get();

        $expenses = [
            ['name' => 'Scolarité-1-primaire', 'expense_type' => 'Scolarity'],
            ['name' => 'Scolarité-1-moyen', 'expense_type' => 'Scolarity'],
            ['name' => 'Scolarité-1-secondaire', 'expense_type' => 'Scolarity'],
            ['name' => 'Réstauration-1', 'expense_type' => 'Restauration'],
            ['name' => 'Réstauration-2', 'expense_type' => 'Restauration'],
            ['name' => 'Transport-1', 'expense_type' => 'Transport'],
            ['name' => 'Transport-2', 'expense_type' => 'Transport'],
            ['name' => 'Scolarité-2-primaire', 'expense_type' => 'Scolarity'],
            ['name' => 'Scolarité-2-moyen', 'expense_type' => 'Scolarity'],
            ['name' => 'Scolarité-2-secondaire', 'expense_type' => 'Scolarity'],
        ];

        foreach ($expenses as $expense_data) {
            $attachable_classrooms = match (true) {
                strpos($expense_data['name'], 'primaire') !== false => $classrooms->where('classType.cycle_id', 'primaire'),
                strpos($expense_data['name'], 'moyen') !== false => $classrooms->where('classType.cycle_id', 'moyen'),
                strpos($expense_data['name'], 'secondaire') !== false => $classrooms->where('classType.cycle_id', 'secondaire'),
                default => $classrooms,
            };

            $expense = Expense::factory($expense_data)->for($year)->create();

            $expense->classrooms()->attach($attachable_classrooms->pluck('id'));
        }
    }
}
