@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Create New Role</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary btn-sm mb-2"
                       href="{{ route('roles.index') }}">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permissions</label>

                        @foreach($permission as $value)
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="permission[{{$value->id}}]"
                                       value="{{$value->id}}">

                                <label class="form-check-label">
                                    {{ $value->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection