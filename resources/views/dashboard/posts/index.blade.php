@extends('dashboard.layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Menage Post</h4>

            <div class="demo-inline-spacing">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPost">
                    Create
                </button>


            </div>
        </div>

        <div class="card">
            <h5 class="card-header">Table Header & Footer</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $post->title }}</strong>
                                </td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->tags->pluck('name')->implode(', ') }}</td>
                                <td>
                                    <img src="storage/{{ $post->image }}" alt="{{ $post->title }}" width="80"
                                        height="50">
                                </td>
                                <td>{{ Str::limit($post->content, 30) }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-icon btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editPost-{{ $post->id }}">
                                            <span class="tf-icons bx bx-pencil"></span>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#smallModal-{{ $post->id }}">
                                            <span class="tf-icons bx bx-trash"></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editPost-{{ $post->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Edit Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('posts.update', $post->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" id="title" name="title"
                                                            class="form-control @error('title') is-invalid @enderror"
                                                            placeholder="Enter Title" value="{{ $post->title }}" />

                                                        @error('title')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col mb-0">
                                                        <input type="hidden" name="oldImage" value="{{ $post->imagexxxxx }}">
                                                        <label for="image" class="form-label">Image</label>
                                                        <input type="file" id="image" name="image"
                                                            class="form-control @error('image') is-invalid @enderror" />

                                                        @error('image')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col mb-3">

                                                        <label for="category" class="form-label">Select Category</label>
                                                        <select class="form-select" id="category" name="category_id">
                                                            <option selected disabled>- Select Category -</option>
                                                            @forelse ($categories as $category)
                                                                <option
                                                                    {{ $post->category_id == $category->id ? 'selected' : '' }}
                                                                    value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @empty
                                                                <option disabled>Category Not Available</option>
                                                            @endforelse
                                                        </select>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="content" class="form-label">Content</label>
                                                            <textarea type="text" id="content" name="content" class="form-control @error('content') is-invalid @enderror"
                                                                placeholder="Enter Content">{{ $post->content }}</textarea>

                                                            @error('content')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col mb-0">
                                                            <label class="form-label">Tags : </label>
                                                            @forelse ($tags as $tag)
                                                                <div class="form-check form-check-inline mt-3">

                                                                    <input class="form-check-input  @error('tags') is-invalid @enderror"
                                                                        type="checkbox" name="tags[]"
                                                                        value="{{ $tag->id }}"
                                                                        id="check-{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'checked' : '' }} />
                                                                    <label class="form-check-label" for="check-{{ $tag->id }}"> {{ $tag->name }} </label>
                                                                </div>
                                                            @empty
                                                                <br>
                                                                <span>Tag not Available</span>
                                                            @endforelse
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!-- Delete Modal -->
                            <div class="modal fade" id="smallModal-{{ $post->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Are you sure?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-secondary">Posts Not Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="table-border-bottom-0">
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Bootstrap Table with Header - Footer -->
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="addPost" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" name="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title"
                                    value="{{ old('title') }}" />

                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" id="image" name="image"
                                    class="form-control @error('image') is-invalid @enderror" />

                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col mb-3">

                                <label for="category" class="form-label">Select Category</label>
                                <select class="form-select" id="category" name="category_id">
                                    <option selected disabled>- Select Category -</option>
                                    @forelse ($categories as $category)
                                        <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                        <option disabled>Category Not Available</option>
                                    @endforelse
                                </select>

                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea type="text" id="content" name="content" class="form-control @error('content') is-invalid @enderror"
                                        placeholder="Enter Content">{{ old('content') }}</textarea>

                                    @error('content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-0">
                                    <label class="form-label">Tags : </label>
                                    @forelse ($tags as $tag)
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input  @error('tags') is-invalid @enderror"
                                                type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                id="check-{{ $tag->id }}" />
                                            <label class="form-check-label" for="check-{{ $tag->id }}">
                                                {{ $tag->name }} </label>
                                        </div>
                                    @empty
                                        <br>
                                        <span>Tag not Available</span>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
