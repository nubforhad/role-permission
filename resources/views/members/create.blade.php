@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Create Member</h4>
                <small class="text-muted">Add New Member</small>
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

                <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">User</label>
                            <select name="user_id" class="form-select">
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Branch</label>
                            <select name="branch_id" class="form-select">
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Member Code</label>
                            <input type="text" name="member_code" class="form-control" value="{{ old('member_code') }}" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Opening Date</label>
                            <input type="date" name="opening_date" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Father Name</label>
                            <input type="text" name="father_name" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mother Name</label>
                            <input type="text" name="mother_name" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Spouse Name</label>
                            <input type="text" name="spouse_name" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Present Address</label>
                            <textarea name="present_address" rows="3" class="form-control"></textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Permanent Address</label>
                            <textarea name="permanent_address" rows="3" class="form-control"></textarea>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Share Amount</label>
                            <input type="number" step="0.01" name="share_amount" class="form-control" value="0">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Referred By</label>
                            <input type="text" name="referred_by" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">NID Number</label>
                            <input type="text" name="nid_number" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Birth Certificate No</label>
                            <input type="text" name="birth_certificate_no" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Blood Group</label>
                            <select name="blood_group" class="form-select">
                                <option value="">Select</option>
                                <option>A+</option>
                                <option>A-</option>
                                <option>B+</option>
                                <option>B-</option>
                                <option>AB+</option>
                                <option>AB-</option>
                                <option>O+</option>
                                <option>O-</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Religion</label>
                            <input type="text" name="religion" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Monthly Income</label>
                            <input type="number" step="0.01" name="monthly_income" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Profession</label>
                            <input type="text" name="profession" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Admission Fee</label>
                            <input type="number" step="0.01" name="admission_fee" class="form-control" value="0">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Passbook Fee</label>
                            <input type="number" step="0.01" name="passbook_fee" class="form-control" value="0">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Signature</label>
                            <input type="file" name="signature" class="form-control">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Document File</label>
                            <input type="file" name="document_file" class="form-control">
                        </div>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save"></i> Save Member
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