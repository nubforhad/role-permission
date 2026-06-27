 
@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">Loan Collection Details</h4>
                <small class="text-muted">View collection information</small>
            </div>

            <a href="{{ route('loan-collections.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    Collection #{{ $loanCollection->id }}
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Loan ID</label>
                        <p>{{ $loanCollection->loan_section_id }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Member Name</label>
                        <p>{{ $loanCollection->member->name ?? 'N/A' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Member Code</label>
                        <p>{{ $loanCollection->member_code }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Collected By</label>
                        <p>{{ $loanCollection->employee->name ?? 'N/A' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Installment Amount</label>
                        <p>{{ number_format($loanCollection->installment_amount,2) }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Paid Amount</label>
                        <p>{{ number_format($loanCollection->paid_amount,2) }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Penalty Charge</label>
                        <p>{{ number_format($loanCollection->penalty_charge,2) }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Installment Date</label>
                        <p>{{ $loanCollection->installment_date ?? '-' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Paid Date</label>
                        <p>{{ $loanCollection->paid_date ?? '-' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Expire Date</label>
                        <p>{{ $loanCollection->expire_date ?? '-' }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Status</label>

                        @if($loanCollection->status=='paid')
                            <span class="badge bg-success">Paid</span>

                        @elseif($loanCollection->status=='partial')
                            <span class="badge bg-warning text-dark">Partial</span>

                        @elseif($loanCollection->status=='late')
                            <span class="badge bg-danger">Late</span>

                        @else
                            <span class="badge bg-secondary">Pending</span>
                        @endif

                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="fw-bold">Remark</label>
                        <p>{{ $loanCollection->remark ?? 'No Remark' }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Created At</label>
                        <p>{{ $loanCollection->created_at->format('d M Y h:i A') }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="fw-bold">Updated At</label>
                        <p>{{ $loanCollection->updated_at->format('d M Y h:i A') }}</p>
                    </div>

                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('loan-collections.edit',$loanCollection->id) }}"
                   class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit
                </a>

                <a href="{{ route('loan-collections.download-pdf') }}"
                   class="btn btn-secondary">
                    Download
                </a>
                <a href="{{ route('loan-collections.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>
            </div>

        </div>

    </div>
</div>

@endsection
 
