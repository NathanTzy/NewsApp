@extends('home.parent')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="text-center fw-bold font-monospace bg-success p-4 rounded-4 text-white">Welcome
                {{ Auth::user()->name }}</h1>
        </div>
        <hr>
        <div class="card p-3">
            <!-- List group with active and disabled items -->
            <ul class="list-group">
                <h1 class="text-center">Detail Account</h1>
                <li class="list-group-item active bg-warning " aria-current="true">Username : {{Auth::user()->name }}</li>
                <li class="list-group-item ">E-Mail : {{ Auth::user()->email }}</li>
                <li class="list-group-item ">You are : {{ Auth::user()->role }}</li>

            </ul><!-- End ist group with active and disabled items -->
        </div>
    </div>
@endsection
