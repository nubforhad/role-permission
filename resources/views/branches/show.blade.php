@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Branch Details</h4>
                <small class="text-muted">View branch information</small>
            </div>

            <a href="{{ route('branches.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body p-4">

                <div class="row g-3">

                    <!-- Branch Name -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Branch Name</small>
                            <h5 class="mb-0 fw-bold">{{ $branch->name }}</h5>
                        </div>
                    </div>

                    <!-- District -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">District</small>
                            <h5 class="mb-0 fw-bold">
                                {{ $branch->district->name ?? 'N/A' }}
                            </h5>
                        </div>
                    </div>

                    <!-- Thana -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Thana</small>
                            <h5 class="mb-0 fw-bold">
                                {{ $branch->thana->name ?? 'N/A' }}
                            </h5>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Title</small>
                            <h6 class="mb-0">{{ $branch->title ?? '-' }}</h6>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-md-12">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Address</small>
                            <h6 class="mb-0">{{ $branch->address ?? '-' }}</h6>
                        </div>
                    </div>

                    <!-- Created At -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Created At</small>
                            <h6 class="mb-0">{{ $branch->created_at }}</h6>
                        </div>
                    </div>

                    <!-- Updated At -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Updated At</small>
                            <h6 class="mb-0">{{ $branch->updated_at }}</h6>
                        </div>
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-4">

                    <a href="{{ route('branches.edit', $branch->id) }}"
                       class="btn btn-primary px-4 me-2">
                        <i class="fa fa-edit me-1"></i> Edit
                    </a>

                    <a href="{{ route('branches.index') }}"
                       class="btn btn-secondary px-4">
                        Back
                    </a>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection