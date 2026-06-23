@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit Loan Category</h4>
                <small class="text-muted">Update loan category information</small>
            </div>

            <a class="btn btn-primary btn-sm" href="{{ route('loan-categories.index') }}">
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

                <form action="{{ route('loan-categories.update', $loanCategory->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', $loanCategory->name) }}"
                                   required>
                        </div>

                        <!-- Title -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ old('title', $loanCategory->title) }}"
                                   required>
                        </div>

                        <!-- Details -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Details</label>
                            <textarea name="details"
                                      rows="4"
                                      class="form-control">{{ old('details', $loanCategory->details) }}</textarea>
                        </div>

                        <!-- Submit -->
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Update Category
                            </button>
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection