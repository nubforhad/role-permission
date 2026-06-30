@extends('layouts.app')

@section('title', 'Edit Loan Up Category')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Edit Loan Up Category</h4>
                <p class="text-muted mb-0">Update loan up category information.</p>
            </div>

            <a href="{{ route('loan-up-categories.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('loan-up-categories.update', $loanUpCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Category Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $loanUpCategory->name) }}"
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
                                   value="{{ old('interest_rate', $loanUpCategory->interest_rate) }}"
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

                                <option value="Flat" {{ old('interest_type', $loanUpCategory->interest_type) == 'Flat' ? 'selected' : '' }}>
                                    Flat
                                </option>

                                <option value="Reducing" {{ old('interest_type', $loanUpCategory->interest_type) == 'Reducing' ? 'selected' : '' }}>
                                    Reducing
                                </option>

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
                                   value="{{ old('duration', $loanUpCategory->duration) }}">

                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Duration Type -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Duration Type</label>
                            <select name="duration_type"
                                    class="form-select @error('duration_type') is-invalid @enderror">

                                @foreach(['Day','Week','Month','Year'] as $type)
                                    <option value="{{ $type }}"
                                        {{ old('duration_type', $loanUpCategory->duration_type) == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach

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

                                @foreach(['Daily','Weekly','Monthly','Quarterly','Yearly'] as $type)
                                    <option value="{{ $type }}"
                                        {{ old('installment_type', $loanUpCategory->installment_type) == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach

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
                                   value="{{ old('processing_fee', $loanUpCategory->processing_fee) }}">
                        </div>

                        <!-- Late Fee -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Late Fee</label>

                            <input type="number"
                                   step="0.01"
                                   name="late_fee"
                                   class="form-control"
                                   value="{{ old('late_fee', $loanUpCategory->late_fee) }}">
                        </div>

                        <!-- Minimum Amount -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Minimum Amount</label>

                            <input type="number"
                                   step="0.01"
                                   name="minimum_amount"
                                   class="form-control"
                                   value="{{ old('minimum_amount', $loanUpCategory->minimum_amount) }}">
                        </div>

                        <!-- Maximum Amount -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Maximum Amount</label>

                            <input type="number"
                                   step="0.01"
                                   name="maximum_amount"
                                   class="form-control"
                                   value="{{ old('maximum_amount', $loanUpCategory->maximum_amount) }}">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>

                            <select name="status" class="form-select">
                                <option value="1" {{ old('status', $loanUpCategory->status) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="0" {{ old('status', $loanUpCategory->status) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>

                            <textarea name="description"
                                      rows="4"
                                      class="form-control"
                                      placeholder="Write description...">{{ old('description', $loanUpCategory->description) }}</textarea>
                        </div>

                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Update Category
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