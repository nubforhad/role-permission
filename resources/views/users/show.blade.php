@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">User Details</h4>
                <small class="text-muted">View user information</small>
            </div>

            <a class="btn btn-outline-primary btn-sm"
               href="{{ route('users.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body p-4">

                <div class="row g-4">

                    <!-- Name -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Full Name</small>
                            <h5 class="mb-0 fw-bold">{{ $user->name }}</h5>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light">
                            <small class="text-muted">Email Address</small>
                            <h5 class="mb-0 fw-bold">{{ $user->email }}</h5>
                        </div>
                    </div>

                    <!-- Roles -->
                    <div class="col-12">
                        <div class="p-3 border rounded bg-light">

                            <small class="text-muted d-block mb-2">Roles</small>

                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $role)
                                    <span class="badge bg-primary me-1 mb-1 px-3 py-2">
                                        {{ $role }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-muted">No roles assigned</span>
                            @endif

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection