<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Year;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function index(Request $request): View
    {
        $years = Year::all();

        $year_id = $request->input('year') ?? $years->where('state', 'current')->last()->id;

        return view('expenses.index')
            ->with('year_id', $year_id)
            ->with('years', $years->pluck('id'));
    }

    public function create(Year $year)
    {
        $classrooms_by_cycle_by_est = $year->classrooms()
            ->with([
                'classType',
                'establishmentYear',
            ])
            ->get()
            ->groupBy([
                'classType.cycle_id',
                'establishmentYear.establishment_id',
            ]);

        return view('expenses.create')
            ->with('year', $year)
            ->with('classrooms_by_cycle_by_est', $classrooms_by_cycle_by_est)
            ->with('expense_types', ExpenseType::pluck('name'));
    }

    public function store(StoreExpenseRequest $request, Year $year)
    {
        DB::transaction(function () use ($request, $year) {
            $expense = $year->expenses()->create($request->validated());

            if ($request->classrooms) {
                foreach ($request->classrooms as $classroom_id => $is_attached) {
                    if ($is_attached) {
                        $expense->classrooms()->attach($classroom_id);
                    }
                }
            }
        });

        return to_route('expenses.index');
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function edit(Expense $expense)
    {
        $expense->load([
            'classrooms' => [
                'classType',
                'establishmentYear',
            ],
        ]);

        $year = $expense->year;

        $classrooms_by_cycle_by_est = $year->classrooms()
            ->with([
                'classType',
                'establishmentYear',
            ])
            ->get()
            ->groupBy([
                'classType.cycle_id',
                'establishmentYear.establishment_id',
            ]);

        return view('expenses.edit')
            ->with('expense', $expense)
            ->with('classrooms_by_cycle_by_est', $classrooms_by_cycle_by_est)
            ->with('expense_types', ExpenseType::pluck('name'));
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->load('classrooms');

        DB::transaction(function () use ($request, $expense) {
            $expense->update($request->validated());

            if ($request->classrooms) {
                foreach ($request->classrooms as $classroom_id => $is_attached) {
                    if ($is_attached) {
                        if (! $expense->classrooms->where('id', $classroom_id)->count()) {
                            $expense->classrooms()->attach($classroom_id);
                        }
                    } else {
                        if ($expense->classrooms->where('id', $classroom_id)->count()) {
                            $expense->classrooms()->detach($classroom_id);
                        }
                    }
                }
            }
        });

        return to_route('expenses.edit', ['expense' => $expense->id]);
    }
}
