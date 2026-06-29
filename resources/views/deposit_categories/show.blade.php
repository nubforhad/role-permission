@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Deposit Category Details</h4>
                <small class="text-muted">Full information of selected category</small>
            </div>

            <a class="btn btn-secondary btn-sm"
               href="{{ route('deposit-categories.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <strong>Name:</strong>
                        <p class="mb-0">{{ $depositCategory->name }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Code:</strong>
                        <p class="mb-0">{{ $depositCategory->code }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Installment Type:</strong>
                        <p class="mb-0">
                            {{ $depositCategory->installmentType->type_name ?? 'N/A' }}
                            ({{ $depositCategory->installmentType->ins_code ?? '' }})
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Interest Rate:</strong>
                        <p class="mb-0">{{ $depositCategory->interest_rate }} %</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Deposit Type:</strong>
                        <p class="mb-0">{{ ucfirst($depositCategory->deposit_type) }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Duration:</strong>
                        <p class="mb-0">
                            {{ $depositCategory->duration }}
                            {{ $depositCategory->duration_type }}
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Minimum Amount:</strong>
                        <p class="mb-0">{{ $depositCategory->minimum_amount }}</p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Maximum Amount:</strong>
                        <p class="mb-0">
                            {{ $depositCategory->maximum_amount ?? 'N/A' }}
                        </p>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Status:</strong>
                        <p class="mb-0">
                            @if($depositCategory->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </p>
                    </div>

                    <div class="col-md-12 mb-3">
                        <strong>Description:</strong>
                        <p class="mb-0">
                            {{ $depositCategory->description ?? 'No description' }}
                        </p>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="alert alert-info border-0">
                            <strong>Created By:</strong>
                            {{ $depositCategory->user->name ?? 'System' }}
                            <br>
                            <strong>Created At:</strong>
                            {{ $depositCategory->created_at->format('d M Y, h:i A') }}
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection