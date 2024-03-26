@extends('home.parent')

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center mt-2">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-4 mt-4">
        <div class="row text-center">
            <div class="col-md-12">
                @if (empty(Auth::user()->profile->image))
                    <a href="{{ route('createProfile') }}"
                        class="btn btn-primary position-absolute fs-3 rounded-circle" id="but"><i
                            class="bi bi-plus"></i></a>
                    <img class="rounded-4 w-25"
                        src="https://ui-avatars.com/api/background=FFD700?name={{ Auth::user()->name }}" alt="">
                @else
                    <img src="{{ Auth::user()->profile->image }}" alt="profile" style="width: 1000px; height: 680px">
                    <a href="{{ route('editProfile') }}"
                        class="btn btn-warning position-absolute fs-2 rounded-circle" id="bat"><i
                            class="bi bi-pencil"></i></a>
                @endif

            </div>

            <div class="col-md-12 mt-5">
                <h1 class="fs-1 fw-bold">Profile</h1>
                <hr>
                <p><span class="fw-bold">Acc Name </span> : {{ Auth::user()->name }}</p>
                @if (empty(Auth::user()->profile->first_name))
                <p><span class="fw-bold">First Name </span> : <span class="text- danger">Nothing</span></p>
                @else
                    <p><span class="fw-bold">First Name </span> : {{ Auth::user()->profile->first_name }}</p>
                @endif
                <p><span class="fw-bold">Role </span> : {{ Auth::user()->role }}</p>
                <p><span class="fw-bold">Email </span> : {{ Auth::user()->email }}</p>
            </div>
        </div>

    </div>
@endsection
