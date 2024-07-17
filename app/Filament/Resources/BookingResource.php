<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
//
    protected static ?string $navigationIcon = 'heroicon-o-phone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('phone')
                    ->tel()->minLength(1)->maxLength(15)
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\Select::make('post_id')
                    ->relationship(
                        'post',
                        'id',
                        modifyQueryUsing: fn(Builder $query) => $query->where(
                            "user_id",
                            "=",
                            auth()->id()
                        ))
                    ->searchable()->label("Post Id")
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextInputColumn::make('phone')->rules(['required', "numeric", 'min_digits:1
', 'max_digits:15'])
                ,
                Tables\Columns\TextInputColumn::make('email')->rules(["required", "email"])
                ,
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('post.id')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters(
                [
                    QueryBuilder::make()->constraints([
                        DateConstraint::make("created_at"),
                        TextConstraint::make('post_id'),
                        TextConstraint::make("phone"),
                        TextConstraint::make("email"),

                        NumberConstraint::make("available_seats"),
                    ]),
                ],
                layout: FiltersLayout::Modal
            )
            ->filtersFormWidth(MaxWidth::FourExtraLarge)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(
                function (Builder $query) {
                    $posts_ids = Post::where("user_id", auth()->id())->pluck('id');
//                    dump($posts_ids, "bookings :", $query->where(
//                        "post_id",
//                        "in", $posts_ids
//                    ));
                    return $query->whereIn(
                        "post_id", $posts_ids
                    );
                }
            );

    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PostRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
