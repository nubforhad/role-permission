@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 text-uppercase">Edit Role</h5>

            <a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Role Name -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role Name</label>
                        <input type="text"
                               name="name"
                               value="{{ $role->name }}"
                               class="form-control"
                               placeholder="Enter role name">
                    </div>

                    <!-- Permissions -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Permissions</label>

                        <div class="row">
                            @foreach($permission as $value)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="permission[{{$value->id}}]"
                                               value="{{$value->id}}"
                                               {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>

                                        <label class="form-check-label">
                                            {{ $value->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-floppy-disk"></i> Update Role
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection