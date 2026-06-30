@extends('layouts.app')

@section('title', 'Loan Details')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Loan Details</h4>
                <p class="text-muted mb-0">Full information of this loan</p>
            </div>

            <a href="{{ route('loan-ups.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <div class="row">

            <!-- LEFT SIDE -->
            <div class="col-md-8">

                <div class="card shadow-sm mb-3">
                    <div class="card-body">

                        <h5 class="mb-3">Basic Information</h5>

                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">Member</label>
                                <h6>{{ $loanUp->member->name ?? 'N/A' }}</h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">Branch</label>
                                <h6>{{ $loanUp->branch->name ?? 'N/A' }}</h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">Category</label>
                                <h6>{{ $loanUp->category->name ?? 'N/A' }}</h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">Status</label>
                                <h6>
                                    @if($loanUp->status == 'Approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($loanUp->status == 'Pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($loanUp->status == 'Rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-info">{{ $loanUp->status }}</span>
                                    @endif
                                </h6>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="mb-3">Loan Breakdown</h5>

                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">Loan Amount</label>
                                <h6>{{ number_format($loanUp->loan_amount,2) }}</h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">Interest Rate</label>
                                <h6>{{ $loanUp->interest_rate }} %</h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">Total Interest</label>
                                <h6>{{ number_format($loanUp->total_interest,2) }}</h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">Total Payable</label>
                                <h6>{{ number_format($loanUp->total_payable,2) }}</h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">EMI Amount</label>
                                <h6>{{ number_format($loanUp->emi_amount,2) }}</h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">Duration</label>
                                <h6>{{ $loanUp->duration }} {{ $loanUp->duration_type }}</h6>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="text-muted">Installment Type</label>
                                <h6>{{ $loanUp->installment_type }}</h6>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-md-4">

                <div class="card shadow-sm mb-3">
                    <div class="card-body">

                        <h5 class="mb-3">Timeline</h5>

                        <p class="mb-1">
                            <span class="text-muted">Start Date:</span><br>
                            {{ $loanUp->start_date ?? 'Not Set' }}
                        </p>

                        <p class="mb-1">
                            <span class="text-muted">Approval Date:</span><br>
                            {{ $loanUp->approval_date ?? 'Not Approved Yet' }}
                        </p>

                        <p class="mb-1">
                            <span class="text-muted">Disbursement Date:</span><br>
                            {{ $loanUp->disbursement_date ?? 'Not Disbursed' }}
                        </p>

                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="mb-3">Actions</h5>

                        <a href="{{ route('loan-ups.edit', $loanUp->id) }}"
                           class="btn btn-warning w-100 mb-2">
                            <i class="bx bx-edit"></i> Edit Loan
                        </a>

                        <form action="{{ route('loan-ups.destroy', $loanUp->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger w-100"
                                    onclick="return confirm('Delete this loan?')">

                                <i class="bx bx-trash"></i> Delete Loan

                            </button>

                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection