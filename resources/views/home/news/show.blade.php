@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h1 class="card-title fs-1 text-center bg-primary-light rounded-3 fw-bold">
                {{ $news->title }}
                <br>
                <span class="badge bg-warning text-white ">{{ $news->category->name }}</span>
            </h1>
            <p class="my-5 text-center">
                <img src="{{ url('storage/news', $news->image) }}" alt="gambar berita" class="img-fluid rounded-5">
            </p>
            {{-- satu kurawal 2 tanda seru buat nampilin teks dan ngilangin tag <p></p> --}}
            <p>
                {!! $news->content !!}  
            </p>

            <div class="container mt-2">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('news.index') }}" class="btn btn-primary p-2 text-white">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>




@endsection
