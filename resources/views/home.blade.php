@extends('home.parent')

@section('content')
<div class="container">
<div class="row">
    <h1>Welcome {{ Auth::user()->name }}</h1>
</div>
</div>
    
@endsection