@extends('layouts.app')

@section('title', 'Loans')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Loan List</h4>
                <p class="text-muted mb-0">Manage all loans</p>
            </div>

            <a href="{{ route('loan-ups.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Create Loan
            </a>
        </div>

        <!-- Card -->
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle" id="datatable">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Member</th>
                                <th>Branch</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>EMI</th>
                                <th>Interest</th>
                                <th>Total Payable</th>
                                <th>Status</th>
                                <th width="160">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($loans as $key => $loan)

                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <!-- Member -->
                                    <td>
                                        <strong>
                                            {{ $loan->member->name ?? 'N/A' }}
                                        </strong>
                                    </td>

                                    <!-- Branch -->
                                    <td>
                                        {{ $loan->branch->name ?? 'N/A' }}
                                    </td>

                                    <!-- Category -->
                                    <td>
                                        {{ $loan->category->name ?? 'N/A' }}
                                    </td>

                                    <!-- Amount -->
                                    <td>
                                        {{ number_format($loan->loan_amount,2) }}
                                    </td>

                                    <!-- EMI -->
                                    <td>
                                        {{ number_format($loan->emi_amount,2) }}
                                    </td>

                                    <!-- Interest -->
                                    <td>
                                        {{ number_format($loan->total_interest,2) }}
                                    </td>

                                    <!-- Total -->
                                    <td>
                                        {{ number_format($loan->total_payable,2) }}
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        @if($loan->status == 'Approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($loan->status == 'Pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($loan->status == 'Rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-info">{{ $loan->status }}</span>
                                        @endif
                                    </td>

                                    <!-- Action -->
                                    <td>

                                        <a href="{{ route('loan-ups.show', $loan->id) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        <a href="{{ route('loan-ups.edit', $loan->id) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </a>

                                        <form action="{{ route('loan-ups.destroy', $loan->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this loan?')">

                                                <i class="bx bx-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="10" class="text-center text-muted">
                                        No Loan Found
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