<?php

namespace App\Http\Livewire;

use App\Models\StudentInterview;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TableInterviews extends Component implements Tables\Contracts\HasTable
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
        return fn (StudentInterview $record) => match ($record->status) {
            default => 'hover:bg-gray-50',
        };
    }

    protected function getTableQuery(): Builder
    {
        return StudentInterview::query()
            ->with([
                'studentRegistration' => [
                    'student' => [
                        'user',
                    ],
                    'classroom' => [
                        'classType',
                        'establishmentYear',
                    ],
                ],
            ]);
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'schedule';
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('schedule')->date('Y M d H:i')->label(__('Date'))
                ->description(
                    fn (StudentInterview $record): string => $record->schedule->diffForHumans()
                )
                ->sortable(),

            TextColumn::make('studentRegistration.student.user.name')->label(__('Student'))
                ->url(
                    fn (StudentInterview $record): string => is_null($record->studentRegistration->student) ? '' : route('students.board', ['student' => $record->studentRegistration->student->id])
                ),

            TextColumn::make('participants')->label(__('Participants')),

            TextColumn::make('interrogators')->label(__('Interrogator')),

            TextColumn::make('studentRegistration.classroom.classType.alias')->label(__('Classroom'))
                ->description(
                    fn (StudentInterview $record): string => $record->studentRegistration->classroom->establishmentYear->establishment_id
                ),

            BadgeColumn::make('conclusion')
                ->enum([
                    'neutral' => __('Neutral'),
                    'positive' => __('Positive'),
                    'negative' => __('Negative'),
                ])
                ->icons([
                    'heroicon-o-question-mark-circle',
                    'heroicon-o-check-circle' => fn ($state): bool => $state === 'positive',
                    'heroicon-o-x-circle' => fn ($state): bool => $state === 'negative',
                    'heroicon-o-exclamation-circle' => fn ($state): bool => $state === 'neutral',
                ])
                ->colors([
                    'primary',
                    'warning' => 'neutral',
                    'danger' => 'negative',
                    'success' => 'positive',
                ]),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            MultiSelectFilter::make('conclusion')
                ->options([
                    null => __('Pending'),
                    'positive' => __('Positive'),
                    'negative' => __('Negative'),
                    'neutral' => __('Neutral'),
                ]),

            Filter::make('schedule')
                ->form([
                    Forms\Components\DatePicker::make('schedule_from')->label(__('Date').':'.__('From')),
                    Forms\Components\DatePicker::make('schedule_until')->label(__('Date').':'.__('Until')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['schedule_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('schedule', '>=', $date),
                        )
                        ->when(
                            $data['schedule_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('schedule', '<=', $date),
                        );
                }),

            Filter::make('today')->label(__('Today'))
                ->query(
                    fn (Builder $query): Builder => $query->whereDate('schedule', Carbon::today()->format('Y-m-d'))
                )
                ->toggle(),

            Filter::make('upcoming')->label(__('Upcoming'))
                ->query(
                    fn (Builder $query): Builder => $query->where('schedule', '>=', Carbon::now())
                )
                ->toggle(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('show family')->label('')->icon('heroicon-s-user-group')
                ->url(
                    fn (StudentInterview $record): string => is_null($record->studentRegistration->student) ? '' : route('families.board', ['family' => $record->studentRegistration->student->family_id])
                ),

            Action::make('edit')->label('')->color('warning')->icon('heroicon-o-pencil')
                ->url(
                    fn (StudentInterview $record): string => route('student-interviews.edit', ['student_interview' => $record->id])
                ),

            Action::make('delete')->label('')->color('danger')->icon('heroicon-o-trash')
                ->action(
                    fn (StudentInterview $record): mixed => $record->delete()
                )
                ->requiresConfirmation(),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('delete')->label(__('delete'))
                ->action(
                    fn (Collection $records) => $records->each->delete()
                )
                ->requiresConfirmation()->deselectRecordsAfterCompletion(),
        ];
    }

    public function render(): View
    {
        return view('livewire.table');
    }
}
