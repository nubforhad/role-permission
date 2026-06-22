@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit Thana</h4>
                <small class="text-muted">Update thana information</small>
            </div>

            <a href="{{ route('thanas.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <strong>Whoops!</strong> Please fix the errors below.
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body p-4">

                <form action="{{ route('thanas.update', $thana->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- District -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">District</label>
                            <select name="district_id" class="form-select form-select-lg">

                                <option value="">Select District</option>

                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ $thana->district_id == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Thana Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Thana Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ $thana->name }}"
                                   class="form-control form-control-lg"
                                   placeholder="Enter thana name">
                        </div>

                        <!-- Title -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text"
                                   name="title"
                                   value="{{ $thana->title }}"
                                   class="form-control form-control-lg"
                                   placeholder="Enter title (optional)">
                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Update Thana
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection