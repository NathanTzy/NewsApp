@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h1 class="card-title fs-2 text-center">Change Password</h1>
            <hr>
            <form action="" method="post">
                @csrf
                @method('PUT')
                <label for="inputPassword" class="col-sm-2 col-form-label">Current Password</label>
                <div class="col-sm-10">
                    <input type="" class="form-control" name="currentPassword" placeholder="Current password">
                </div>
                <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                    <input type="" class="form-control" name="password" placeholder="New password">
                </div>
                <label for="inputPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="" class="form-control" name="confirmationPassword" placeholder="Confirm password">
                </div>
                <div class="float-end">
                    <button type="submit" class="btn btn-warning mt-3">
                        <i class="bi bi-pencil-square"></i>
                        Update News</button>
                </div>
            </form>

        </div>
    </div>
@endsection
