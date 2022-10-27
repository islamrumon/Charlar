@php
    if (!isset($group)) {
        $group = Auth::user();
    }
    
    if (!isset($users)) {
        $users = collect();
        $users->push(Auth::user());
    }
@endphp

<div class="page-header header-filter" data-parallax="true" style="background-image:url('{{ filePath($group->cover) }}');">
</div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ml-auto mr-auto">
                    <div class="profile">
                        <div class="avatar">
                            <img src="{{ filePath($group->avatar) }}" alt="Circle Image"
                                class="img-raised rounded-circle img-fluid">
                        </div>
                        <div class="name">
                            <h3 class="title">{{ $group->name }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description text-center">
                <p>{!! nl2br($group->about) !!}</p>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">Members</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Add Member</button>
                </li>
            </ul>
           
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <ul class="list-group">
                        @foreach ($users as $user)
                            <li class="list-group-item d-flex justify-content-between align-items-center member-{{ $user->id }}">
                                {{-- Avatar side --}}

                                <div class="avatar av-m"
                                    style="background-image: url('{{ filePath($user->avatar) }}');">
                                </div>
                                <p>
                                    {{ strlen($user->name) > 12 ? trim(substr($user->name, 0, 12)) . '..' : $user->name }}</p>

                                    @if($group->admin_id == $user->id)
                                    <span>Group Admin</span>
                                    @else
                                    <button type="button" onclick="removeFromGroup('{{route('remove.from.group',[$group->id,$user->id])}}')" class="btn btn-sm btn-danger">Remove</button>
                                    @endif


                            </li>
                            @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <livewire:group-member-add :id="routeValEncode($group->id)" />
                </div>
            </div>
          

        </div>
    </div>
</div>
