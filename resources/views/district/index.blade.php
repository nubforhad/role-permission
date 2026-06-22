{{-- resources/views/districts/index.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">


    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0 fw-bold">Districts</h4>
            <small class="text-muted">Manage all districts</small>
        </div>

        <a class="btn btn-success btn-sm"
           href="{{ route('districts.create') }}">
            <i class="fa fa-plus"></i> Create New District
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-primary">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($districts as $district)
                        <tr>
                             
                             <td>{{ $loop->iteration }}</td>
                            <td>{{ $district->name }}</td>
                            <td>{{ $district->title }}</td>

                            <td class="text-center">

                                <form action="{{ route('districts.destroy',$district->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('districts.show',$district->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route('districts.edit',$district->id) }}">
                                        <i class="fa fa-pen-to-square"></i>
                                    </a>

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

    <div class="mt-3">
        {!! $districts->links('pagination::bootstrap-5') !!}
    </div>

</div>


</div>

@endsection
