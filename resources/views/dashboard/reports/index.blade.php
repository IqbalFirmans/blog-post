@extends('dashboard.layouts.main')

@section('title', 'Reports')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Menage Reports</h4>
        </div>

        <div class="card">
            <h5 class="card-header">Table Header & Footer</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Post</th>
                            <th>User</th>
                            <th>Reason</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }} .</td>
                                <td>{{ $report->post->title }}</td>
                                <td>
                                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $report->user->name }}</strong>
                                </td>
                                <td>{{ $report->reason }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#editReport-{{ $report->id }}">
                                            <span class="tf-icons bx bx-pencil"></span>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#smallModal-{{ $report->id }}">
                                            <span class="tf-icons bx bx-trash"></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editReport-{{ $report->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Edit Report</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('reports.update', $report->id) }}" method="post">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="reason" class="form-label">reason</label>
                                                        <input type="hidden" name="post_id" value="{{ $report->post->id }}">
                                                        <input type="text" id="reason" name="reason" class="form-control @error('reason') is-invalid @enderror" placeholder="Edit reason" value="{{ $report->reason }}" />

                                                        @error('reason')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="smallModal-{{ $report->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('reports.destroy', $report->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Are you sure?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
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
                                <td colspan="5" class="text-center text-secondary">Reports Not Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="table-border-bottom-0">
                        <tr>
                            <th>No</th>
                            <th>Post</th>
                            <th>User</th>
                            <th>Reason</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
