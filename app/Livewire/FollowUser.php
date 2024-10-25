<?php

namespace App\Livewire;

use Livewire\Component;
use App\Notifications\NewFollower;
use Illuminate\Support\Facades\Auth;

class FollowUser extends Component
{
    public $user;

    public function store()
    {
        $this->user->followers()->attach(Auth::user()->id);
        $this->user->notify(new NewFollower(Auth::user()));

        $this->dispatch('newfollow');
    }

    public function destroy()
    {
        $this->user->followers()->detach(Auth::user()->id);
        $this->dispatch('newfollow');
    }

    public function render()
    {
        return view('livewire.follow-user');
    }
}
