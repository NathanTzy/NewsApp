@extends('home.parent')

@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="b mb-0 fw-bold text-center">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @else
        @endif
        <div class="card p-4">
            <h3 class="fw-bold text-center my-4 fs-1">NEWS CREATOR</h3>

            <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- field buat title --}}
                <div class="mb-3">
                    <label for="inputTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="inputTitle" name="title" value="{{ $news->titlle }}"
                        placeholder="{{ $news->title }}">
                </div>
                {{-- image --}}
                <div class="mb-3">
                    <label for="inputImage" class="form-label">Image</label>
                    <input type="file" class="form-control" id="inputImage" name="image" value="{{ old('image') }}">
                </div>

                <div class=" mb-3">
                    <label class="col col-form-label">Select Category</label>
                    <div class="col">
                        <select name="category_id" class="form-select" aria-label="category_id">
                            <option value="{{ $news->category->id }}" selected>{{ $news->category->name }}</option>
                            <option class="fw-bold" disabled>
                                <<<=== CHOOSE NEW CATEGORY===>>>
                            </option>
                            @foreach ($category as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                {{-- guna name buat ngirim data ke controller, juga sebagai indentitas --}}
                {{-- id CKEditor --}}
                <div class="mb-2">
                    <label for="col col-form-label">Content</label>
                    <textarea id="editor" name="content">
                        {!! $news->content !!}
                    </textarea>
                </div>

                {{-- button submit --}}
                <div class="d-flex justify-content-end mt-3 gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-pencil"></i>
                        Update News</button>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('news.index') }}" class="btn btn-primary p-2 text-white">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                </div>


            </form>
        </div>
    </div>
    {{-- PAKE ID!!! --}}
    {{-- CKEditor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
