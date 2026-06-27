@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-0">Loan Collections</h4>
                <small class="text-muted">All installment collection records</small>
            </div>

            <a href="{{ route('loan-collections.create') }}" class="btn btn-primary">
                + Add Collection
            </a>
        </div>

        <!-- Table Card -->
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Loan ID</th>
                                <th>Member</th>
                                <th>Member Code</th>
                                <th>Installment</th>
                                <th>Paid</th>
                                <th>Penalty</th>
                                <th>Status</th>
                                <th>Employee</th>
                                <th>Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($collections as $key => $item)
                                <tr>
                                    <td>{{ $collections->firstItem() + $key }}</td>

                                    <td>
                                        <span class="badge bg-info">
                                            {{ $item->loan_section_id }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $item->member->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $item->member_code }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ number_format($item->installment_amount, 2) }}
                                    </td>

                                    <td>
                                        <span class="text-success fw-bold">
                                            {{ number_format($item->paid_amount, 2) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="text-danger">
                                            {{ number_format($item->penalty_charge, 2) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($item->status == 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @elseif($item->status == 'partial')
                                            <span class="badge bg-warning text-dark">Partial</span>
                                        @elseif($item->status == 'late')
                                            <span class="badge bg-danger">Late</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $item->employee->name ?? 'System' }}
                                    </td>

                                    <td>
                                        {{ $item->installment_date ? date('d M Y', strtotime($item->installment_date)) : '-' }}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('loan-collections.show', $item->id) }}" class="btn btn-sm btn-info">
                                            View
                                        </a>

                                        <a href="#" class="btn btn-sm btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center text-muted">
                                        No collection found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $collections->links() }}
                </div>

            </div>
        </div>

    </div>
</div>

@endsection