<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostAttributesResource\Pages;
use App\Filament\Resources\PostAttributesResource\RelationManagers;
use App\Models\PostAttribute;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\TextEntry;

class PostAttributesResource extends Resource
{
    protected static ?string $model = PostAttribute::class;

    protected static ?string $navigationIcon = 'heroicon-m-cog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('unit')
                    ->options(PostAttribute::getUnits())
                    ->allowHtml()
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options(PostAttribute::getTypes())
                    ->required(),
                Forms\Components\TagsInput::make('possible_values')
                    ->placeholder('Enter possible values'),
                Forms\Components\Toggle::make('mandatory')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit')
                    ->formatStateUsing(fn (string $state, PostAttribute $postAttribute): string => __($postAttribute->getUnit()))
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->formatStateUsing(fn (string $state, PostAttribute $postAttribute): string => __($postAttribute->getType()))
                    ->searchable(),
                Tables\Columns\IconColumn::make('mandatory')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
            'index' => Pages\ListPostAttributes::route('/'),
            'create' => Pages\CreatePostAttributes::route('/create'),
            'edit' => Pages\EditPostAttributes::route('/{record}/edit'),
        ];
    }
}
