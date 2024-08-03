@extends('layouts.main')

@section('title', 'Posts')
@section('container')
    <h1 class="mb-3 text-center">@yield('title')</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search"
                        value="{{ request('search') }}" autocomplete="off">
                    <button class="btn btn-danger" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
        <div class="card mb-3">
            <img src="{{ 'storage/' . $posts[0]->image }}" alt="image" style="max-width: 80%" class="d-block mx-auto">
            <div class="card-body text-center">
                <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}"
                        class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>

                <p>
                    <small class="text-body-secondary">By. <a href="/posts?author="
                            class="text-decoration-none">{{ $posts[0]->user->name }}</a> in <a
                            href="/posts?category="
                            class="text-decoration-none">{{ $posts[0]->category->name }}</a>
                        {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>

                <p class="card-text">{{ Str::limit( $posts[0]->content, 100) }}</p>

                <a href="/posts" class="text-decoration-none btn btn-primary">Read More</a>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($posts->skip(1) as $post)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="position-absolute bg-dark py-2 px-3 text-white opacity-75">
                                <a href="/posts?category="
                                    class="text-decoration-none text-white">{{ $post->category->name }}</a>
                            </div>
                            <img src="storage/{{ $post->image }}" class="card-img-top"
                                alt="image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p>
                                    <small class="text-body-secondary">By. <a
                                            href="/posts?author="
                                            class="text-decoration-none">Admin</a>
                                        {{ $post->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                <p class="card-text">{{ Str::limit( $post->content, 100) }}</p>
                                <a href="/posts" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">No post found.</p>
    @endif

    <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div>

@endsection
