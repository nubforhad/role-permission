@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Role Details</h4>
                <small class="text-muted">View role information</small>
            </div>

            <a class="btn btn-outline-primary btn-sm"
               href="{{ route('roles.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">

                <!-- Role Name -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Role Name</label>
                    <div class="form-control bg-light">
                        {{ $role->name }}
                    </div>
                </div>

                <!-- Permissions -->
                <div class="mb-3">
                    <label class="form-label fw-semibold mb-2">Permissions</label>

                    <div class="row g-2">
                        @foreach($permissions as $value)
                            <div class="col-md-4 col-sm-6">
                                <div class="border rounded p-2 bg-light d-flex align-items-center">

                                    <input class="form-check-input me-2"
                                           type="checkbox"
                                           disabled
                                           {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>

                                    <label class="form-check-label mb-0">
                                        {{ $value->name }}
                                    </label>

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection