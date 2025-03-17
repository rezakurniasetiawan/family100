<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Team;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeamResource\Pages;
use Filament\Notifications\Notification;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master';

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'user');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('team_name')
                    ->label('Team Name')
                    ->required(),
                Forms\Components\TextInput::make('score')
                    ->label('Score')
                    ->numeric()
                    ->disabled()
                    ->default(0),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            // ->columns([])
            ->columns([
                Stack::make([
                    Tables\Columns\TextColumn::make('team_name')
                        ->searchable()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('score')
                        ->searchable()
                        ->badge()
                        ->color('primary')
                        ->sortable(),
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Reduce Score')
                    ->button()
                    ->requiresConfirmation()
                    ->color('primary')
                    ->modalHeading('Reduce Score')
                    ->modalDescription('Enter the amount you want to reduce from this team\'s score.')
                    ->modalSubmitActionLabel('Reduce')
                    ->icon('heroicon-o-minus-circle')
                    ->form([
                        Forms\Components\TextInput::make('reduction')
                            ->label('Score Reduction')
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->decrement('score', $data['reduction']);
                        Notification::make()
                            ->success()
                            ->title('Success')
                            ->body('Score has been successfully reduced!')
                            ->send();
                    }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
