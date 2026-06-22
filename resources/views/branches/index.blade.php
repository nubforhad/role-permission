@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Branches</h4>
                <small class="text-muted">Manage all branches</small>
            </div>

            <a href="{{ route('branches.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Create Branch
            </a>
        </div>

        <!-- Success -->
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>District</th>
                                <th>Thana</th>
                                <th>Address</th>
                                <th>Title</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($branches as $key => $branch)
                                <tr>

                                    <!-- Serial -->
                                    <td>
                                        {{ $branches->firstItem() + $key }}
                                    </td>

                                    <!-- Name -->
                                    <td class="fw-semibold">
                                        {{ $branch->name }}
                                    </td>

                                    <!-- District -->
                                    <td>
                                        {{ $branch->district->name ?? '-' }}
                                    </td>

                                    <!-- Thana -->
                                    <td>
                                        {{ $branch->thana->name ?? '-' }}
                                    </td>

                                    <!-- Address -->
                                    <td>
                                        {{ Str::limit($branch->address, 40) }}
                                    </td>

                                    <!-- Title -->
                                    <td>
                                        {{ $branch->title ?? '-' }}
                                    </td>

                                    <!-- Action -->
                                    <td class="text-center">

                                        <a href="{{ route('branches.show', $branch->id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('branches.edit', $branch->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form action="{{ route('branches.destroy', $branch->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </form>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        No branches found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {!! $branches->links('pagination::bootstrap-5') !!}
        </div>

    </div>
</div>

@endsection