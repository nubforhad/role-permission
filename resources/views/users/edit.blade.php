@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit User</h4>
                <small class="text-muted">Update user details and roles</small>
            </div>

            <a class="btn btn-outline-primary btn-sm"
               href="{{ route('users.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Errors -->
        @if (count($errors) > 0)
            <div class="alert alert-danger border-0 shadow-sm">
                <strong>Whoops!</strong> Please fix the issues below.
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

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ $user->name }}"
                                   class="form-control form-control-lg"
                                   placeholder="Enter full name">
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email"
                                   name="email"
                                   value="{{ $user->email }}"
                                   class="form-control form-control-lg"
                                   placeholder="Enter email">
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control form-control-lg"
                                   placeholder="Leave blank if not changing">
                            <small class="text-muted">Leave empty if you don’t want to change password</small>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password"
                                   name="confirm-password"
                                   class="form-control form-control-lg"
                                   placeholder="Confirm password">
                        </div>

                        <!-- Roles -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Assign Roles</label>

                            <select name="roles[]" class="form-select form-select-lg" multiple>
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ isset($userRole[$value]) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            <small class="text-muted">Hold CTRL (or CMD) to select multiple roles</small>
                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save me-1"></i> Update User
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection