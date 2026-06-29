@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Create Deposit Category</h4>
                <small class="text-muted">Add new deposit category</small>
            </div>

            <a class="btn btn-secondary btn-sm"
               href="{{ route('deposit-categories.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">

                <form action="{{ route('deposit-categories.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Installment Type</label>
                            <select name="installment_type_id" class="form-control">
                                <option value="">Select Type</option>
                                @foreach($installmentTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->type_name }} - {{ $type->duration }} days</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Interest Rate (%)</label>
                            <input type="number" step="0.01" name="interest_rate" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Deposit Type</label>
                            <select name="deposit_type" class="form-control" required>
                                <option value="fixed">Fixed</option>
                                <option value="flexible">Flexible</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Duration</label>
                            <input type="number" name="duration" class="form-control" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Duration Type</label>
                            <select name="duration_type" class="form-control" required>
                                <option value="day">Day</option>
                                <option value="month">Month</option>
                                <option value="year">Year</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Minimum Amount</label>
                            <input type="number" step="0.01" name="minimum_amount" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Maximum Amount</label>
                            <input type="number" step="0.01" name="maximum_amount" class="form-control" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Save Category
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection