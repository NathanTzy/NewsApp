@extends('home.parent')

@section('content')
    @if (session('udah'))
        <div class="alert alert-success text-center mt-2">
            {{ session('udah') }}
        </div>
    @endif
    <div class="row">
        <div class="card p-4">
            <h3 class="fs-1">News Index</h3>

            <div class="d-flex justify-content-end">
                <a href="{{ route('news.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Create News</a>
            </div>

        </div>

        <div class="container">
            <div class="card p-3">
                <h5 class="card-title">Data news</h5>
                <table class="table data-table">
                    <th>
                        <tr>
                            td*3
                        </tr>
                    </th>
                </table>
            </div>
        </div>
    </div>
    
@endsection
