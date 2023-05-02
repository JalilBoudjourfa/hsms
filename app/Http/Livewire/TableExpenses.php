<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use Closure;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class TableExpenses extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public int $year_id;

    protected $queryString = [
        'tableFilters',
        'tableSortColumn',
        'tableSortDirection',
        'tableSearchQuery' => ['except' => ''],
    ];

    protected function getTableRecordClassesUsing(): ?Closure
    {
        return fn (Expense $record) => match ($record->status) {
            default => 'hover:bg-gray-50',
        };
    }

    protected function getTableQuery(): Builder
    {
        return Expense::query()
            ->where('year_id', $this->year_id)
            ->with([
                'classrooms' => [
                    'classType',
                    'establishmentYear',
                ],
            ]);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('year_id')->label(__('Year'))
                ->searchable()->sortable(),

            TextColumn::make('name')->label(__('Name'))
                ->searchable()->sortable(),

            TextColumn::make('value')->money('DZD', true)->label(__('Value')),

            BooleanColumn::make('mondatory')->label(__('Mondatory')),

            TextColumn::make('start_date')->date('Y M d')->label(__('Start'))
                ->description(
                    fn (Expense $record): string => $record->start_date->diffForHumans()
                ),

            TextColumn::make('end_date')->date('Y M d')->label(__('End'))
                ->description(
                    fn (Expense $record): string => $record->end_date->diffForHumans()
                ),

            TagsColumn::make('classrooms_arr')->label(__('Classroom').'s')->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            // TODO: this|next|previous year expenses
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('edit')->label('')->color('warning')->icon('heroicon-o-pencil')
                ->url(
                    fn (Expense $record): string => route('expenses.edit', ['expense' => $record->id])
                ),

            Action::make('delete')->label('')->color('danger')->icon('heroicon-o-trash')
                ->action(
                    fn (Expense $record): mixed => $record->delete()
                )
                ->requiresConfirmation(),
        ];
    }

    public function render(): View
    {
        return view('livewire.table');
    }
}
