@extends('layouts.main')

@section('title', 'Posts')
@section('container')
    <h1 class="mb-3 text-center">Bookmarks</h1>

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
                            <img src="{{ asset('storage/' . $bookmark->post->image) }}" class="card-img-top object-fit-cover"
                                alt="image" width="500" height="300">
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

                    <!-- Modal -->
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
                                        <input type="hidden" name="post_id" value="{{ $bookmark->post->id }}">
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
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center fs-4">No bookmarks found.</p>
    @endif

@endsection
