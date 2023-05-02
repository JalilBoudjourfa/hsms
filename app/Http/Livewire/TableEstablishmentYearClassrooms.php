<?php

namespace App\Http\Livewire;

use App\Models\Classroom;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class TableEstablishmentYearClassrooms extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public int $establishmentYearId;

    protected $queryString = [
        'tableFilters',
        'tableSortColumn',
        'tableSortDirection',
        'tableSearchQuery' => ['except' => ''],
    ];

    protected function getTableRecordClassesUsing(): ?Closure
    {
        return fn (Classroom $record) => match ($record->status) {
            default => 'hover:bg-gray-50',
        };
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableQuery(): Builder
    {
        return Classroom::query()
            ->isActive()
            ->with([
                'establishmentYear',
                'classType',
            ])
            ->withRequestsCount()
            ->withCount(['rooms'])
            ->withSum('rooms', 'capacity_min')->withSum('rooms', 'capacity_max')
            ->where('establishment_year_id', $this->establishmentYearId);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('classType.level')->label(__('Level')),

            TextColumn::make('classType.name')->label(__('Classroom'))
                // ->description(
                //     fn (Classroom $record): string => $record->classType->cycle_id
                // )
                ->url(
                    fn (Classroom $record): string => route('classrooms.registrations', ['classroom' => $record->id])
                ),

            TextColumn::make('classType.cycle_id')->label(__('Cycle')),

            TextColumn::make('rooms_count')->label(__('Rooms'))
                ->extraAttributes(['class' => 'font-bold font-mono']),

            TextColumn::make('rooms_sum_capacity_min')->label(__('Min')),

            TextColumn::make('rooms_sum_capacity_max')->label(__('Max'))
                ->extraAttributes(['class' => 'font-bold font-mono']),

            TextColumn::make('student_registrations_count')->label(__('Total'))
                ->extraAttributes(['class' => 'text-primary-500 font-mono']),

            TextColumn::make('student_registrations_count_pending')->label(__('Pending'))
                ->extraAttributes(['class' => 'text-warning-500 font-mono']),

            TextColumn::make('student_registrations_count_accepted')->label(__('Accepted'))
                ->extraAttributes(['class' => 'text-success-500 font-bold font-mono']),

            TextColumn::make('student_registrations_count_refused')->label(__('Rejected'))
                ->extraAttributes(['class' => 'text-danger-500 font-mono']),
        ];
    }

    public function render(): View
    {
        return view('livewire.table');
    }
}
