@extends('home.parent')

@section('content')
    <div class="card p-4 mt-4">
        <div class="row text-center">
            <div class="col-md-12">
                <img class="w-25 rounded-5"
                    src="https://ui-avatars.com/api/background=FFD700?name={{ Auth::user()->name }}"alt="">
                    
            </div>
            <div class="col-md-12 mt-5">
                <h1 class="fs-1 fw-bold">Profile</h1>
                <hr>
                <p class="fs-4"><span class="fw-bold">Name </span> : {{ Auth::user()->name }}</p>
                <p class="fs-4"><span class="fw-bold">Role </span> : {{ Auth::user()->role }}</p>
                <p class="fs-4"><span class="fw-bold">Email </span> : {{ Auth::user()->email }}</p>
            </div>
        </div>

    </div>
@endsection
