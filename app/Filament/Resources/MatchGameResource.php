<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatchGameResource\Pages;
use App\Filament\Resources\MatchGameResource\RelationManagers;
use App\Models\MatchGame;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MatchGameResource extends Resource
{
    protected static ?string $model = MatchGame::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Match Game')
                    ->description('Kosongkan "Answer" jika jawaban tidak ada di master')
                    ->schema([
                        Forms\Components\Select::make('team_id')
                            ->label('Team')
                            ->relationship('team', 'team_name')
                            ->required(),
                        Forms\Components\Select::make('question_id')
                            ->label('Answer')
                            ->relationship('question', 'answer')
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('team.team_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('information')
                    ->label('Keterangan')
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMatchGames::route('/'),
            'create' => Pages\CreateMatchGame::route('/create'),
            'edit' => Pages\EditMatchGame::route('/{record}/edit'),
        ];
    }
}
