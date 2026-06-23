@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Loan Categories</h4>
                <small class="text-muted">Manage all loan categories</small>
            </div>

            <a class="btn btn-success btn-sm" href="{{ route('loan-categories.create') }}">
                <i class="fa fa-plus"></i> Create New
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
                                <th>Name</th>
                                <th>Title</th>
                                <th>Details</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($categories as $key => $category)
                                <tr>

                                    <!-- Serial -->
                                    <td>
                                        {{ $categories->firstItem() + $key }}
                                    </td>

                                    <!-- Name -->
                                    <td class="fw-semibold">
                                        {{ $category->name }}
                                    </td>

                                    <!-- Title -->
                                    <td>
                                        {{ $category->title }}
                                    </td>

                                    <!-- Details -->
                                    <td>
                                        {{ \Illuminate\Support\Str::limit($category->details, 60) }}
                                    </td>

                                    <!-- Action -->
                                    <td class="text-center">

                                        <a href="{{ route('loan-categories.show', $category->id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('loan-categories.edit', $category->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ route('loan-categories.destroy', $category->id) }}"
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
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {!! $categories->links('pagination::bootstrap-5') !!}
        </div>

    </div>
</div>

@endsection