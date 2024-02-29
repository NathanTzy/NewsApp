@extends('home.parent')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="text-center fw-bold font-monospace bg-success p-4 rounded-4 text-white">Welcome
                {{ Auth::user()->name }}</h1>
        </div>
        <form action="{{ route('logout') }}" method="post" class="d-flex justify-content-center">
            @csrf
            <button class="btn btn-danger">
                LogOut
            </button>
        </form>
    </div>
@endsection
