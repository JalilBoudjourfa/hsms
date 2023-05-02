<?php

namespace App\Http\Livewire;

use App\Models\ExRegistration;
use App\Models\StudentRegistration;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Filament\Tables\Actions\Action;

class TableStudentRegistrationsHistory extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public int $studentId;

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

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableQuery(): Builder
    {
        return StudentRegistration::query()
            ->with([
                'classroom' => [
                    'classType',
                    'establishmentYear',
                ],
                'exRegistration' => [
                    'classType',
                ],
            ])
            ->where('student_id', $this->studentId);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('classroom.establishmentYear.year_id')->label(__('Year')),

            TextColumn::make('classroom.establishmentYear.establishment_id')->label(__('Establishment')),

            TextColumn::make('classroom.classType.alias')->label(__('Classroom'))
                ->url(
                    fn (StudentRegistration $record): string => route('classrooms.registrations', ['classroom' => $record->classroom->id])
                ),

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

            TextColumn::make('exRegistration.classType.alias')->label(__('Previous classroom')),

            TextColumn::make('exRegistration.ex_establishment')->label(__('Previous establishment')),
        ];
    }

    protected function getTableActions(): array
    {
        return [

            Action::make('show inscription')
                ->label('Voir le dossier')
                ->url(fn (StudentRegistration $record): string => route('student-registrations.show',  $record->id)),

        ];
    }

    public function render(): View
    {
        return view('livewire.table');
    }
}
