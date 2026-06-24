@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Create Nominee</h4>
                <small class="text-muted">Add New Nominee</small>
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

                <form action="{{ route('nominees.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- Member -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Member <span class="text-danger">*</span></label>
                            <select name="member_id" class="form-select" required>
                                <option value="">Select Member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">
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
                            <label class="form-label">Nominee Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="nominee_name"
                                   class="form-control"
                                   value="{{ old('nominee_name') }}"
                                   required>
                        </div>

                        <!-- Mobile -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text"
                                   name="mobile_number"
                                   class="form-control"
                                   value="{{ old('mobile_number') }}">
                        </div>

                        <!-- Father -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Father Name</label>
                            <input type="text"
                                   name="father_name"
                                   class="form-control"
                                   value="{{ old('father_name') }}">
                        </div>

                        <!-- Mother -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mother Name</label>
                            <input type="text"
                                   name="mother_name"
                                   class="form-control"
                                   value="{{ old('mother_name') }}">
                        </div>

                        <!-- Relation -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Relation</label>
                            <input type="text"
                                   name="relation"
                                   class="form-control"
                                   value="{{ old('relation') }}"
                                   placeholder="Father, Mother, Wife, Son etc.">
                        </div>

                        <!-- NID -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NID Number</label>
                            <input type="text"
                                   name="nid_number"
                                   class="form-control"
                                   value="{{ old('nid_number') }}">
                        </div>

                        <!-- Address -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address"
                                      rows="3"
                                      class="form-control">{{ old('address') }}</textarea>
                        </div>

                        <!-- Photo -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nominee Photo</label>
                            <input type="file"
                                   name="photo"
                                   class="form-control">
                        </div>

                        <!-- Signature -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Signature</label>
                            <input type="file"
                                   name="signature"
                                   class="form-control">
                        </div>

                        <!-- Document -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Document File</label>
                            <input type="file"
                                   name="document_file"
                                   class="form-control">
                        </div>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save"></i>
                            Save Nominee
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