@extends('layouts.app')

@section('title', 'Create Loan Up Category')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Create Loan Up Category</h4>
                <p class="text-muted mb-0">Add a new loan up category.</p>
            </div>

            <a href="{{ route('loan-up-categories.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('loan-up-categories.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- Category Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   placeholder="Enter category name">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Interest Rate -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Interest Rate (%) <span class="text-danger">*</span></label>
                            <input type="number"
                                   step="0.01"
                                   name="interest_rate"
                                   class="form-control @error('interest_rate') is-invalid @enderror"
                                   value="{{ old('interest_rate') }}"
                                   placeholder="0.00">

                            @error('interest_rate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Interest Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Interest Type</label>
                            <select name="interest_type"
                                    class="form-select @error('interest_type') is-invalid @enderror">
                                <option value="">Select Type</option>
                                <option value="Flat" {{ old('interest_type') == 'Flat' ? 'selected' : '' }}>Flat</option>
                                <option value="Reducing" {{ old('interest_type') == 'Reducing' ? 'selected' : '' }}>Reducing</option>
                            </select>

                            @error('interest_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duration -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Duration</label>
                            <input type="number"
                                   name="duration"
                                   class="form-control @error('duration') is-invalid @enderror"
                                   value="{{ old('duration') }}"
                                   placeholder="12">

                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duration Type -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Duration Type</label>
                            <select name="duration_type"
                                    class="form-select @error('duration_type') is-invalid @enderror">

                                <option value="Day" {{ old('duration_type') == 'Day' ? 'selected' : '' }}>Day</option>
                                <option value="Week" {{ old('duration_type') == 'Week' ? 'selected' : '' }}>Week</option>
                                <option value="Month" {{ old('duration_type','Month') == 'Month' ? 'selected' : '' }}>Month</option>
                                <option value="Year" {{ old('duration_type') == 'Year' ? 'selected' : '' }}>Year</option>

                            </select>

                            @error('duration_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Installment Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Installment Type</label>

                            <select name="installment_type"
                                    class="form-select @error('installment_type') is-invalid @enderror">

                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly" selected>Monthly</option>
                                <option value="Quarterly">Quarterly</option>
                                <option value="Yearly">Yearly</option>

                            </select>

                            @error('installment_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Processing Fee -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Processing Fee</label>

                            <input type="number"
                                   step="0.01"
                                   name="processing_fee"
                                   class="form-control"
                                   value="{{ old('processing_fee',0) }}">
                        </div>

                        <!-- Late Fee -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Late Fee</label>

                            <input type="number"
                                   step="0.01"
                                   name="late_fee"
                                   class="form-control"
                                   value="{{ old('late_fee',0) }}">
                        </div>

                        <!-- Minimum Amount -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Minimum Amount</label>

                            <input type="number"
                                   step="0.01"
                                   name="minimum_amount"
                                   class="form-control"
                                   value="{{ old('minimum_amount') }}">
                        </div>

                        <!-- Maximum Amount -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Maximum Amount</label>

                            <input type="number"
                                   step="0.01"
                                   name="maximum_amount"
                                   class="form-control"
                                   value="{{ old('maximum_amount') }}">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>

                            <select name="status" class="form-select">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>

                            <textarea name="description"
                                      rows="4"
                                      class="form-control"
                                      placeholder="Write description...">{{ old('description') }}</textarea>
                        </div>

                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Save Category
                    </button>

                    <button type="reset" class="btn btn-warning">
                        <i class="bx bx-reset"></i> Reset
                    </button>

                    <a href="{{ route('loan-up-categories.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection 
