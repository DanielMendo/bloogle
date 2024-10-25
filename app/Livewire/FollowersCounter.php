<?php

namespace App\Livewire;

use Livewire\Component;

class FollowersCounter extends Component
{
    public $user;
    public $count;
    protected $listeners = ['newfollow' => 'refreshCounter'];


    public function mount()
    {
        $this->count = $this->user->followers->count();
    }

    public function refreshCounter()
    {
        $this->count = $this->user->followers->count();
    }

    public function render()
    {
        return view('livewire.followers-counter');
    }
}
