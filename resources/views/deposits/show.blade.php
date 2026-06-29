@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Deposit Details</h4>
                <small class="text-muted">View deposit information</small>
            </div>

            <a href="{{ route('deposits.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Deposit No</label>
                        <p>{{ $deposit->deposit_no }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Member Code</label>
                        <p>{{ $deposit->member_code }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Member Name</label>
                        <p>{{ $deposit->member->member_name ?? '-' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Branch</label>
                        <p>{{ $deposit->branch->name ?? '-' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Deposit Category</label>
                        <p>{{ $deposit->category->name ?? '-' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Deposit Amount</label>
                        <p>{{ number_format($deposit->deposit_amount,2) }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Interest Rate</label>
                        <p>{{ $deposit->interest_rate }} %</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Interest Amount</label>
                        <p>{{ number_format($deposit->interest_amount,2) }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Total Amount</label>
                        <p>{{ number_format($deposit->total_amount,2) }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Paid Amount</label>
                        <p>{{ number_format($deposit->paid_amount,2) }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Due Amount</label>
                        <p>{{ number_format($deposit->due_amount,2) }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Start Date</label>
                        <p>{{ \Carbon\Carbon::parse($deposit->start_date)->format('d M Y') }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Maturity Date</label>
                        <p>
                            {{ $deposit->maturity_date ? \Carbon\Carbon::parse($deposit->maturity_date)->format('d M Y') : '-' }}
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Status</label>
                        <p>
                            @switch($deposit->status)

                                @case('running')
                                    <span class="badge bg-primary">Running</span>
                                    @break

                                @case('completed')
                                    <span class="badge bg-success">Completed</span>
                                    @break

                                @case('closed')
                                    <span class="badge bg-warning text-dark">Closed</span>
                                    @break

                                @case('cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                    @break

                                @default
                                    <span class="badge bg-secondary">{{ $deposit->status }}</span>

                            @endswitch
                        </p>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="fw-bold">Remark</label>
                        <p>{{ $deposit->remark ?? '-' }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Created At</label>
                        <p>{{ $deposit->created_at->format('d M Y h:i A') }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Updated At</label>
                        <p>{{ $deposit->updated_at->format('d M Y h:i A') }}</p>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection