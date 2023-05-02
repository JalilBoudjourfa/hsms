<?php

namespace App\Http\Livewire;

use App\Models\EstablishmentYear;
use App\Models\StudentRegistration;
use App\Models\Year;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Panel;

class TableLatestRegistrationGambetta extends Component implements Tables\Contracts\HasTable

{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return StudentRegistration::query()
            ->where('status', 'pending')
            ->whereHas('classroom.establishmentYear', function (Builder $query) {
                $query->where('establishment_id', 'Gambetta');
            })
            ->whereHas('classroom.EstablishmentYear.Year', function (Builder $query) {
                $query->where('state', 'current');
            })
            ->with([
                'classroom' => [
                    'classType',
                    'establishmentYear',
                ],
            ])->orderBy('created_at', 'DESC');
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('student.user.name')->sortable(['fname', 'lname'])->searchable(['fname', 'lname'])
                ->url(fn (StudentRegistration $record): string => route('student-registrations.show',  $record->id)),
            TextColumn::make('classroom.classType.cycle_id')->label('Class'),
            TextColumn::make('exRegistration.classType.alias')->label(__('Previous classroom')),
            TextColumn::make('classroom.classType.alias')->label('Class'),
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
    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    public function render()
    {
        return view('livewire.table-latest-registration-gambetta');
    }
}
