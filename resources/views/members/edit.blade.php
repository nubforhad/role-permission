@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Edit Member</h4>
                <small class="text-muted">Update Member Information</small>
            </div>

            <a href="{{ route('members.index') }}" class="btn btn-secondary">
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

                <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- User -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">User</label>
                            <select name="user_id" class="form-select">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $member->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Branch -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Branch</label>
                            <select name="branch_id" class="form-select">
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ $member->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Member Code -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Member Code</label>
                            <input type="text" class="form-control" value="{{ $member->member_code }}" disabled>
                        </div>

                        <!-- Email -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $member->email) }}">
                        </div>

                        <!-- Mobile -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" name="mobile_number" class="form-control"
                                value="{{ old('mobile_number', $member->mobile_number) }}">
                        </div>

                        <!-- Opening Date -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Opening Date</label>
                            <input type="date" name="opening_date" class="form-control"
                                value="{{ old('opening_date', $member->opening_date) }}">
                        </div>

                        <!-- Father -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Father Name</label>
                            <input type="text" name="father_name" class="form-control"
                                value="{{ old('father_name', $member->father_name) }}">
                        </div>

                        <!-- Mother -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mother Name</label>
                            <input type="text" name="mother_name" class="form-control"
                                value="{{ old('mother_name', $member->mother_name) }}">
                        </div>

                        <!-- Spouse -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Spouse Name</label>
                            <input type="text" name="spouse_name" class="form-control"
                                value="{{ old('spouse_name', $member->spouse_name) }}">
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Present Address</label>
                            <textarea name="present_address" class="form-control" rows="3">{{ old('present_address', $member->present_address) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Permanent Address</label>
                            <textarea name="permanent_address" class="form-control" rows="3">{{ old('permanent_address', $member->permanent_address) }}</textarea>
                        </div>

                        <!-- Share -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Share Amount</label>
                            <input type="number" step="0.01" name="share_amount" class="form-control"
                                value="{{ old('share_amount', $member->share_amount) }}">
                        </div>

                        <!-- Referred -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Referred By</label>
                            <input type="text" name="referred_by" class="form-control"
                                value="{{ old('referred_by', $member->referred_by) }}">
                        </div>

                        <!-- NID -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">NID Number</label>
                            <input type="text" name="nid_number" class="form-control"
                                value="{{ old('nid_number', $member->nid_number) }}">
                        </div>

                        <!-- Blood -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Blood Group</label>
                            <input type="text" name="blood_group" class="form-control"
                                value="{{ old('blood_group', $member->blood_group) }}">
                        </div>

                        <!-- Gender -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="Male" {{ $member->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $member->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ $member->gender == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- DOB -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control"
                                value="{{ old('dob', $member->dob) }}">
                        </div>

                        <!-- Income -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Monthly Income</label>
                            <input type="number" step="0.01" name="monthly_income" class="form-control"
                                value="{{ old('monthly_income', $member->monthly_income) }}">
                        </div>

                        <!-- Profession -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Profession</label>
                            <input type="text" name="profession" class="form-control"
                                value="{{ old('profession', $member->profession) }}">
                        </div>

                        <!-- Fees -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Admission Fee</label>
                            <input type="number" step="0.01" name="admission_fee" class="form-control"
                                value="{{ old('admission_fee', $member->admission_fee) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Passbook Fee</label>
                            <input type="number" step="0.01" name="passbook_fee" class="form-control"
                                value="{{ old('passbook_fee', $member->passbook_fee) }}">
                        </div>

                        <!-- Status -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" {{ $member->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $member->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Photo -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control">

                            @if($member->photo)
                                <img src="{{ asset('storage/'.$member->photo) }}" width="60" class="mt-2 rounded">
                            @endif
                        </div>

                        <!-- Signature -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Signature</label>
                            <input type="file" name="signature" class="form-control">

                            @if($member->signature)
                                <img src="{{ asset('storage/'.$member->signature) }}" width="60" class="mt-2 rounded">
                            @endif
                        </div>

                        <!-- Document -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Document File</label>
                            <input type="file" name="document_file" class="form-control">

                            @if($member->document_file)
                                <a href="{{ asset('storage/'.$member->document_file) }}" target="_blank">
                                    View File
                                </a>
                            @endif
                        </div>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save"></i> Update Member
                        </button>

                        <a href="{{ route('members.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection