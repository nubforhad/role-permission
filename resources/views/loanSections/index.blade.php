@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Loan Sections</h4>
                <small class="text-muted">Manage all loan applications</small>
            </div>

            <a class="btn btn-success btn-sm" href="{{ route('loan-sections.create') }}">
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
                                <th>By Employee </th>
                                <th>Member Code</th>
                                <th>Category</th>
                                <th>Installment</th>
                                <th>Total Installment</th>
                                <th>Paid Per Installment</th>
                                <th>Branch</th>
                                <th>Loan Amount</th>
                                <th>Interest</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($loans as $key => $loan)
                                <tr>

                                    <!-- Serial -->
                                    <td>
                                        {{ $loans->firstItem() + $key }}
                                    </td>

                                    <!-- User -->
                                    <td>
                                        {{ $loan->user->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $loan->member_code  ?? 'N/A' }}
                                    </td>

                                    <!-- Category -->
                                    <td>
                                        {{ $loan->loanCategory->name ?? 'N/A' }}
                                    </td>

                                    <!-- Installment -->
                                    <td>
                                        {{ $loan->installmentType->type_name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $loan->total_installment ?? '0' }}
                                    </td>
                                    <td>
                                         {{ number_format($loan->paid_per_installment, 2) }}
                                    </td>
                                    

                                    <!-- Branch -->
                                    <td>
                                        {{ $loan->branch->name ?? 'N/A' }}
                                    </td>

                                    <!-- Loan Amount -->
                                    <td>
                                        {{ number_format($loan->loan_amount, 2) }}
                                    </td>

                                    <!-- Interest -->
                                    <td>
                                        {{ $loan->interest }}%
                                    </td>

                                    <!-- Total -->
                                    <td>
                                        {{ number_format($loan->total_amount, 2) }}
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            {{ $loan->loan_status }}
                                        </span>
                                    </td>

                                    <!-- Action -->
                                    <td class="text-center">

                                        <a href="{{ route('loan-sections.show', $loan->id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('loan-sections.edit', $loan->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ route('loan-sections.destroy', $loan->id) }}"
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
            {!! $loans->links('pagination::bootstrap-5') !!}
        </div>

    </div>
</div>

@endsection