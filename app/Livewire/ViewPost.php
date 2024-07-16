<?php

namespace App\Livewire;

use App\Models\Post;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Livewire\Component;

class ViewPost extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;

    public $post_id;
    public $post;

    public function mount()
    {
        $this->post = Post::where("id", $this->post_id)->first();
    }

    public function productInfolist(Infolist $infolist): Infolist
    {
        return $infolist->record($this->post)->schema([
            Section::make("View Post")
                ->headerActions([
                    Action::make("Book")->url(fn(): string => route('booking', ['post_id' => $this->post_id]))
                ])
                ->columns([
                    "sm" => 3,
                    "xl" => 3,
                    "2xl" => 3,
                ])
                ->schema([
                    //
                    Section::make()
                        ->columnSpan(1)
                        ->schema([
                            TextEntry::make("available_seats"),
                            TextEntry::make("types")
                                ->badge()
                                ->color(
                                    fn(string $state): string => match (
                                    $state
                                    ) {
                                        "Blood" => "danger",
                                        "Plasma" => "warning",
                                        "Platelets" => "gray",
                                    }
                                ),
                        ]),
                    Section::make()
                        ->columnSpan(1)
                        ->schema([
                            TextEntry::make("city")->badge()->color("primary"),
                            TextEntry::make("address"),
                        ]),
                    Section::make()
                        ->columnSpan(1)
                        ->schema([
                            TextEntry::make("date")->dateTime('F d, Y H:i'),
                            TextEntry::make("created_at")->date(),
                        ]),
                    Section::make()->schema([
                        TextEntry::make("eligibility_criteria")->html(),
                    ]),
                ]),
        ]);
    }

    public function render()
    {
        FilamentColor::register([
            "primary" => Color::Red,
        ]);

        return view("livewire.view-post");
    }
}
