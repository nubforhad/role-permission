@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Nominee Details</h4>
                <small class="text-muted">View Nominee Information</small>
            </div>

            <div>
                <a href="{{ route('nominees.edit', $nominee->id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit
                </a>

                <a href="{{ route('nominees.index') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Back
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="row">

                    <!-- Photo -->
                    <div class="col-md-3 text-center">

                        @if($nominee->photo)
                            <img src="{{ asset('storage/'.$nominee->photo) }}"
                                 class="img-fluid rounded border mb-3"
                                 style="max-height:220px;">
                        @else
                            <img src="https://via.placeholder.com/200x220?text=No+Photo"
                                 class="img-fluid rounded border mb-3">
                        @endif

                        <h5 class="fw-bold">
                            {{ $nominee->nominee_name }}
                        </h5>

                        <p class="text-muted mb-0">
                            {{ $nominee->relation }}
                        </p>

                    </div>

                    <!-- Details -->
                    <div class="col-md-9">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <strong>Member Code :</strong><br>
                                {{ optional($nominee->member)->member_code }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Member Name :</strong><br>
                                {{ optional(optional($nominee->member)->user)->name }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Nominee Name :</strong><br>
                                {{ $nominee->nominee_name }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Mobile Number :</strong><br>
                                {{ $nominee->mobile_number }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Father Name :</strong><br>
                                {{ $nominee->father_name }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Mother Name :</strong><br>
                                {{ $nominee->mother_name }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Relation :</strong><br>
                                {{ $nominee->relation }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>NID Number :</strong><br>
                                {{ $nominee->nid_number }}
                            </div>

                            <div class="col-md-12 mb-3">
                                <strong>Address :</strong><br>
                                {{ $nominee->address }}
                            </div>

                        </div>

                        <hr>

                        <div class="row">

                            <!-- Signature -->
                            <div class="col-md-6">

                                <h6 class="fw-bold">Signature</h6>

                                @if($nominee->signature)
                                    <img src="{{ asset('storage/'.$nominee->signature) }}"
                                         class="img-fluid border rounded"
                                         style="max-height:120px;">
                                @else
                                    <p class="text-muted">No Signature Uploaded</p>
                                @endif

                            </div>

                            <!-- Document -->
                            <div class="col-md-6">

                                <h6 class="fw-bold">Document File</h6>

                                @if($nominee->document_file)
                                    <a href="{{ asset('storage/'.$nominee->document_file) }}"
                                       target="_blank"
                                       class="btn btn-primary">
                                        <i class="bx bx-file"></i>
                                        View Document
                                    </a>
                                @else
                                    <p class="text-muted">No Document Uploaded</p>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection