<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseTypeRequest;
use App\Models\ExpenseType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ExpenseTypeController extends Controller
{
    /**
     * @author medilies
     */
    public function create(): View
    {
        return view('expense_types.create');
    }

    /**
     * @author medilies
     */
    public function store(ExpenseTypeRequest $request): RedirectResponse
    {
        ExpenseType::create($request->validated());

        return to_route('expenses.index');
    }
}
