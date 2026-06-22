@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Thana Details</h4>
                <small class="text-muted">View thana information</small>
            </div>

            <a href="{{ route('thanas.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body p-4">

                <div class="row g-3">

                    <!-- District -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">District</small>
                            <h5 class="mb-0 fw-bold">
                                {{ $thana->district->name ?? 'N/A' }}
                            </h5>
                        </div>
                    </div>

                    <!-- Thana Name -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Thana Name</small>
                            <h5 class="mb-0 fw-bold">{{ $thana->name }}</h5>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="col-md-12">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Title</small>
                            <h6 class="mb-0">{{ $thana->title ?? 'N/A' }}</h6>
                        </div>
                    </div>

                    <!-- Created -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Created At</small>
                            <h6 class="mb-0">{{ $thana->created_at }}</h6>
                        </div>
                    </div>

                    <!-- Updated -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Updated At</small>
                            <h6 class="mb-0">{{ $thana->updated_at }}</h6>
                        </div>
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-4">

                    <a href="{{ route('thanas.edit', $thana->id) }}"
                       class="btn btn-primary px-4 me-2">
                        <i class="fa fa-edit me-1"></i> Edit
                    </a>

                    <a href="{{ route('thanas.index') }}"
                       class="btn btn-secondary px-4">
                        Back
                    </a>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection