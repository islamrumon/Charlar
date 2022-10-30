<?php

namespace App\Http\Livewire;

use App\Models\ChFavorite;
use App\Models\GroupChat;
use App\Models\GroupParticipant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GroupMemberAdd extends Component
{


    public $group;

    public $search;
    public $recordss;


    public function mount($id = null)
    {
        $this->group =  GroupChat::find(routeValDecode($id));
    }



    public function addToGroup($id)
    {

        $participant = GroupParticipant::where('group_id', $this->group->id)
            ->where('user_id', $id)->first();
        if ($participant == null) {
            $participant = new GroupParticipant();
            $participant->group_id = $this->group->id;
            $participant->user_id = $id;
            $participant->save();
        }
    }

    public function render()
    {

        if ($this->group != null) {
            $d = GroupParticipant::where('group_id', $this->group->id)
                ->pluck('user_id');

            if ($this->search != null) {
                $records = User::whereNotIn('id', $d)
                    ->where('name', 'LIKE', "%{$this->search}%")
                    ->where('email', 'LIKE', "%{$this->search}%")
                    ->paginate(20);
            } else {
                $records = User::whereNotIn('id', $d)->latest()->paginate(20);
            }
        } else {
            $records = User::get()->paginate(20)->shuffle();
        }

        return view('livewire.group-member-add', compact('records'));
    }
}
