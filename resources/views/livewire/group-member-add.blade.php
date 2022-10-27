<div>
    <div class="card-body">
        <input type="text" wire:model="search" class="form-control" placeholder="Search friends" />
        {{-- ---------------- [ Search Tab ] ---------------- --}}
        <div class="messenger-tab search-tab app-scroll" data-view="search">
            {{-- items --}}
            <p class="messenger-title">Search</p>
            <div class="search-records connectedSortable" id="sortable1">
                <p class="message-hint center-el"><span>Type to search..</span></p>
            </div>
        </div>
        <ul class="list-group">
            @foreach ($records as $user)
                <li
                    class="list-group-item d-flex justify-content-between align-items-center member-{{ $user->id }}">
                    {{-- Avatar side --}}

                    <div class="avatar av-m" style="background-image: url('{{ filePath($user->avatar) }}');">
                    </div>
                    <p>
                        {{ strlen($user->name) > 12 ? trim(substr($user->name, 0, 12)) . '..' : $user->name }}</p>

                    <button wire:click="addToGroup({{ $user->id }})" class="btn btn-success"><i
                            class="fas fa-check"></i>Add to group</button>
                </li>
            @endforeach
        </ul>
    </div>
</div>
