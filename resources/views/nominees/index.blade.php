@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Nominee Management</h4>
                <small class="text-muted">Manage all nominees</small>
            </div>

            <a href="{{ route('nominees.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Add Nominee
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th>Photo</th>
                                <th>Nominee Name</th>
                                <th>Member Code</th>
                                <th>Mobile</th>
                                <th>Relation</th>
                                <th>NID No</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($nominees as $key => $nominee)
                                <tr>

                                    <td>
                                        {{ $nominees->firstItem() + $key }}
                                    </td>

                                    <td>
                                        @if($nominee->photo)
                                            <img src="{{ asset('storage/'.$nominee->photo) }}"
                                                 width="50"
                                                 height="50"
                                                 class="rounded-circle border"
                                                 style="object-fit:cover;">
                                        @else
                                            <img src="https://via.placeholder.com/50"
                                                 width="50"
                                                 class="rounded-circle">
                                        @endif
                                    </td>

                                    <td>
                                        {{ $nominee->nominee_name }}
                                    </td>

                                    <td>
                                        {{ optional($nominee->member)->member_code }}
                                    </td>

                                    <td>
                                        {{ $nominee->mobile_number }}
                                    </td>

                                    <td>
                                        {{ $nominee->relation }}
                                    </td>

                                    <td>
                                        {{ $nominee->nid_number }}
                                    </td>

                                    <td>

                                        <a href="{{ route('nominees.show',$nominee->id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        <a href="{{ route('nominees.edit',$nominee->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="bx bx-edit"></i>
                                        </a>

                                        <form action="{{ route('nominees.destroy',$nominee->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="bx bx-trash"></i>
                                            </button>

                                        </form>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        No Nominee Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <div class="mt-3">
                    {{ $nominees->links() }}
                </div>

            </div>
        </div>

    </div>
</div>

@endsection