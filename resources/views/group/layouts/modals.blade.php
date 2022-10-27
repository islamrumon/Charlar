{{-- ---------------------- Image modal box ---------------------- --}}
<div id="imageModalBox" class="imageModal">
    <span class="imageModal-close">&times;</span>
    <img class="imageModal-content" id="imageModalBoxSrc">
</div>

{{-- ---------------------- Delete Modal ---------------------- --}}
<div class="app-modal" data-name="delete">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="delete" data-modal='0'>
            <div class="app-modal-header">Are you sure you want to delete this?</div>
            <div class="app-modal-body">You can not undo this action</div>
            <div class="app-modal-footer">
                <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
                <a href="javascript:void(0)" class="app-btn a-btn-danger delete">Delete</a>
            </div>
        </div>
    </div>
</div>
{{-- ---------------------- Alert Modal ---------------------- --}}
<div class="app-modal" data-name="alert">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="alert" data-modal='0'>
            <div class="app-modal-header"></div>
            <div class="app-modal-body"></div>
            <div class="app-modal-footer">
                <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
            </div>
        </div>
    </div>
</div>
{{-- ---------------------- Settings Modal ---------------------- --}}
<div class="app-modal" data-name="settings">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="settings" data-modal='0'>
            <form id="update-settings" action="{{ route('avatar.update') }}" enctype="multipart/form-data"
                method="POST">
                @csrf
                <div class="app-modal-body">
                    {{-- Udate profile avatar --}}
                    <div class="avatar av-l upload-avatar-preview chatify-d-flex"
                        style="background-image: url('{{ filePath(Auth::user()->avatar) }}');"></div>
                    <p class="upload-avatar-details"></p>
                    <label class="app-btn a-btn-primary update" style="background-color:{{ $messengerColor }}">
                        Upload New
                        <input class="upload-avatar chatify-d-none" accept="image/*" name="avatar" type="file" />
                    </label>
                    {{-- Dark/Light Mode  --}}
                    <p class="divider"></p>
                    <p class="app-modal-header">Dark Mode <span
                            class="
                        {{ Auth::user()->dark_mode > 0 ? 'fas' : 'far' }} fa-moon dark-mode-switch"
                            data-mode="{{ Auth::user()->dark_mode > 0 ? 1 : 0 }}"></span></p>
                    {{-- change messenger color  --}}
                    <p class="divider"></p>
                  
                    <div class="update-messengerColor">
                        @foreach (config('chatify.colors') as $color)
                            <span style="background-color: {{ $color }}" data-color="{{ $color }}"
                                class="color-btn"></span>
                            @if (($loop->index + 1) % 5 == 0)
                                <br />
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="app-modal-footer">
                    <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
                    <input type="submit" class="app-btn a-btn-success update" value="Save Changes" />
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Group creaet model --}}
<div class="app-modal" data-name="groupcreate">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="groupcreate" data-modal='0'>
            <div class="app-modal-header">Create a new group from here</div>
            <form action="{{ route('group.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="app-modal-body">
                    <div class="form-group">
                        <label for="inputEmail4">Group Name <span class="text-danger">*</span> </label>
                        <input type="text" name="name" required class="form-control" id="inputEmail4"
                            placeholder="Group name">
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">About group</label>
                        <textarea name="about" class="form-control"></textarea>

                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="inputAddress2">Group Avatar</label>
                            <input type="file" name="avatar" class="form-control" id="inputAddress2"
                                placeholder="Apartment, studio, or floor">
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">Group Cover Photo</label>
                            <input type="file" name="cover" class="form-control" id="inputAddress"
                                placeholder="1234 Main St">
                        </div>
                    </div>
                </div>
                <div class="app-modal-footer">
                    <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>

                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
