@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Installment Types</h4>
                <small class="text-muted">Manage all installment types</small>
            </div>

            <a class="btn btn-success btn-sm" href="{{ route('installment-types.create') }}">
                <i class="fa fa-plus"></i> Create New
            </a>
        </div>

        <!-- Success -->
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Type Name</th>
                                <th>Duration</th>
                                <th>Ins Code</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($installments as $key => $installment)
                                <tr>

                                    <!-- Serial -->
                                    <td>
                                        {{ $installments->firstItem() + $key }}
                                    </td>

                                    <!-- Type Name -->
                                    <td class="fw-semibold">
                                        {{ $installment->type_name }}
                                    </td>

                                    <!-- Duration -->
                                    <td>
                                        {{ $installment->duration }} Days
                                    </td>

                                    <!-- Code -->
                                    <td>
                                        {{ $installment->ins_code }}
                                    </td>

                                    <!-- Action -->
                                    <td class="text-center">

                                        <a href="{{ route('installment-types.show', $installment->id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('installment-types.edit', $installment->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ route('installment-types.destroy', $installment->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
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
            {!! $installments->links('pagination::bootstrap-5') !!}
        </div>

    </div>
</div>

@endsection