<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers\BookingRelationManager;
use App\Models\Post;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = "heroicon-o-rectangle-stack";

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()
                ->columns(3)
                ->schema([
                    Section::make()
                        ->columnSpan(2)
                        ->description("Collapse Editor")
                        ->schema([
                            Forms\Components\RichEditor::make("eligibility_criteria")
                                ->required()
                                ->minLength(10)
                                ->maxLength(4000)
                        ])->collapsible(),
                    Section::make()
                        ->columns(1)
                        ->columnSpan(1)->collapsible()->description("Collapse Infos")
                        ->schema([
                            DateTimePicker::make("date")
                                ->native(false)
                                ->seconds(false)
                                ->timezone("Africa/Casablanca")
                                ->locale("ma")
                                ->closeOnDateSelection()
                                ->minDate(now())
                                ->maxDate(now()->addYear(1))
                                ->required(),
                            Forms\Components\TextInput::make("available_seats")
                                ->required()
                                ->integer()
                                ->minValue(1)
                                ->maxValue(1000000)
                                ->columnSpan(1),
                            Forms\Components\CheckboxList::make("types")
                                ->options([
                                    "Blood" => "Blood",
                                    "Plasma" => "Plasma",
                                    "Platelets" => "Platelets",
                                ])
                                ->required(),
                        ]),
                    Forms\Components\TextInput::make("address")
                        ->columnSpan(2)
                        ->required()
                        ->minLength(5)
                        ->maxLength(255),
                    Forms\Components\Select::make("city")
                        ->columnSpan(1)
                        ->options([
                            "Marrakech" => "Marrakech",
                            "Oued Zem" => "Oued Zem",
                            "Tangier" => "Tangier",
                            "Sidi Slimane" => "Sidi Slimane",
                            "Errachidia" => "Errachidia",
                            "Guercif" => "Guercif",
                            "Oulad Teïma" => "Oulad Teïma",
                            "Ben Guerir" => "Ben Guerir",
                            "Sale" => "Sale",
                            "Sefrou" => "Sefrou",
                            "Fnidq" => "Fnidq",
                            "Sidi Qacem" => "Sidi Qacem",
                            "Tiznit" => "Tiznit",
                            "Moulay Abdallah" => "Moulay Abdallah",
                            "Youssoufia" => "Youssoufia",
                            "Martil" => "Martil",
                            "Aïn Harrouda" => "Aïn Harrouda",
                            "Souq Sebt Oulad Nemma" => "Souq Sebt Oulad Nemma",
                            "Skhirate" => "Skhirate",
                            "Ouezzane" => "Ouezzane",
                            "Sidi Yahya Zaer" => "Sidi Yahya Zaer",
                            "Rabat" => "Rabat",
                            "Al Hoceïma" => "Al Hoceïma",
                            "M’diq" => "M’diq",
                            "Midalt" => "Midalt",
                            "Azrou" => "Azrou",
                            "Meknès" => "Meknès",
                            "El Kelaa des Srarhna" => "El Kelaa des Srarhna",
                            "Ain El Aouda" => "Ain El Aouda",
                            "Oujda-Angad" => "Oujda-Angad",
                            "Beni Yakhlef" => "Beni Yakhlef",
                            "Ad Darwa" => "Ad Darwa",
                            "Al Aaroui" => "Al Aaroui",
                            "Qasbat Tadla" => "Qasbat Tadla",
                            "Boujad" => "Boujad",
                            "Jerada" => "Jerada",
                            "Kenitra" => "Kenitra",
                            "Mrirt" => "Mrirt",
                            "Agadir" => "Agadir",
                            "El Aïoun" => "El Aïoun",
                            "Azemmour" => "Azemmour",
                            "Temsia" => "Temsia",
                            "Zagora" => "Zagora",
                            "Ait Ourir" => "Ait Ourir",
                            "Aziylal" => "Aziylal",
                            "Tétouan" => "Tétouan",
                            "Sidi Yahia El Gharb" => "Sidi Yahia El Gharb",
                            "Biougra" => "Biougra",
                            "Zaïo" => "Zaïo",
                            "Aguelmous" => "Aguelmous",
                            "El Hajeb" => "El Hajeb",
                            "Casablanca" => "Casablanca",
                            "Zeghanghane" => "Zeghanghane",
                            "Imzouren" => "Imzouren",
                            "Tit Mellil" => "Tit Mellil",
                            "Taourirt" => "Taourirt",
                            "Mechraa Bel Ksiri" => "Mechraa Bel Ksiri",
                            "Temara" => "Temara",
                            "Safi" => "Safi",
                            "Al ’Attawia" => "Al ’Attawia",
                            "Tifariti" => "Tifariti",
                            "Demnat" => "Demnat",
                            "Arfoud" => "Arfoud",
                            "Tameslouht" => "Tameslouht",
                            "Bou Arfa" => "Bou Arfa",
                            "Sidi Smai’il" => "Sidi Smai’il",
                            "Souk et Tnine Jorf el Mellah" =>
                                "Souk et Tnine Jorf el Mellah",
                            "Mehdya" => "Mehdya",
                            "Aïn Taoujdat" => "Aïn Taoujdat",
                            "Chichaoua" => "Chichaoua",
                            "Tahla" => "Tahla",
                            "Oulad Yaïch" => "Oulad Yaïch",
                            "Moulay Bousselham" => "Moulay Bousselham",
                            "Iheddadene" => "Iheddadene",
                            "Missour" => "Missour",
                            "Zawyat ech Cheïkh" => "Zawyat ech Cheïkh",
                            "Bouknadel" => "Bouknadel",
                            "Oulad Tayeb" => "Oulad Tayeb",
                            "Oulad Barhil" => "Oulad Barhil",
                            "Bir Jdid" => "Bir Jdid",
                            "Khénifra" => "Khénifra",
                            "El Jadid" => "El Jadid",
                            "Laâyoune" => "Laâyoune",
                            "Mohammedia" => "Mohammedia",
                            "Kouribga" => "Kouribga",
                            "Béni Mellal" => "Béni Mellal",
                            "Ait Melloul" => "Ait Melloul",
                            "Nador" => "Nador",
                            "Taza" => "Taza",
                            "Settat" => "Settat",
                            "Barrechid" => "Barrechid",
                            "Al Khmissat" => "Al Khmissat",
                            "Inezgane" => "Inezgane",
                            "Ksar El Kebir" => "Ksar El Kebir",
                            "My Drarga" => "My Drarga",
                            "Larache" => "Larache",
                            "Guelmim" => "Guelmim",
                            "Fès" => "Fès",
                            "Berkane" => "Berkane",
                            "Ad Dakhla" => "Ad Dakhla",
                            "Bouskoura" => "Bouskoura",
                            "Al Fqih Ben Çalah" => "Al Fqih Ben Çalah",
                        ])
                        ->native(false)
                        ->required()
                        ->searchable(),
                    Section::make()
                        ->schema([
                            Map::make("map")
                                ->defaultZoom(12)
                                ->autocomplete(
                                    fieldName: "address",
                                    placeField: "name",
                                    countries: ["MA"]
                                )
                                ->geolocateOnLoad(true, false)
                                ->clickable(false)
                                ->autocompleteReverse(true)
                                ->mapControls([
                                    "mapTypeControl" => false,
                                    "scaleControl" => false,
                                    "streetViewControl" => false,
                                    "rotateControl" => false,
                                    "fullscreenControl" => false,
                                    "searchBoxControl" => false, // creates geocomplete field inside map
                                    "zoomControl" => false,
                                ])
                                ->defaultLocation([31.6346023, -8.0778932])
                                ->draggable(false)
                                ->columnSpan(2),
                        ])
                        ->description("Collapse Map")
                        ->collapsible(),
                    Forms\Components\Hidden::make("user_id")->default(
                        auth()->id()
                    ),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)->columns([
                TextColumn::make("id")
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make("date")->dateTime('F d, Y H:i')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make("city")
                    ->toggleable()
                    ->sortable(),
                TextColumn::make("types")
                    ->toggleable()
                    ->badge()
                    ->separator(",")
                    ->color(
                        fn(string $state): string => match ($state) {
                            "Blood" => "danger",
                            "Plasma" => "warning",
                            "Platelets" => "gray",
                        }
                    ),
                Tables\Columns\TextInputColumn::make("available_seats")
                    ->sortable()->rules(['required', 'min:1', 'max:1000000', 'integer',])
                    ->toggleable(),
                TextColumn::make("address")->toggleable()->words(4),

                TextColumn::make("created_at")->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters(
                [
                    QueryBuilder::make()->constraints([
                        DateConstraint::make("created_at"),
                        DateConstraint::make("date"),
                        SelectConstraint::make("city")
                            ->options([
                                "Marrakech" => "Marrakech",
                                "Oued Zem" => "Oued Zem",
                                "Tangier" => "Tangier",
                                "Sidi Slimane" => "Sidi Slimane",
                                "Errachidia" => "Errachidia",
                                "Guercif" => "Guercif",
                                "Oulad Teïma" => "Oulad Teïma",
                                "Ben Guerir" => "Ben Guerir",
                                "Sale" => "Sale",
                                "Sefrou" => "Sefrou",
                                "Fnidq" => "Fnidq",
                                "Sidi Qacem" => "Sidi Qacem",
                                "Tiznit" => "Tiznit",
                                "Moulay Abdallah" => "Moulay Abdallah",
                                "Youssoufia" => "Youssoufia",
                                "Martil" => "Martil",
                                "Aïn Harrouda" => "Aïn Harrouda",
                                "Souq Sebt Oulad Nemma" =>
                                    "Souq Sebt Oulad Nemma",
                                "Skhirate" => "Skhirate",
                                "Ouezzane" => "Ouezzane",
                                "Sidi Yahya Zaer" => "Sidi Yahya Zaer",
                                "Rabat" => "Rabat",
                                "Al Hoceïma" => "Al Hoceïma",
                                "M’diq" => "M’diq",
                                "Midalt" => "Midalt",
                                "Azrou" => "Azrou",
                                "Meknès" => "Meknès",
                                "El Kelaa des Srarhna" =>
                                    "El Kelaa des Srarhna",
                                "Ain El Aouda" => "Ain El Aouda",
                                "Oujda-Angad" => "Oujda-Angad",
                                "Beni Yakhlef" => "Beni Yakhlef",
                                "Ad Darwa" => "Ad Darwa",
                                "Al Aaroui" => "Al Aaroui",
                                "Qasbat Tadla" => "Qasbat Tadla",
                                "Boujad" => "Boujad",
                                "Jerada" => "Jerada",
                                "Kenitra" => "Kenitra",
                                "Mrirt" => "Mrirt",
                                "Agadir" => "Agadir",
                                "El Aïoun" => "El Aïoun",
                                "Azemmour" => "Azemmour",
                                "Temsia" => "Temsia",
                                "Zagora" => "Zagora",
                                "Ait Ourir" => "Ait Ourir",
                                "Aziylal" => "Aziylal",
                                "Tétouan" => "Tétouan",
                                "Sidi Yahia El Gharb" => "Sidi Yahia El Gharb",
                                "Biougra" => "Biougra",
                                "Zaïo" => "Zaïo",
                                "Aguelmous" => "Aguelmous",
                                "El Hajeb" => "El Hajeb",
                                "Casablanca" => "Casablanca",
                                "Zeghanghane" => "Zeghanghane",
                                "Imzouren" => "Imzouren",
                                "Tit Mellil" => "Tit Mellil",
                                "Taourirt" => "Taourirt",
                                "Mechraa Bel Ksiri" => "Mechraa Bel Ksiri",
                                "Temara" => "Temara",
                                "Safi" => "Safi",
                                "Al ’Attawia" => "Al ’Attawia",
                                "Tifariti" => "Tifariti",
                                "Demnat" => "Demnat",
                                "Arfoud" => "Arfoud",
                                "Tameslouht" => "Tameslouht",
                                "Bou Arfa" => "Bou Arfa",
                                "Sidi Smai’il" => "Sidi Smai’il",
                                "Souk et Tnine Jorf el Mellah" =>
                                    "Souk et Tnine Jorf el Mellah",
                                "Mehdya" => "Mehdya",
                                "Aïn Taoujdat" => "Aïn Taoujdat",
                                "Chichaoua" => "Chichaoua",
                                "Tahla" => "Tahla",
                                "Oulad Yaïch" => "Oulad Yaïch",
                                "Moulay Bousselham" => "Moulay Bousselham",
                                "Iheddadene" => "Iheddadene",
                                "Missour" => "Missour",
                                "Zawyat ech Cheïkh" => "Zawyat ech Cheïkh",
                                "Bouknadel" => "Bouknadel",
                                "Oulad Tayeb" => "Oulad Tayeb",
                                "Oulad Barhil" => "Oulad Barhil",
                                "Bir Jdid" => "Bir Jdid",
                                "Khénifra" => "Khénifra",
                                "El Jadid" => "El Jadid",
                                "Laâyoune" => "Laâyoune",
                                "Mohammedia" => "Mohammedia",
                                "Kouribga" => "Kouribga",
                                "Béni Mellal" => "Béni Mellal",
                                "Ait Melloul" => "Ait Melloul",
                                "Nador" => "Nador",
                                "Taza" => "Taza",
                                "Settat" => "Settat",
                                "Barrechid" => "Barrechid",
                                "Al Khmissat" => "Al Khmissat",
                                "Inezgane" => "Inezgane",
                                "Ksar El Kebir" => "Ksar El Kebir",
                                "My Drarga" => "My Drarga",
                                "Larache" => "Larache",
                                "Guelmim" => "Guelmim",
                                "Fès" => "Fès",
                                "Berkane" => "Berkane",
                                "Ad Dakhla" => "Ad Dakhla",
                                "Bouskoura" => "Bouskoura",
                                "Al Fqih Ben Çalah" => "Al Fqih Ben Çalah",
                            ])
                            ->native(false)
                            ->searchable()
                            ->multiple(),
                        TextConstraint::make("address"),
                        TextConstraint::make("eligibility_criteria"),

                        NumberConstraint::make("available_seats"),
                    ]),
                ],
                layout: FiltersLayout::Modal
            )
            ->filtersFormWidth(MaxWidth::FourExtraLarge)
            ->actions([
                Tables\Actions\EditAction::make()->authorize(function (
                    $record
                ) {
                    return $record->user_id == auth()->id();
                }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(
                fn(Builder $query) => $query->where(
                    "user_id",
                    "=",
                    auth()->id()
                )
            );
    }

    public static function getRelations(): array
    {
        return [
            BookingRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListPosts::route("/"),
            "create" => Pages\CreatePost::route("/create"),
            "edit" => Pages\EditPost::route("/{record}/edit"),
        ];
    }
}
