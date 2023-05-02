<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Closure;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class TableClients extends Component implements Tables\Contracts\HasTable
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
        return fn (Client $record) => match ($record->status) {
            default => 'hover:bg-gray-50',
        };
    }

    protected function getTableQuery(): Builder
    {
        return Client::query()
            ->withCount('students')
            ->with([
                'family',
                'user' => [
                    'primaryPhone',
                ],
            ]);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.name')->label(__('Name'))
                ->sortable(['fname', 'lname'])->searchable(['fname', 'lname'])
                ->description(
                    fn (Client $record): string => $record->profession
                )
                ->url(
                    fn (Client $record): string => route('clients.show', ['client' => $record->id])
                ),

            TextColumn::make('family_title')->label(__('Title'))
                ->enum([
                    'father' => __('Father'),
                    'mother' => __('Mother'),
                ]),

            TextColumn::make('students_count')->label(__('Children')),

            TextColumn::make('user.email')->label('E-mail'),

            TextColumn::make('user.primaryPhone.number')->label(__('Phone')),

            TextColumn::make('address')->label(__('Address'))->limit(30)
                ->searchable()->toggleable(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('family_title')
                ->options([
                    'father' => __('Father'),
                    'mother' => __('Mother'),
                ]),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('email')->label('')->icon('heroicon-s-mail')
                ->url(
                    fn (Client $record): string => "mailto:{$record->user->email}?subject=".config('app.CLIENT_NAME')
                ),

            Action::make('phone')->label('')->icon('heroicon-s-phone')
                ->url(
                    fn (Client $record): string => "tel:{$record->user->primaryPhone->number}"
                ),

            Action::make('show family')->label('')->icon('heroicon-s-user-group')
                ->url(
                    fn (Client $record): string => route('families.board', ['family' => $record->family->id])
                ),

            Action::make('edit')->label('')->color('warning')->icon('heroicon-o-pencil')
                ->url(
                    fn (Client $record): string => route('clients.edit', ['client' => $record->id])
                ),

            Action::make('delete')->label('')->color('danger')->icon('heroicon-o-trash')
                ->action(
                    fn (Client $record): mixed => $record->delete()
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

            ExportBulkAction::make()
            // ->exports([
            //     ExcelExport::make()->withFilename('[' . __('Parents_list') . '[' . date('Y-m-d-H-i-s')),

            //     ExcelExport::make()->withColumns([
            //         Column::make('user.name')->heading('User name'),
            //         Column::make('user.email')->heading('Email address'),
            //         Column::make('created_at')->heading('Creation date'),
            //     ]),
            // ])
            ,
        ];
    }

    public function render(): View
    {
        return view('livewire.table');
    }
}
