<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master';

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Master')
                    ->schema([
                        Forms\Components\Textarea::make('question')
                            ->label('Question')
                            ->required(),
                        Forms\Components\TextInput::make('answer')
                            ->label('Answer')
                            ->required(),
                    ]),
                Forms\Components\TextInput::make('points')
                    ->label('points')
                    ->default(0)
                    ->numeric()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('question')
                    ->searchable()
                    ->limit(20)
                    ->sortable(),
                Tables\Columns\TextColumn::make('answer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('points')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('team.team_name')
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
