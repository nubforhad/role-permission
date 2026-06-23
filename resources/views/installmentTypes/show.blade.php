@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Installment Type Details</h4>
                <small class="text-muted">View full information</small>
            </div>

            <a class="btn btn-primary btn-sm" href="{{ route('installment-types.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body">

                <div class="row">

                    <!-- Type Name -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Type Name</label>
                        <div class="form-control bg-light">
                            {{ $installmentType->type_name }}
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Duration</label>
                        <div class="form-control bg-light">
                            {{ $installmentType->duration }} Days
                        </div>
                    </div>

                    <!-- Ins Code -->
                    <div class="col-md-12 mb-3">
                        <label class="fw-bold">Installment Code</label>
                        <div class="form-control bg-light">
                            {{ $installmentType->ins_code }}
                        </div>
                    </div>

                </div>

                <!-- Actions -->
                <div class="mt-3 d-flex gap-2">

                    <a href="{{ route('installment-types.edit', $installmentType->id) }}"
                       class="btn btn-primary btn-sm">
                        <i class="fa fa-pen-to-square"></i> Edit
                    </a>

                    <form action="{{ route('installment-types.destroy', $installmentType->id) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i> Delete
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection