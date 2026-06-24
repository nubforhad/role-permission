@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Edit Nominee</h4>
                <small class="text-muted">Update Nominee Information</small>
            </div>

            <a href="{{ route('nominees.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('nominees.update', $nominee->id) }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Member -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Member</label>
                            <select name="member_id" class="form-select" required>
                                <option value="">Select Member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}"
                                        {{ $nominee->member_id == $member->id ? 'selected' : '' }}>
                                        {{ $member->member_code }}
                                        @if($member->user)
                                            - {{ $member->user->name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nominee Name -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nominee Name</label>
                            <input type="text"
                                   name="nominee_name"
                                   class="form-control"
                                   value="{{ old('nominee_name', $nominee->nominee_name) }}"
                                   required>
                        </div>

                        <!-- Mobile -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text"
                                   name="mobile_number"
                                   class="form-control"
                                   value="{{ old('mobile_number', $nominee->mobile_number) }}">
                        </div>

                        <!-- Father Name -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Father Name</label>
                            <input type="text"
                                   name="father_name"
                                   class="form-control"
                                   value="{{ old('father_name', $nominee->father_name) }}">
                        </div>

                        <!-- Mother Name -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mother Name</label>
                            <input type="text"
                                   name="mother_name"
                                   class="form-control"
                                   value="{{ old('mother_name', $nominee->mother_name) }}">
                        </div>

                        <!-- Relation -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Relation</label>
                            <input type="text"
                                   name="relation"
                                   class="form-control"
                                   value="{{ old('relation', $nominee->relation) }}">
                        </div>

                        <!-- NID -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NID Number</label>
                            <input type="text"
                                   name="nid_number"
                                   class="form-control"
                                   value="{{ old('nid_number', $nominee->nid_number) }}">
                        </div>

                        <!-- Address -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address"
                                      rows="3"
                                      class="form-control">{{ old('address', $nominee->address) }}</textarea>
                        </div>

                        <!-- Photo -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nominee Photo</label>
                            <input type="file"
                                   name="photo"
                                   class="form-control">

                            @if($nominee->photo)
                                <img src="{{ asset('storage/'.$nominee->photo) }}"
                                     width="80"
                                     class="mt-2 border rounded">
                            @endif
                        </div>

                        <!-- Signature -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Signature</label>
                            <input type="file"
                                   name="signature"
                                   class="form-control">

                            @if($nominee->signature)
                                <img src="{{ asset('storage/'.$nominee->signature) }}"
                                     width="80"
                                     class="mt-2 border rounded">
                            @endif
                        </div>

                        <!-- Document -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Document File</label>
                            <input type="file"
                                   name="document_file"
                                   class="form-control">

                            @if($nominee->document_file)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/'.$nominee->document_file) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-info">
                                        View Document
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save"></i> Update Nominee
                        </button>

                        <a href="{{ route('nominees.index') }}"
                           class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection