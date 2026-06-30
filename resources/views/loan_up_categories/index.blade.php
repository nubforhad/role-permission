@extends('layouts.app')

@section('title', 'Loan Up Categories')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 fw-bold">Loan Up Categories</h4>
                <p class="text-muted mb-0">Manage all loan up categories.</p>
            </div>

            <a href="{{ route('loan-up-categories.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Add Loan Up Category
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">

                <div class="table-responsive">

                    <table id="datatable" class="table table-bordered table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th>Name</th>
                                <th>Interest</th>
                                <th>Type</th>
                                <th>Duration</th>
                                <th>Installment</th>
                                <th>Min Amount</th>
                                <th>Max Amount</th>
                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($loanUpCategories as $key => $category)

                            <tr>

                                <td>{{ $key + 1 }}</td>

                                <td>
                                    <strong>{{ $category->name }}</strong>
                                </td>

                                <td>
                                    {{ number_format($category->interest_rate,2) }} %
                                </td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $category->interest_type }}
                                    </span>
                                </td>

                                <td>
                                    {{ $category->duration }}
                                    {{ $category->duration_type }}
                                </td>

                                <td>
                                    {{ $category->installment_type }}
                                </td>

                                <td>
                                    {{ number_format($category->minimum_amount,2) }}
                                </td>

                                <td>
                                    {{ number_format($category->maximum_amount,2) }}
                                </td>

                                <td>

                                    @if($category->status)

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a href="{{ route('loan-up-categories.show',$category->id) }}"
                                       class="btn btn-sm btn-info">
                                        <i class="bx bx-show"></i>
                                    </a>

                                    <a href="{{ route('loan-up-categories.edit',$category->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="bx bx-edit"></i>
                                    </a>

                                    <form action="{{ route('loan-up-categories.destroy',$category->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Are you sure you want to delete this category?')"
                                            class="btn btn-sm btn-danger">

                                            <i class="bx bx-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="10" class="text-center text-muted">
                                    No Data Found
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection 
