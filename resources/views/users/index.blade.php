@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Users Management</h4>
                <small class="text-muted">Manage system users and roles</small>
            </div>

            <a class="btn btn-success btn-sm px-3"
               href="{{ route('users.create') }}">
                <i class="fa fa-plus me-1"></i> Create User
            </a>
        </div>

        <!-- Success -->
        @if(session('success'))
            <div class="alert alert-success shadow-sm border-0">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <!-- Table Head -->
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>User Info</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>

                        @foreach ($data as $key => $user)
                            <tr>

                                <td class="fw-semibold text-muted">
                                    {{ $data->firstItem() + $key }}
                                </td>

                                <!-- User Name -->
                                <td>
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                    <small class="text-muted">ID: #{{ $user->id }}</small>
                                </td>

                                <!-- Email -->
                                <td>
                                    <span class="text-muted">{{ $user->email }}</span>
                                </td>

                                <!-- Roles -->
                                <td>
                                    @foreach($user->getRoleNames() as $role)
                                        <span class="badge bg-primary me-1 mb-1">
                                            {{ $role }}
                                        </span>
                                    @endforeach
                                </td>

                                <!-- Actions -->
                                <td class="text-center">

                                    <a class="btn btn-outline-info btn-sm"
                                       href="{{ route('users.show',$user->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a class="btn btn-outline-primary btn-sm"
                                       href="{{ route('users.edit',$user->id) }}">
                                        <i class="fa fa-pen"></i>
                                    </a>

                                    <form method="POST"
                                          action="{{ route('users.destroy', $user->id) }}"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {!! $data->links('pagination::bootstrap-5') !!}
        </div>

    </div>
</div>

@endsection