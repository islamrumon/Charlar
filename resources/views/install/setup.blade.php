@extends('install.app')
@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{route('db.setup')}}" method="post" class="text-left">
                @csrf
                <div class="form-head text-center">
                    <img src="{{asset(getSystemSetting('type_logo'))}}" class="img-fluid" alt="logo">
                </div>
                <h4 class="ont-weight-boldtext-center my-4">Setup Database Configuration</h4>
                <div class="form-group">
                    <input type="hidden" name="types[]" value="DB_HOST">
                    <label class="text-reset">@translate(Database Host)</label>
                    <input class="form-control" placeholder="Database Host" name="DB_HOST" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="types[]" value="DB_DATABASE">
                    <label>@translate(Database Name)</label>
                    <input class="form-control" placeholder="Database Name" name="DB_DATABASE" required>
                </div>

                <div class="form-group">
                    <input type="hidden" name="types[]" value="DB_USERNAME">
                    <label>@translate(Database Username)</label>
                    <input class="form-control" placeholder="Database Username" name="DB_USERNAME" required>
                </div>

                <div class="form-group">
                    <input type="hidden" name="types[]" value="DB_PASSWORD">
                    <label>@translate(Database Password)</label>
                    <input class="form-control" placeholder="Database Password" type="password" name="DB_PASSWORD">
                </div>

                <div class="">
                    <button class="btn btn-primary btn-lg btn-block font-18" type="submit">Save The Configuration</button>
                </div>
            </form>

        </div>
    </div>


@endsection
