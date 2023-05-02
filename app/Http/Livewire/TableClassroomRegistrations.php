<?php

namespace App\Http\Livewire;

use App\Models\StudentRegistration;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class TableClassroomRegistrations extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public int $classroomId;

    protected $queryString = [
        'tableFilters',
        'tableSortColumn',
        'tableSortDirection',
        'tableSearchQuery' => ['except' => ''],
    ];

    protected function getTableRecordClassesUsing(): ?Closure
    {
        return fn (StudentRegistration $record) => match ($record->status) {
            default => 'hover:bg-gray-50',
        };
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 15, 50];
    }

    protected function getTableQuery(): Builder
    {
        return StudentRegistration::query()
            ->with([
                'student' => [
                    'user',
                ],
            ])
            ->where('classroom_id', $this->classroomId);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('student.user.name')->label(__('Name'))
                ->url(
                    fn (StudentRegistration $record): string => route('students.board', ['student' => $record->student->id])
                ),

            TextColumn::make('deposition_date')->label(__('Deposition date'))
                ->sortable(),

            BadgeColumn::make('status')->label(__('Status'))
                ->enum([
                    'pending' => __('Pending'),
                    'accepted' => __('Accepted'),
                    'rejected' => __('Rejected'),
                    'suspended' => __('Suspended'),
                ])
                ->icons([
                    'heroicon-o-question-mark-circle',
                    'heroicon-o-check-circle' => fn ($state): bool => $state === 'acccepted',
                    'heroicon-o-x-circle' => fn ($state): bool => $state === 'rejected',
                    'heroicon-o-x-circle' => fn ($state): bool => $state === 'suspended',
                    'heroicon-o-exclamation-circle' => fn ($state): bool => $state === 'pending',
                ])
                ->colors([
                    'primary',
                    'warning' => 'pending',
                    'success' => 'acccepted',
                    'danger' => 'rejected',
                    'danger' => 'suspended',
                ]),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            MultiSelectFilter::make('status')
                ->options([
                    'pending' => __('Pending'),
                    'accepted' => __('Accepted'),
                    'rejected' => __('Rejected'),
                    'suspended' => __('Suspended'),
                ]),
        ];
    }

    public function render(): View
    {
        return view('livewire.table');
    }
}
