<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ProfileSearch extends Component
{


    public $search;

    

    public function render()
    {

        if ($this->search != null) {
            $users = User::latest()
                ->orWhere('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->paginate(20);
        } else {
            $users = User::latest()->paginate(20);
        }

        return view('livewire.profile-search',compact('users'));
    }
}
