@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Loan Details</h4>
                <small class="text-muted">View loan information</small>
            </div>

            <a href="{{ route('loan-sections.index') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">User</label>
                        <div class="form-control bg-light">
                            {{ $loanSection->user->name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Loan Category</label>
                        <div class="form-control bg-light">
                            {{ $loanSection->loanCategory->name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Installment Type</label>
                        <div class="form-control bg-light">
                            {{ $loanSection->installmentType->type_name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Branch</label>
                        <div class="form-control bg-light">
                            {{ $loanSection->branch->name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Total Installment </label>
                        <div class="form-control bg-light">
                            {{ $loanSection->total_installment ?? '0' }}
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Paid Per Installment</label>
                        <div class="form-control bg-light">
                            {{ $loanSection->paid_per_installment ?? '0' }}
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Loan Amount</label>
                        <div class="form-control bg-light">
                            {{ number_format($loanSection->loan_amount, 2) }}
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Interest (%)</label>
                        <div class="form-control bg-light">
                            {{ $loanSection->interest }}
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Total Amount</label>
                        <div class="form-control bg-light">
                            {{ number_format($loanSection->total_amount, 2) }}
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Loan Status</label>
                        <div class="form-control bg-light">

                            @if($loanSection->loan_status == 'approved')
                                <span class="badge bg-success">Approved</span>

                            @elseif($loanSection->loan_status == 'processing')
                                <span class="badge bg-info">Processing</span>

                            @elseif($loanSection->loan_status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>

                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif

                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Upline Status</label>
                        <div class="form-control bg-light">
                            {{ $loanSection->upline_status ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="fw-bold">Remark</label>
                        <div class="form-control bg-light" style="min-height:120px;">
                            {{ $loanSection->remark ?? 'N/A' }}
                        </div>
                    </div>

                </div>

                <div class="mt-3">

                    <a href="{{ route('loan-sections.edit', $loanSection->id) }}"
                       class="btn btn-primary btn-sm">
                        <i class="fa fa-pen-to-square"></i> Edit
                    </a>

                    <form action="{{ route('loan-sections.destroy', $loanSection->id) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection