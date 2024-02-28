@extends('home.parent')

@section('content')
<div class="container">
<div class="row">
    <h1 class="text-center fw-bold font-monospace bg-success shadow-lg p-4 rounded-4 text-white">Welcome {{ Auth::user()->name }}</h1>
</div>
</div>
    
@endsection