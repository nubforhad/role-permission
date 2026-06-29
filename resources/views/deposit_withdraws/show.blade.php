@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Withdraw Details</h4>
                <small class="text-muted">View withdraw information</small>
            </div>

            <a href="{{ route('deposit-withdraws.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">

                <div class="row">

                    <!-- Withdraw No -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Withdraw No</label>
                        <p>{{ $depositWithdraw->withdraw_no }}</p>
                    </div>

                    <!-- Deposit No -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Deposit No</label>
                        <p>{{ $depositWithdraw->deposit->deposit_no ?? '-' }}</p>
                    </div>

                    <!-- Member -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Member</label>
                        <p>{{ $depositWithdraw->deposit->member->member_name ?? '-' }}</p>
                    </div>

                    <!-- Branch -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Branch</label>
                        <p>{{ $depositWithdraw->branch->name ?? '-' }}</p>
                    </div>

                    <!-- Amount -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Withdraw Amount</label>
                        <p>{{ number_format($depositWithdraw->withdraw_amount,2) }}</p>
                    </div>

                    <!-- Payment Method -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Payment Method</label>
                        <p>{{ ucfirst($depositWithdraw->payment_method) }}</p>
                    </div>

                    <!-- Date -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Withdraw Date</label>
                        <p>
                            {{ \Carbon\Carbon::parse($depositWithdraw->withdraw_date)->format('d M Y') }}
                        </p>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Status</label>

                        <p>
                            @if($depositWithdraw->status == 'completed')
                                <span class="badge bg-success">Completed</span>

                            @elseif($depositWithdraw->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>

                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </p>
                    </div>

                    <!-- Remark -->
                    <div class="col-md-12 mb-3">
                        <label class="fw-bold">Remark</label>
                        <p>{{ $depositWithdraw->remark ?? '-' }}</p>
                    </div>

                    <!-- Created By -->
                    <div class="col-md-6">
                        <label class="fw-bold">Created By</label>
                        <p>{{ $depositWithdraw->user->name ?? '-' }}</p>
                    </div>

                    <!-- Created At -->
                    <div class="col-md-6">
                        <label class="fw-bold">Created At</label>
                        <p>{{ $depositWithdraw->created_at->format('d M Y h:i A') }}</p>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection