@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Member Details</h4>
                <small class="text-muted">Full Information View</small>
            </div>

            <div>
                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit
                </a>

                <a href="{{ route('members.index') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Back
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="row">

                    <!-- Profile Section -->
                    <div class="col-md-3 text-center">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}"
                                class="rounded-circle border mb-3"
                                width="140"
                                height="140"
                                style="object-fit:cover;">
                        @else
                            <img src="https://via.placeholder.com/140"
                                class="rounded-circle border mb-3">
                        @endif

                        <h5>{{ optional($member->user)->name }}</h5>
                        <p class="text-muted mb-1">Code: {{ $member->member_code }}</p>

                        @if($member->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </div>

                    <!-- Details Section -->
                    <div class="col-md-9">

                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <strong>Email:</strong> {{ $member->email }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Mobile:</strong> {{ $member->mobile_number }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Branch:</strong> {{ optional($member->branch)->name }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Opening Date:</strong> {{ $member->opening_date }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Father Name:</strong> {{ $member->father_name }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Mother Name:</strong> {{ $member->mother_name }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Spouse Name:</strong> {{ $member->spouse_name }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Gender:</strong> {{ $member->gender }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Religion:</strong> {{ $member->religion }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Date of Birth:</strong> {{ $member->dob }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Profession:</strong> {{ $member->profession }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Monthly Income:</strong>
                                {{ number_format($member->monthly_income, 2) }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Share Amount:</strong>
                                {{ number_format($member->share_amount, 2) }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Admission Fee:</strong>
                                {{ number_format($member->admission_fee, 2) }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Passbook Fee:</strong>
                                {{ number_format($member->passbook_fee, 2) }}
                            </div>

                            <div class="col-md-12 mt-3">
                                <strong>Present Address:</strong>
                                <p class="text-muted">{{ $member->present_address }}</p>
                            </div>

                            <div class="col-md-12">
                                <strong>Permanent Address:</strong>
                                <p class="text-muted">{{ $member->permanent_address }}</p>
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>NID:</strong> {{ $member->nid_number }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Birth Certificate:</strong> {{ $member->birth_certificate_no }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Blood Group:</strong> {{ $member->blood_group }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Referred By:</strong> {{ $member->referred_by }}
                            </div>

                        </div>

                        <!-- Documents -->
                        <hr>

                        <div class="row">

                            <div class="col-md-4">
                                <strong>Signature</strong><br>
                                @if($member->signature)
                                    <img src="{{ asset('storage/'.$member->signature) }}"
                                        width="120"
                                        class="border mt-2">
                                @else
                                    <p class="text-muted">No Signature</p>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <strong>Document</strong><br>
                                @if($member->document_file)
                                    <a href="{{ asset('storage/'.$member->document_file) }}" target="_blank" class="btn btn-sm btn-primary mt-2">
                                        View Document
                                    </a>
                                @else
                                    <p class="text-muted">No Document</p>
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