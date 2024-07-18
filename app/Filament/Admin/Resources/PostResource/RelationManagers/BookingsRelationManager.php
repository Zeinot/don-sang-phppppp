<?php

namespace App\Filament\Admin\Resources\PostResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'bookings';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('phone')

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
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

            ]);
    }
}
