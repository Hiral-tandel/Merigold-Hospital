@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Manage Reviews</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="width: 120px">Rating</th>
                                    <th>Comment</th>
                                    <th style="width: 100px">Status</th>
                                    <th style="width: 120px">Date</th>
                                    <th style="width: 150px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reviews as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->name }}</td>
                                        <td>{{ $review->email }}</td>
                                        <td>
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                        </td>
                                        <td>{{ $review->comment }}</td>
                                        <td>
                                            <span class="badge bg-{{ $review->status === 'approved' ? 'success' : ($review->status === 'rejected' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($review->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $review->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <form action="{{ route('admin.reviews.update-status', $review) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm d-inline-block" style="width: auto;" onchange="this.form.submit()">
                                                    <option value="pending" {{ $review->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved" {{ $review->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="rejected" {{ $review->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                                No reviews found
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 