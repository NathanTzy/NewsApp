@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3 class="fw-bold text-center my-4 fs-1">NEWS CREATOR</h3>

            <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')

                {{-- field buat title --}}
                <div class="mb-3">
                    <label for="inputTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="inputTitle" name="title" value="{{ old('title') }}">
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
                            <option selected>🗿🥔🥕</option>
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
                    <textarea id="editor" name="content"></textarea>
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
            </form>
        </div>
    </div>
@endsection
