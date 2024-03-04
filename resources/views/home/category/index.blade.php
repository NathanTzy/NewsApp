@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h2>CATEGORY</h2>

            <div class="d-flex justify-content-end">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Create Category</a>
            </div>

            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Category</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($category as $row)
                                    <tr>
                                        {{-- Numbering menggunakan loop->iteration --}}
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- menampilkan data name --}}
                                        <td>{{ $row->name }}</td>
                                        {{-- mwnampilkan data  slug --}}
                                        <td>{{ $row->slug }}</td>
                                        {{-- menampilkan data image --}}
                                        <td><img src="{{ $row->image }}" alt="" width="100px" class="rounded-3">
                                        </td>

                                        <td class="d-flex gap-2">
                                            <!-- show using modal with id  -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#basicModal{{ $row->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            @include('home.category.include.modal-show')


                                            {{-- Edit with route category --}}
                                            <a href="{{ route('category.edit', $row->id) }}" class="btn btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            {{-- Button delete with route category.destroy --}}
                                            <form action="{{ route('category.destroy', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger inline-block"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <p>kosong</p>
                                @endforelse
                            </tbody>

                        </table>
                        {{-- paginate --}}
                        {{ $category->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
