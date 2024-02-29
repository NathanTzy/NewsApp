@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>
                Create Category
            </h3>

            {{-- Route store --}}
            {{-- untuk melakukan penambahan data --}}
            {{-- untuk enctype melakukan input karena ada upload berupa file --}}
            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- Method jenis yg digunakan --}}
                @method('POST')
                <hr>

                <div class="col-12">
                    <label for="inputName" class="form-label">Category name</label>
                    <input type="text" class="form-control" id="inputname" name="name" value="{{ old('name') }}">
                </div>
                <div class="col-12 mt-1">
                    <label for="inputimage" class="form-label">Category image</label>
                    <input type="file" class="form-control" id="inputimage" name="image">
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success mx-2"><i class="bi bi-plus"></i> Create category</button>
                    <button type="reset" class="btn btn-danger mx-2"><i class="bi bi-trash"></i> Reset</button>
                </div>
            </form>
        </div>
    </div>

    
@endsection
