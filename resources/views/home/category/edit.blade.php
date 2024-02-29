@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h1 class="fw-bold text-center">EDIT</h1>
            <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="inputName" class="form-label">Category name</label>
                    <input type="text" class="form-control" id="inputname" name="name" value="{{ $category->name }}">
                </div>
                <div class="col-12 mt-1">
                    <label for="inputimage" class="form-label">Category image</label>
                    <input type="file" class="form-control" id="inputimage" name="image">
                </div>
                <div class="text-end mt-3">
                    <a href="{{ route('category.index') }}" class="btn btn-primary mx-2"><i class="bi bi-arrow-left"></i> Back</a>
                    <button type="submit" class="btn btn-warning mx-2"><i class="bi bi-pencil-square"></i> Edit</button>
                    <button type="reset" class="btn btn-danger mx-2"><i class="bi bi-trash"></i> Reset</button>
                </div>
            </form>
        </div>
    </div>
@endsection
