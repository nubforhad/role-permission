@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Create New User</h3>

        <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-sm">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger shadow-sm">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="row g-3">

                    <!-- Name -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter full name">
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" name="confirm-password" class="form-control" placeholder="Confirm password">
                    </div>

                    <!-- UID -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Unique ID</label>
                        <input type="text" name="uid" class="form-control bg-light" placeholder="Auto Generate" readonly>
                    </div>

                    <!-- Roles -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Role</label>
                        <select name="roles[]" class="form-select" multiple>
                            @foreach ($roles as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk"></i> Save User
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

</div>

<!-- Optional small UI improvement -->
<style>
    .form-control, .form-select {
        border-radius: 10px;
        padding: 10px;
    }

    .card {
        border-radius: 15px;
    }

    body {
        background: #f5f7fb;
    }
</style>

@endsection