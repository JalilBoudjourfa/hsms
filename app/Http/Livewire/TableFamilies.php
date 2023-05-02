<?php

namespace App\Http\Livewire;

use App\Models\Family;
use Closure;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class TableFamilies extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected $queryString = [
        'tableFilters',
        'tableSortColumn',
        'tableSortDirection',
        'tableSearchQuery' => ['except' => ''],
    ];

    protected function getTableRecordClassesUsing(): ?Closure
    {
        return fn (Family $record) => match ($record->status) {
            default => 'hover:bg-gray-50',
        };
    }

    protected function getTableQuery(): Builder
    {
        return Family::query()
            ->withCount('students')
            ->with([
                'father.user',
                'mother.user',
            ]);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('students_count')->label(__('Children')),

            TextColumn::make('father.user.name')->label(__('Father'))
                ->url(fn (Family $record): string => is_null($record->father) ? '' : route('clients.show', ['client' => $record->father->id])),

            TextColumn::make('mother.user.name')->label(__('Mother'))
                ->url(fn (Family $record): string => is_null($record->mother) ? '' : route('clients.show', ['client' => $record->mother->id])),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('show family')
                ->label('')
                ->url(
                    fn (Family $record): string => route('families.board', ['family' => $record->id])
                )
                ->icon('heroicon-s-user-group'),
        ];
    }

    public function render(): View
    {
        return view('livewire.table');
    }
}
