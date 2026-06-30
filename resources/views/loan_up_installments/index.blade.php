@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">Loan Up Installments</h4>
                <small class="text-muted">All installment records</small>
            </div>

            <a href="{{ route('loanup.installment.create') }}" class="btn btn-primary">
                + Add Installment
            </a>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Loan</th>
                                <th>Installment No</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($installments as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>
                                        {{ $item->loan->title ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <span class="badge bg-info">
                                            {{ $item->installment_no }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ number_format($item->amount, 2) }}
                                    </td>

                                    <td class="text-success">
                                        {{ number_format($item->paid_amount, 2) }}
                                    </td>

                                    <td class="text-danger">
                                        {{ number_format($item->due_amount, 2) }}
                                    </td>

                                    <td>
                                        {{ $item->due_date }}
                                    </td>

                                    <td>
                                        @if($item->status == 'Paid')
                                            <span class="badge bg-success">Paid</span>
                                        @elseif($item->status == 'Partial')
                                            <span class="badge bg-warning text-dark">Partial</span>
                                        @else
                                            <span class="badge bg-danger">Pending</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('loanup.installment.show', $item->id) }}"
                                           class="btn btn-sm btn-info">
                                            View
                                        </a>

                                        <a href="{{ route('loanup.installment.edit', $item->id) }}"
                                           class="btn btn-sm btn-primary">
                                            Edit
                                        </a>

                                        <a href="{{ route('loanup.installment.destroy', $item->id) }}"
                                           onclick="return confirm('Are you sure?')"
                                           class="btn btn-sm btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">
                                        No installments found
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