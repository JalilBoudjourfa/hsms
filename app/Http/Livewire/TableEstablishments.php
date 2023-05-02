<?php

namespace App\Http\Livewire;

use App\Models\Establishment;
use App\Models\Expense;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class TableEstablishments extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected $queryString = [
        'tableFilters',
        'tableSortColumn',
        'tableSortDirection',
        'tableSearchQuery' => ['except' => ''],
    ];

    protected function getTableQuery(): Builder
    {
        return Establishment::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->label(__('Establishment'))
                ->searchable()->sortable(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [];
    }

    protected function getTableActions(): array
    {
        return [];
    }

    public function render(): View
    {
        return view('livewire.table');
    }
}
