@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit Installment Type</h4>
                <small class="text-muted">Update installment type information</small>
            </div>

            <a class="btn btn-primary btn-sm" href="{{ route('installment-types.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Error -->
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body">

                <form action="{{ route('installment-types.update', $installmentType->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Type Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Type Name</label>
                            <input type="text"
                                   name="type_name"
                                   class="form-control"
                                   value="{{ old('type_name', $installmentType->type_name) }}"
                                   required>
                        </div>

                        <!-- Duration -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duration (Days)</label>
                            <input type="number"
                                   name="duration"
                                   class="form-control"
                                   value="{{ old('duration', $installmentType->duration) }}"
                                   required>
                        </div>

                        <!-- Ins Code -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Installment Code</label>
                            <input type="text"
                                   name="ins_code"
                                   class="form-control"
                                   value="{{ old('ins_code', $installmentType->ins_code) }}"
                                   required>
                        </div>

                        <!-- Submit -->
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Update Installment Type
                            </button>
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection