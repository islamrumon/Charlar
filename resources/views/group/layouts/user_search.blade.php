@foreach ($records as $user)
<li class="list-group-item d-flex justify-content-between align-items-center member-{{ $user->id }}">
    {{-- Avatar side --}}

    <div class="avatar av-m" style="background-image: url('{{ filePath($user->avatar) }}');">
    </div>
    <p>{{$user->name }} <br> 
        <span>{{$user->email}}</span>
    </p>
   

    <button onclick="addToGroup({{ $user->id }},{{$id}})" class="btn btn-success"><i
            class="fas fa-check"></i>Add to group</button>
</li>
@endforeach