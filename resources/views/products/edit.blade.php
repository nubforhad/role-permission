@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit Product</h4>
                <small class="text-muted">Update product information</small>
            </div>

            <a class="btn btn-outline-primary btn-sm"
               href="{{ route('products.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Errors -->
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <strong>Whoops!</strong> Please fix the errors below.
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body p-4">

                <form action="{{ route('products.update',$product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- Product Name -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Product Name</label>
                            <input type="text"
                                   name="name"
                                   value="{{ $product->name }}"
                                   class="form-control form-control-lg"
                                   placeholder="Enter product name">
                        </div>

                        <!-- Product Detail -->
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Product Details</label>
                            <textarea name="detail"
                                      class="form-control form-control-lg"
                                      rows="5"
                                      placeholder="Enter product details">{{ $product->detail }}</textarea>
                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save me-1"></i> Update Product
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection