@extends('frontend.layouts.web-layout')

@section('title')
    Category {{ $category->name }}
@endsection

@section('header')
    <header class="header text-center text-white"
            style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
        <div class="container">

            <div class="row">
                <div class="col-md-8 mx-auto">

                    <h1>{{ $category->name }}</h1>
                    <p class="lead-2 opacity-90 mt-6">{{ $category->name }}</p>

                </div>
            </div>

        </div>
    </header>
@endsection

@section('main-content')
    <main class="main-content">
        <div class="section bg-gray">
            <div class="container">
                <div class="row">


                    <div class="col-md-8 col-xl-9">
                        <div class="row gap-y">

                            @if($posts->count() > 0)
                                @foreach ($posts as $post)
                                    <div class="col-md-6 d-flex align-item-stretch">
                                        <div class="card border hover-shadow-6 mb-6 d-block">
                                            <a href="#">
                                                <img class="card-img-top" src="{{ url('storage/app/'.$post->image) }}"
                                                     alt="Card image cap">
                                            </a>
                                            <div class="p-6 text-center">
                                                <p>
                                                    <a class="small-5 text-lighter text-uppercase ls-2 fw-400" href="#">
                                                        {{ $post->category->name }}
                                                    </a>
                                                </p>
                                                <h5 class="mb-0">
                                                    <a class="text-dark" href="{{ url('web/blog/posts', $post->id) }}">
                                                        {{ $post->title }}
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-6">
                                    <p class="text-muted">
                                        No posts found for query <strong>{{ request()->query('search') }}</strong>
                                    </p>
                                </div>
                            @endif

                        </div>

                        @if($posts->count() > 0)
                            {{ $posts->appends(['search' => request()->query('search')])->links() }}
                        @endif
                    </div>

                    @include('frontend.partials.sidebar')

                </div>
            </div>
        </div>
    </main>
@endsection
