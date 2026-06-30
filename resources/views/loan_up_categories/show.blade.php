@extends('layouts.app')

@section('title', 'Loan Up Category Details')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Loan Up Category Details</h4>
                <p class="text-muted mb-0">Full information of selected category</p>
            </div>

            <a href="{{ route('loan-up-categories.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="row">

                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Category Name</label>
                        <h5 class="fw-bold">{{ $loanUpCategory->name }}</h5>
                    </div>

                    <!-- Interest Rate -->
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Interest Rate</label>
                        <h5 class="fw-bold">
                            {{ number_format($loanUpCategory->interest_rate, 2) }} %
                        </h5>
                    </div>

                    <!-- Interest Type -->
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Interest Type</label>
                        <h5>
                            <span class="badge bg-info">
                                {{ $loanUpCategory->interest_type }}
                            </span>
                        </h5>
                    </div>

                    <!-- Duration -->
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Duration</label>
                        <h5 class="fw-bold">
                            {{ $loanUpCategory->duration }} {{ $loanUpCategory->duration_type }}
                        </h5>
                    </div>

                    <!-- Installment Type -->
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Installment Type</label>
                        <h5 class="fw-bold">
                            {{ $loanUpCategory->installment_type }}
                        </h5>
                    </div>

                    <!-- Processing Fee -->
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Processing Fee</label>
                        <h5 class="fw-bold">
                            {{ number_format($loanUpCategory->processing_fee, 2) }}
                        </h5>
                    </div>

                    <!-- Late Fee -->
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Late Fee</label>
                        <h5 class="fw-bold">
                            {{ number_format($loanUpCategory->late_fee, 2) }}
                        </h5>
                    </div>

                    <!-- Minimum Amount -->
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Minimum Amount</label>
                        <h5 class="fw-bold">
                            {{ number_format($loanUpCategory->minimum_amount, 2) }}
                        </h5>
                    </div>

                    <!-- Maximum Amount -->
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Maximum Amount</label>
                        <h5 class="fw-bold">
                            {{ number_format($loanUpCategory->maximum_amount, 2) }}
                        </h5>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="text-muted">Status</label>
                        <h5>
                            @if($loanUpCategory->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </h5>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12 mb-3">
                        <label class="text-muted">Description</label>
                        <p class="fw-semibold">
                            {{ $loanUpCategory->description ?? 'No description available' }}
                        </p>
                    </div>

                </div>

                <hr>

                <!-- Actions -->
                <a href="{{ route('loan-up-categories.edit', $loanUpCategory->id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit
                </a>

                <form action="{{ route('loan-up-categories.destroy', $loanUpCategory->id) }}"
                      method="POST"
                      class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this category?')">

                        <i class="bx bx-trash"></i> Delete
                    </button>

                </form>

                <a href="{{ route('loan-up-categories.index') }}" class="btn btn-secondary">
                    Back to List
                </a>

            </div>
        </div>

    </div>
</div>

@endsection