@extends('layouts.main')

@section('container')
    <h1 class="mb-5">Post Categories</h1>

    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <a href="/blog?category={{ $category->name }}">
                        <div class="card text-bg-dark">
                            <img src="https://picsum.photos/300/300?random={{ $category->id }}" class="card-img"
                                alt="{{ $category->name }}">

                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title text-center flex-fill p-4 bg-dark opacity-75 fs-4">
                                    {{ $category->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
