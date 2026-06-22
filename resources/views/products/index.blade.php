@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Products</h4>
                <small class="text-muted">Manage all products</small>
            </div>

            @can('product-create')
                <a class="btn btn-success btn-sm"
                   href="{{ route('products.create') }}">
                    <i class="fa fa-plus"></i> Create New Product
                </a>
            @endcan
        </div>

        <!-- Success Message -->
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
                                <th>Name</th>
                                <th>Details</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td class="fw-semibold">
                                        {{ $product->name }}
                                    </td>

                                    <td>
                                        {{ Str::limit($product->detail, 60) }}
                                    </td>

                                    <td class="text-center">

                                        <form action="{{ route('products.destroy',$product->id) }}" method="POST" class="d-inline">

                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('products.show',$product->id) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            @can('product-edit')
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{ route('products.edit',$product->id) }}">
                                                    <i class="fa fa-pen-to-square"></i>
                                                </a>
                                            @endcan

                                            @csrf
                                            @method('DELETE')

                                            @can('product-delete')
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endcan

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
            {!! $products->links('pagination::bootstrap-5') !!}
        </div>

    </div>
</div>

@endsection