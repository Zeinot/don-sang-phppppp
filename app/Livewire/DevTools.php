<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Post;
use App\Models\User;
use Filament\Notifications\Notification;
use Livewire\Component;

class DevTools extends Component
{
    public function render()
    {
        return view('livewire.dev-tools');
    }

    public function seedDb():void
    {
        User::factory(10)->create();
        Post::factory(25)->create();
        Booking::factory(25)->create();
        Notification::make()
            ->title('Seeded Successfully')
            ->color('success')
            ->send();
        $this->redirect("/posts");
    }
}
