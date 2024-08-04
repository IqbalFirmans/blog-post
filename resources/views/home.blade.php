@extends('layouts.main')

@section('container')
    <div class="container">
        @auth
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Welcome, {{ $user->name }}!</h5>
                            <p class="card-text">You are logged in.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
        <div class="row justify-content-center mt-4">
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Posts</h5>
                        <p class="card-text">{{ $postCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Categories</h5>
                        <p class="card-text">{{ $categoryCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card  mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Authors</h5>
                        <p class="card-text">{{ $authorCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
