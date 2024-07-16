<?php

namespace App\Livewire;

use App\Mail\ConfirmationBooking;
use App\Mail\NewBooking;
use App\Models\Booking;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class BookingForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $post_id;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('phone')
                        ->tel()->minLength(1)->maxLength(15)
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required(),
                    Forms\Components\Hidden::make('post_id')->default($this->post_id)
                ])
            ])
            ->statePath('data')
            ->model(Booking::class);
    }

    public function create(): void
    {

        $record_booking_post = DB::transaction(function ()  {
            $bookingRecord = Booking::create($this->form->getState());
            $this->form->model($bookingRecord)->saveRelationships();
            $post = Post::find($this->post_id);
            $post->available_seats = $post->available_seats - 1;
            $post->save();

            // Return the booking record
            return [$bookingRecord, $post];
        });
        $record = $record_booking_post[0];
        $post = $record_booking_post[1];
        $user = $post->user;

        $this->redirect("/");

        Mail::to($record->email)->send(new ConfirmationBooking($record, $user) );
        Mail::to($user->email)->send(new NewBooking($record, $user));
        Notification::make()
            ->title('Booked Successfully')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.booking-form');
    }
}
