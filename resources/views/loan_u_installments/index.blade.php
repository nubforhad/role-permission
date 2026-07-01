@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1">Loan Installments</h4>
                <small class="text-muted">All Loan Installment List</small>
            </div>

            <a href="{{ route('loan-u-installments.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Add Installment
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Loan ID</th>
                                <th>Installment</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Due Date</th>
                                <th>Paid Date</th>
                                <th>Status</th>
                                <th width="170">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($installments as $key => $row)

                                <tr>

                                    <td>{{ $key + 1 }}</td>

                                    <td>#{{ $row->loan_up_id }}</td>

                                    <td>{{ $row->installment_no }}</td>

                                    <td>{{ number_format($row->amount,2) }}</td>

                                    <td class="text-success">
                                        {{ number_format($row->paid_amount,2) }}
                                    </td>

                                    <td class="text-danger">
                                        {{ number_format($row->due_amount,2) }}
                                    </td>

                                    <td>
                                        {{ $row->due_date }}
                                    </td>

                                    <td>
                                        {{ $row->paid_date ?? '-' }}
                                    </td>

                                    <td>

                                        @if($row->status=='Pending')

                                            <span class="badge bg-warning">
                                                Pending
                                            </span>

                                        @elseif($row->status=='Partial')

                                            <span class="badge bg-info">
                                                Partial
                                            </span>

                                        @else

                                            <span class="badge bg-success">
                                                Paid
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('loan-u-installments.show',$row->id) }}"
                                            class="btn btn-sm btn-info">

                                            View

                                        </a>

                                        <a href="{{ route('loan-u-installments.edit',$row->id) }}"
                                            class="btn btn-sm btn-warning">

                                            Edit

                                        </a>

                                        <form action="{{ route('loan-u-installments.destroy',$row->id) }}"
                                            method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Delete this installment?')"
                                                class="btn btn-sm btn-danger">

                                                Delete

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="10" class="text-center">

                                        No Installment Found

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $installments->links() }}
                </div>

            </div>
        </div>

    </div>
</div>

@endsection