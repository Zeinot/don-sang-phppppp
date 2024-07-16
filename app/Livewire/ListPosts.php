<?php

namespace App\Livewire;

use App\Models\Post;
use DateTime;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListPosts extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public static function table(Table $table): Table
    {
        $now = new DateTime();
//        dd(Post::query()->whereDate("date", ">=", $now->format('Y-m-d H:i:s'))->get());
//        dump(
//            Post::query()->get(),
//            $now->format('Y-m-d H:i')
//        );
        return $table
            ->defaultPaginationPageOption(25)
            ->paginated([10, 25, 50, 100])
            ->query(Post::query()
                ->whereDate("date", ">=", $now->format('Y-m-d H:i'))
                ->where("available_seats", ">", 0))
                ->columns([
                    TextColumn::make("date")->date()
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
                    TextColumn::make("available_seats")
                        ->sortable()
                        ->toggleable(),
                    TextColumn::make("address")->toggleable()->words(4),
                    TextColumn::make("created_at")->dateTime('F d, Y H:i')
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
                ->recordUrl(fn(Post $record): string => "/posts/$record->id")->openRecordUrlInNewTab()
                ->actions([
                    Action::make("view")
//                                        ->url(fn (Post $record): string => route('posts.edit', $record->id))
                        ->url(fn(Post $record): string => "/posts/$record->id")
//                    ->url("/post/")
                        ->openUrlInNewTab(),
                ]);
    }

    public function render(): View
    {
        FilamentColor::register([
            "primary" => Color::Red,
        ]);

        return view("livewire.list-posts");
    }
}
