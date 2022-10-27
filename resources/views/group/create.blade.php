@include('group.layouts.headLinks')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Create a new group</h2>
    </div>
    <div class="card-body">
        <form action="{{route('group.store')}}" method="post" enctype="multipart/form-data">
           @csrf

            <div class="form-group">
                <label for="inputEmail4">Group Name <span class="text-danger">*</span> </label>
                <input type="text" name="name" required class="form-control" id="inputEmail4" placeholder="Group name">
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
                    <input type="file" name="cover" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

</div>

@include('group.layouts.modals')
@include('group.layouts.footerLinks')
