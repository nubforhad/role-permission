@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Create New Role</h4>
                <small class="text-muted">Add role and assign permissions</small>
            </div>

            <a href="{{ route('roles.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Error -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Please fix the errors below.
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">

                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf

                    <!-- Role Name -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Role Name</label>
                        <input type="text"
                               name="name"
                               class="form-control form-control-lg"
                               placeholder="Enter role name">
                    </div>

                    <!-- Permissions -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold mb-2">Permissions</label>

                        <div class="row g-2">
                            @foreach($permission as $value)
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-check border rounded p-2 ps-4 bg-light">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="permission[{{$value->id}}]"
                                               value="{{$value->id}}"
                                               id="perm{{$value->id}}">

                                        <label class="form-check-label ms-2"
                                               for="perm{{$value->id}}">
                                            {{ $value->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save me-1"></i> Create Role
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection