@extends('layouts.app')

@section('content')

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <h6 class="mb-0 text-uppercase">Role Management</h6>
        <hr/>

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0">All Roles</h5>

                    @can('role-create')
                        <a class="btn btn-success btn-sm" href="{{ route('roles.create') }}">
                            <i class="fa fa-plus"></i> Create New Role
                        </a>
                    @endcan
                </div>

                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th width="80px">No</th>
                                <th>Name</th>
                                <th width="250px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>

                                        <a class="btn btn-info btn-sm"
                                           href="{{ route('roles.show', $role->id) }}">
                                            <i class="fa fa-eye"></i> Show
                                        </a>

                                        @can('role-edit')
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('roles.edit', $role->id) }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        @endcan

                                        @can('role-delete')
                                            <form method="POST"
                                                  action="{{ route('roles.destroy', $role->id) }}"
                                                  style="display:inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>

                                            </form>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="mt-3">
                    {!! $roles->links('pagination::bootstrap-5') !!}
                </div>

            </div>
        </div>

    </div>
</div>
<!--end page wrapper -->




@endsection



