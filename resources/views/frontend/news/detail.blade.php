@extends('frontend.parent')

@section('content')
    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content" data-aos="fade-up">
                    <!-- ======= Single Post Content ======= -->
                    <div class="single-post">
                        <div class="post-meta"><span class="date">{{ $news->category->name }}</span> <span
                                class="mx-1">&bullet;</span>
                            <span>{{ $news->created_at->diffForHumans() }}</span>
                        </div>
                        <h1 class="mb-5">{{ $news->title }}</h1>
                        <img src="http://127.0.0.1:8000/storage/news/{{ $news->image }}" alt="" class="img-fluid">
                        <p class="mt-4">{!! $news->content !!}
                        </p>
                    </div>
                    <!-- End Single Post Content -->
                </div>

                <div class="col-md-3 mt-5">
                    <!-- ======= Sidebar ======= -->
                <div class="aside-block">
                    <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                        @foreach ($category as $row)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ $row->slug }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ $row->slug }}" type="button" role="tab" aria-controls="pills-{{ $row->slug }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $row->name }}</button>
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($category as $row)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ $row->slug }}" role="tabpanel" aria-labelledby="pills-{{ $row->slug }}-tab">
                            @foreach ($row->news->take(3) as $news)
                            <div class="post-entry-1 border-bottom">
                                <div class="post-meta"><span class="date">{{ $news->category->name }}</span> <span class="mx-1">&bullet;</span> <span>{{ $news->created_at->diffForHumans() }}</span></div>
                                <h2 class="mb-2"><a href="{{ route('detailNews',$news->slug) }}">{{ Str::limit($news->title, 30) }}</a></h2>
                                <span class="author mb-3 d-block">Jenny Wilson</span>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>

                </div>
            </div>
        </div>
    </section>
@endsection
