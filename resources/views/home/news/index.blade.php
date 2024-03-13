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
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image news</th>
                            <th>Image category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->category->name }}</td>
                                <td><img src="{{ url('storage/news', $row->image) }}" alt="p" width="100px"
                                        class="rounded-3"></td>
                                <td><img src="{{ $row->category->image }}" width="100px" alt="p" class="rounded-3">
                                </td>
                                <td>
                                    <a href="{{ route('news.show', $row->id ) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('news.edit', $row->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <p class="text-center">minimal isi lah</p>
                        @endforelse
                    </tbody>
                </table>
                {{-- paginate --}}
                {{ $news->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
