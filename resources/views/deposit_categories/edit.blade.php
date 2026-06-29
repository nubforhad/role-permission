@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit Deposit Category</h4>
                <small class="text-muted">Update deposit category information</small>
            </div>

            <a class="btn btn-secondary btn-sm"
               href="{{ route('deposit-categories.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">

                <form action="{{ route('deposit-categories.update', $depositCategory->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ $depositCategory->name }}"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Code</label>
                            <input type="text"
                                   name="code"
                                   value="{{ $depositCategory->code }}"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Installment Type</label>
                            <select name="installment_type_id" class="form-control">
                                <option value="">Select Type</option>
                                @foreach($installmentTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ $depositCategory->installment_type_id == $type->id ? 'selected' : '' }}>
                                        {{ $type->type_name }} ({{ $type->ins_code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Interest Rate (%)</label>
                            <input type="number"
                                   step="0.01"
                                   name="interest_rate"
                                   value="{{ $depositCategory->interest_rate }}"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Deposit Type</label>
                            <select name="deposit_type" class="form-control">
                                <option value="daily" {{ $depositCategory->deposit_type == 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="weekly" {{ $depositCategory->deposit_type == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="monthly" {{ $depositCategory->deposit_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="fixed" {{ $depositCategory->deposit_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="savings" {{ $depositCategory->deposit_type == 'savings' ? 'selected' : '' }}>Savings</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Duration</label>
                            <input type="number"
                                   name="duration"
                                   value="{{ $depositCategory->duration }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Duration Type</label>
                            <select name="duration_type" class="form-control">
                                <option value="day" {{ $depositCategory->duration_type == 'day' ? 'selected' : '' }}>Day</option>
                                <option value="week" {{ $depositCategory->duration_type == 'week' ? 'selected' : '' }}>Week</option>
                                <option value="month" {{ $depositCategory->duration_type == 'month' ? 'selected' : '' }}>Month</option>
                                <option value="year" {{ $depositCategory->duration_type == 'year' ? 'selected' : '' }}>Year</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Minimum Amount</label>
                            <input type="number"
                                   step="0.01"
                                   name="minimum_amount"
                                   value="{{ $depositCategory->minimum_amount }}"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Maximum Amount</label>
                            <input type="number"
                                   step="0.01"
                                   name="maximum_amount"
                                   value="{{ $depositCategory->maximum_amount }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="3">{{ $depositCategory->description }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $depositCategory->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $depositCategory->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update Category
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection