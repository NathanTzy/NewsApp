@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <div>
                <a href="{{ route('profile.index') }}" class="btn btn-warning text-white"><i class="bi bi-arrow-left-square"></i> back</a>
            </div>
            <h3 class="card-title text-center fs-3">
                Create Profile <span class="fs-1 fw-bold text-decoration-underline text-warning">{{ Auth::user()->name }}</span>
            </h3>

            <!-- Vertical Form -->
            <form class="row g-3" method="post" action="{{ route('storeProfile') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="col-12">
                    <label for="Name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="Name" name="first_name">
                </div>
                <div class="col-12">
                    <label for="Image" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="Image" name="image">
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-warning text-white">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form><!-- Vertical Form -->
        </div>
    </div>
@endsection
