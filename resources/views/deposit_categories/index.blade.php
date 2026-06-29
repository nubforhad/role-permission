@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Deposit Categories</h4>
                <small class="text-muted">Manage all deposit categories</small>
            </div>

            <a class="btn btn-success btn-sm"
               href="{{ route('deposit-categories.create') }}">
                <i class="fa fa-plus"></i> Create New Category
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-primary">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Interest (%)</th>
                                <th>Type</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $category->name }}</td>
                                <td>{{ $category->code }}</td>
                                <td>{{ $category->interest_rate }}</td>
                                <td>{{ $category->deposit_type }}</td>

                                <td>
                                    {{ $category->duration }} {{ $category->duration_type }}
                                </td>

                                <td>
                                    @if($category->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td class="text-center">

                                    <form action="{{ route('deposit-categories.destroy', $category->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        <a class="btn btn-info btn-sm"
                                           href="{{ route('deposit-categories.show', $category->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a class="btn btn-primary btn-sm"
                                           href="{{ route('deposit-categories.edit', $category->id) }}">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>

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

        <div class="mt-3">
            {!! $categories->links('pagination::bootstrap-5') !!}
        </div>

    </div>
</div>

@endsection