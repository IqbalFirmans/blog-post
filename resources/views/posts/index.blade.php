@extends('layouts.main')

@section('title', 'Posts')
@section('container')
    <h1 class="mb-3 text-center">{{ $title }}</h1>
    @if ($posts->count())
        <div class="card mb-3">
            <img src="{{ 'storage/' . $posts[0]->image }}" alt="image" style="max-width: 80%" class="d-block mx-auto">
            <div class="card-body text-center">
                <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}"
                        class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>

                <p>
                    <small class="text-body-secondary">By. <a href="/blog?author={{ $posts[0]->user->name }}"
                            class="text-decoration-none">{{ $posts[0]->user->name }}</a> in <a href="/blog?category={{ $posts[0]->category->name }}"
                            class="text-decoration-none">{{ $posts[0]->category->name }}</a>
                        {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>

                <p class="card-text">{{ Str::limit($posts[0]->content, 100) }}</p>

                <div class="d-flex justify-content-between">

                    <div class="demo-inline-spacing">
                        <a href="/posts" class="btn btn-primary">Read More</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reportModal-1">
                            Report
                        </button>
                    </div>

                    @auth
                        <form action="{{ route('bookmarks.store', $posts[0]->id) }}" method="post">
                            @csrf

                            @if (Auth::user()->bookmarks->contains('post_id', $posts[0]->id))
                                <button class="btn btn-danger" type="submit">Remove</button>
                            @else
                                <button class="btn btn-success" type="submit">Add</button>
                            @endif
                        </form>
                    @endauth
                </div>

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
                            <img src="storage/{{ $post->image }}" class="card-img-top object-fit-cover" alt="image" width="500" height="300" >
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p>
                                    <small class="text-body-secondary">By. <a href="/posts?author="
                                            class="text-decoration-none">{{ $post->user->name }}</a>
                                        {{ $post->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>

                                <div class="d-flex justify-content-between">

                                    <div class="demo-inline-spacing">
                                        <a href="/posts" class="btn btn-primary">Read More</a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#reportModal">
                                            Report
                                        </button>
                                    </div>

                                    @auth
                                        <form action="{{ route('bookmarks.store', $post->id) }}" method="post">
                                            @csrf

                                            @if (Auth::user()->bookmarks->contains('post_id', $post->id))
                                                <button class="btn btn-danger" type="submit">Remove</button>
                                            @else
                                                <button class="btn btn-success" type="submit">Add</button>
                                            @endif
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->

                    <div class="modal fade" id="reportModal-1" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Report Post</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('reports.store') }}" method="post">
                                    <div class="modal-body">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $posts[0]->id }}">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="reason" class="form-label">Reason</label>
                                                <textarea type="text" id="reason" name="reason" class="form-control @error('reason') is-invalid @enderror"
                                                    placeholder="Submit Reason">{{ old('reason') }}</textarea>

                                                @error('reason')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Report Post</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('reports.store') }}" method="post">
                                    <div class="modal-body">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="reason" class="form-label">Reason</label>
                                                <textarea type="text" id="reason" name="reason" class="form-control @error('reason') is-invalid @enderror"
                                                    placeholder="Submit Reason">{{ old('reason') }}</textarea>

                                                @error('reason')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- end Modal --}}
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
