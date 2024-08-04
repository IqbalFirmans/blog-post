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

    @if ($bookmarks->count())
        <div class="container">
            <div class="row">
                @foreach ($bookmarks as $bookmark)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="position-absolute bg-dark py-2 px-3 text-white opacity-75">
                                <a href="/posts?category="
                                    class="text-decoration-none text-white">{{ $bookmark->post->category->name }}</a>
                            </div>
                            <img src="{{ asset('storage/' . $bookmark->post->image) }}" class="card-img-top object-fit-cover" alt="image" width="500" height="300">
                            <div class="card-body">
                                <h5 class="card-title">{{ $bookmark->post->title }}</h5>
                                   <p>
                                    <small class="text-body-secondary">By. <a href="/posts?author="
                                            class="text-decoration-none">{{ $bookmark->post->user->name }}</a>
                                        {{ $bookmark->post->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                <p class="card-text">{{ Str::limit($bookmark->post->content, 100) }}</p>
                                <a href="/posts" class="btn btn-primary">Read More</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#reportModal">
                                    Report
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">No bookmarks found.</p>
    @endif

@endsection
