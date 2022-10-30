<div>
    <div class="card-body">


        <ul class="list-group">
            <li>
                <input type="text" wire:model="search" class="form-control" placeholder="Search friends" />
            </li>
            @foreach ($records as $user)
                <li onclick="alert('fluck you betch')" class="list-group-item d-flex justify-content-between align-items-center member-{{ $user->id }}">
                    {{-- Avatar side --}}

                    <div class="avatar av-m" style="background-image: url('{{ filePath($user->avatar) }}');">
                    </div>
                    <p>
                        {{$user->name }}</p>

                    <button wire:click="addToGroup({{ $user->id }})" class="btn btn-success"><i
                            class="fas fa-check"></i>Add to group</button>
                </li>
            @endforeach
        </ul>
    </div>
</div>
