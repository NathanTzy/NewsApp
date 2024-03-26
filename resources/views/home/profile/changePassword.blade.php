@extends('home.parent')

@section('content')
    @if (session('errors'))
        <div class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif

    {{-- //alert success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="card p-4">
            <h1 class="card-title fs-2 text-center">Change Password</h1>
            <hr>
            <form action="{{ route('profile.updatePassword') }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Current Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="currentPassword" placeholder="Current password">
                    </div>
                </div>

                <div class="row my-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" placeholder="New password">
                    </div>
                </div>

                <div class="row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm password">
                    </div>
                </div>

                <div class="float-end">
                    <button type="submit" class="btn btn-warning mt-3 text-white">
                        <i class="bi bi-pencil-square"></i>
                        Update News</button>
                </div>
            </form>

        </div>
    </div>
@endsection
