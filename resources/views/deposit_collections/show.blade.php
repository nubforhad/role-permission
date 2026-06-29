@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Collection Details</h4>
                <small class="text-muted">View deposit collection information</small>
            </div>

            <a href="{{ route('deposit-collections.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">

                <div class="row">

                    <!-- Collection No -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Collection No</label>
                        <p>{{ $depositCollection->collection_no }}</p>
                    </div>

                    <!-- Deposit No -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Deposit No</label>
                        <p>{{ $depositCollection->deposit->deposit_no ?? '-' }}</p>
                    </div>

                    <!-- Member -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Member</label>
                        <p>{{ $depositCollection->deposit->member->member_name ?? '-' }}</p>
                    </div>

                    <!-- Branch -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Branch</label>
                        <p>{{ $depositCollection->branch->name ?? '-' }}</p>
                    </div>

                    <!-- Amount -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Collection Amount</label>
                        <p>{{ number_format($depositCollection->collection_amount,2) }}</p>
                    </div>

                    <!-- Payment Method -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Payment Method</label>
                        <p>{{ ucfirst($depositCollection->payment_method) }}</p>
                    </div>

                    <!-- Date -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Collection Date</label>
                        <p>{{ \Carbon\Carbon::parse($depositCollection->collection_date)->format('d M Y') }}</p>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Status</label>

                        <p>
                            @if($depositCollection->status == 'completed')
                                <span class="badge bg-success">Completed</span>

                            @elseif($depositCollection->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>

                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </p>
                    </div>

                    <!-- Remark -->
                    <div class="col-md-12 mb-3">
                        <label class="fw-bold">Remark</label>
                        <p>{{ $depositCollection->remark ?? '-' }}</p>
                    </div>

                    <!-- Created By -->
                    <div class="col-md-6">
                        <label class="fw-bold">Created By</label>
                        <p>{{ $depositCollection->user->name ?? '-' }}</p>
                    </div>

                    <!-- Created At -->
                    <div class="col-md-6">
                        <label class="fw-bold">Created At</label>
                        <p>{{ $depositCollection->created_at->format('d M Y h:i A') }}</p>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection