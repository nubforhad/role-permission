{{-- resources/views/districts/create.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Create District</h4>
                <small class="text-muted">Add new district information</small>
            </div>

            <a href="{{ route('districts.index') }}" class="btn btn-outline-primary btn-sm">
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

                <form action="{{ route('districts.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">District Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control form-control-lg"
                                   placeholder="Enter district name">
                        </div>

                        <!-- Title -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text"
                                   name="title"
                                   class="form-control form-control-lg"
                                   placeholder="Enter district title">
                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save me-1"></i> Save District
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection