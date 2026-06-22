@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit Branch</h4>
                <small class="text-muted">Update branch information</small>
            </div>

            <a href="{{ route('branches.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Errors -->
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

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body p-4">

                <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- District (Step 1 - reload based) -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">District</label>

                            <select name="district_id"
                                    class="form-select form-select-lg"
                                    onchange="this.form.submit()">

                                <option value="">Select District</option>

                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ $branch->district_id == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Thana -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Thana</label>

                            <select name="thana_id" class="form-select form-select-lg">

                                <option value="">Select Thana</option>

                                @foreach($thanas as $thana)
                                    <option value="{{ $thana->id }}"
                                        {{ $branch->thana_id == $thana->id ? 'selected' : '' }}>
                                        {{ $thana->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Branch Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Branch Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ $branch->name }}"
                                   class="form-control form-control-lg"
                                   placeholder="Enter branch name">
                        </div>

                        <!-- Address -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Address</label>
                            <input type="text"
                                   name="address"
                                   value="{{ $branch->address }}"
                                   class="form-control form-control-lg"
                                   placeholder="Enter address">
                        </div>

                        <!-- Title -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text"
                                   name="title"
                                   value="{{ $branch->title }}"
                                   class="form-control form-control-lg"
                                   placeholder="Enter title (optional)">
                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Update Branch
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection