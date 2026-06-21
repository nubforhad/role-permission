@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">Users Management</h3>

        <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">
            <i class="fa fa-plus"></i> Create New User
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ $data->firstItem() + $key }}</td>

                                <td class="fw-semibold">{{ $user->name }}</td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    @foreach($user->getRoleNames() as $role)
                                        <span class="badge bg-success me-1">
                                            {{ $role }}
                                        </span>
                                    @endforeach
                                </td>

                                <td class="text-center">

                                    <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">
                                        <i class="fa-solid fa-list"></i>
                                    </a>

                                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash"></i>
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

<style>
    body {
        background: #f5f7fb;
    }

    .card {
        border-radius: 12px;
    }

    .table th {
        font-weight: 600;
    }

    .btn {
        border-radius: 8px;
    }
</style>

@endsection