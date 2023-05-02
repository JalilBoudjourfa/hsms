<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Closure;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TableStudents extends Component implements Tables\Contracts\HasTable
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
        return fn (Student $record) => match ($record->status) {
            default => 'hover:bg-gray-50',
        };
    }

    protected function getTableQuery(): Builder
    {
        return Student::query()
            ->with([
                'user',
                'family',
                'latestRegistration' => [
                    'classroom' => [
                        'classType' => [
                            'cycle',
                        ],
                        'establishmentYear',
                    ],
                ],
            ])
            // for sorting and filtering
            ->select([
                'students.*',
                'class_types.id as class_type_id',
                'class_types.cycle_id',
                'establishment_years.establishment_id',
            ])
            ->leftJoin('student_registrations', 'students.id', '=', 'student_registrations.student_id')
            ->leftJoin('classrooms', 'classrooms.id', '=', 'student_registrations.classroom_id')
            ->leftJoin('class_types', 'class_types.id', '=', 'classrooms.class_type_id')
            // ->latest('student_registrations.student_id')
            ->leftJoin('establishment_years', 'establishment_years.id', '=', 'classrooms.establishment_year_id')
            ->groupBy('students.id');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.name')->label(__('Name'))
                ->sortable(['fname', 'lname'])->searchable(['fname', 'lname'])
                ->url(
                    fn (Student $record): string => route('students.board', ['student' => $record->id])
                ),

            TextColumn::make('arabic_full_name')->label(__('Arabic name'))
                ->sortable(['ar_fname', 'ar_lname']),

            TextColumn::make('sex')->label('')
                ->enum([
                    'male' => __('Boy'),
                    'female' => __('Girl'),
                ]),

            TextColumn::make('bday')->label(__('Birth'))->date('Y-m-d')
                ->description(
                    fn (Student $record): string => "{$record->bplace} ({$record->bwilaya})"
                ),

            TextColumn::make('nationality')->label(__('Nationality'))
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('user.email')->label('E-mail'),

            TextColumn::make('created_at')->date('Y M d')->label(__('Registered on'))
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('latestRegistration.classroom.classType.alias')->label(__('Latest registration'))
                ->description(
                    fn (Student $record): string => "{$record->latestRegistration->classroom->establishmentYear->composed_key} ({$record->latestRegistration->classroom->classType->cycle->id})"
                )
                ->sortable(
                    query: fn (Builder $query, string $direction): Builder => $query->orderBy('class_type_id', $direction)
                ),

            TextColumn::make('latestRegistration.deposition_date')->date('Y M d')->label(__('Deposition date'))
                ->sortable()->toggleable(),

            BadgeColumn::make('latestRegistration.status')->label(__('Status'))
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
            Filter::make('primaire')->label(__('Primaire'))
                ->query(
                    fn (Builder $query): Builder => $query->where('class_types.cycle_id', 'primaire')
                )
                ->toggle(),

            Filter::make('moyen')->label(__('Moyen'))
                ->query(
                    fn (Builder $query): Builder => $query->where('class_types.cycle_id', 'moyen')
                )
                ->toggle(),

            Filter::make('secondaire')->label(__('Secondaire'))
                ->query(
                    fn (Builder $query): Builder => $query->where('class_types.cycle_id', 'secondaire')
                )
                ->toggle(),

            // Filter::make('sabah')->label('sabah')
            //     ->query(
            //         fn (Builder $query): Builder => $query->where('establishment_years.establishment_id', 'sabah')
            //     )
            //     ->toggle(),

            SelectFilter::make('sex')->label('')
                ->options([
                    'male' => __('Boy'),
                    'female' => __('Girl'),
                ]),

            Filter::make('created_at')
                ->form([
                    Forms\Components\DatePicker::make('created_from')->label(__('Created') . ':' . __('From')),
                    Forms\Components\DatePicker::make('created_until')->label(__('Created') . ':' . __('Until')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('students.created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('students.created_at', '<=', $date),
                        );
                }),

            Filter::make('deposition_date')
                ->form([
                    Forms\Components\DatePicker::make('created_from')->label(__('Deposition') . ':' . __('From')),
                    Forms\Components\DatePicker::make('created_until')->label(__('Deposition') . ':' . __('Until')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('student_registrations.deposition_date', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('student_registrations.deposition_date', '<=', $date),
                        );
                }),
            Tables\Filters\TrashedFilter::make(),

        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('email')->label('')->icon('heroicon-s-mail')
                ->url(
                    fn (Student $record): string => "mailto:{$record->user->email}?subject=" . config('app.CLIENT_NAME')
                ),

            Action::make('show family')->label('')->icon('heroicon-s-user-group')
                ->url(
                    fn (Student $record): string => route('families.board', ['family' => $record->family->id])
                ),

            Action::make('edit')->label('')->color('warning')->icon('heroicon-o-pencil')
                ->url(
                    fn (Student $record): string => route('students.edit', ['student' => $record->id])
                ),

            Action::make('delete')->label('')->color('danger')->icon('heroicon-o-trash')
                ->action(
                    fn (Student $record): mixed => $record->delete()
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
            BulkAction::make('delete')->label(__('forcedelete'))
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
