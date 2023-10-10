<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostImageResource\RelationManagers\ImagesRelationManager;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Category;
use App\Models\Country;
use App\Models\Post;
use App\Models\PostType;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->required()
                    ->options(Category::pluck('name', 'id')),
                Forms\Components\Select::make('type_id')
                    ->label('Post type')
                    ->required()
                    ->options(PostType::pluck('type', 'id')),
                Forms\Components\Select::make('country_id')
                    ->label('Country')
                    ->required()
                    ->options(Country::pluck('name', 'id')),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('active')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\Toggle::make('price_negotiable')
                    ->required(),
                Forms\Components\TextInput::make('attributes')->nullable(),
                Forms\Components\DatePicker::make('available_from'),
                Forms\Components\DatePicker::make('available_until'),
                Forms\Components\DateTimePicker::make('last_renewed_on'),
                Forms\Components\FileUpload::make('featured_image')
                    ->disk('s3')
                    ->directory('posts')
                    ->visibility('private')
                    ->image()
                    ->columnSpanFull()
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend(Carbon::now()->timestamp . '-')),
                Forms\Components\FileUpload::make('additional_images')
                    ->disk('s3')
                    ->directory('posts')
                    ->visibility('private')
                    ->multiple()
                    ->minFiles(1)
                    ->maxFiles(10)
                    ->image()
                    ->columnSpanFull()
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend(Carbon::now()->timestamp . '-'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (string $state, Post $post): string => __($post->user->name)),
                Tables\Columns\TextColumn::make('category')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn (string $state, Post $post): string => __($post->category->name)),
                Tables\Columns\TextColumn::make('type')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn (string $state, Post $post): string => __($post->type->type)),
                Tables\Columns\TextColumn::make('country')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->formatStateUsing(fn (string $state, Post $post): string => __($post->getStatus())),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\IconColumn::make('price_negotiable')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('available_from')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('available_until')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('last_renewed_on')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->options(Category::pluck('name', 'id'))
                    ->multiple()
                    ->label('Category'),
                Tables\Filters\SelectFilter::make('type_id')
                    ->options(PostType::pluck('type', 'id'))
                    ->multiple()
                    ->label('Type'),
                Tables\Filters\SelectFilter::make('active')
                    ->options([0, 1])
                    ->label('Active'),
                Tables\Filters\SelectFilter::make('status')
                    ->options(Post::getStatuses())
                    ->label('Status'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                Tables\Filters\Filter::make('available_from')
                    ->form([
                        DatePicker::make('available_from'),
                        DatePicker::make('available_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['available_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('available_from', '>=', $date),
                            )
                            ->when(
                                $data['available_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('available_until', '<=', $date),
                            );
                    })
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
            ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
