@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Members Management</h4>
                <small class="text-muted">Manage all members</small>
            </div>

            <a href="{{ route('members.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Add Member
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Card -->
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="60">SL</th>
                                <th>Photo</th>
                                <th>Member Code</th>
                                <th>By Employee</th>
                                <th>Mobile</th>
                                <th>Member Name</th>
                                <th>Branch</th>
                                <th>Share Amount</th>
                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($members as $key => $member)
                                <tr>
                                    <td>
                                        {{ $members->firstItem() + $key }}
                                    </td>

                                    <td>
                                        @if($member->photo)
                                            <img src="{{ asset('storage/'.$member->photo) }}"
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
                                        {{ $member->member_code }}
                                    </td>

                                    <td>
                                        {{ optional($member->user)->name }}
                                    </td>

                                    <td>
                                        {{ $member->mobile_number }}
                                    </td>

                                    <td>
                                        {{ $member->member_name }}
                                    </td>

                                    <td>
                                        {{ optional($member->branch)->name }}
                                    </td>

                                    <td>
                                        {{ number_format($member->share_amount, 2) }}
                                    </td>

                                    <td>
                                        @if($member->status == 'active' || $member->status == 1)
                                            <span class="badge bg-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('members.show',$member->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        <a href="{{ route('members.edit',$member->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bx bx-edit"></i>
                                        </a>

                                        <form action="{{ route('members.destroy',$member->id) }}"
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
                                    <td colspan="10" class="text-center">
                                        No Members Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <div class="mt-3">
                    {{ $members->links() }}
                </div>

            </div>
        </div>

    </div>
</div>

@endsection