<?php

namespace App\Http\Livewire;

use App\Models\GroupChat;
use Livewire\Component;

class GroupSearch extends Component
{

    public $search;

    public function render()
    {

        if ($this->search != null) {
            $groups = GroupChat::latest()
                ->orWhere('name', 'like', "%{$this->search}%")
                ->paginate(20);
        } else {
            $groups = GroupChat::latest()->paginate(20);
        }

        return view('livewire.group-search',compact('groups'));
    }
}
