@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Create Deposit</h4>
                <small class="text-muted">Create a new deposit</small>
            </div>

            <a href="{{ route('deposits.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">

                <form action="{{ route('deposits.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Branch <span class="text-danger">*</span></label>
                            <select name="branch_id" class="form-select" required>
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
<div class="col-md-6 mb-3">
    <label class="form-label">Member <span class="text-danger">*</span></label>

    <select name="member_id" id="member_id" class="form-select" required>
        <option value="">Select Member</option>

        @foreach($members as $member)
            <option
                value="{{ $member->id }}"
                data-member-code="{{ $member->member_code }}">
                {{ $member->member_name }}
            </option>
        @endforeach

    </select>
</div>
                        <!-- <div class="col-md-6 mb-3">
                            <label class="form-label">Member <span class="text-danger">*</span></label>
                            <select name="member_id" class="form-select" required>
                                <option value="">Select Member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">
                                        {{ $member->member_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div> -->

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deposit Category <span class="text-danger">*</span></label>
                            <select name="deposit_category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                         <div class="col-md-6 mb-3">
    <label class="form-label">Member Code</label>

    <input type="text"
           name="member_code"
           id="member_code"
           class="form-control"
           readonly>
</div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deposit Amount <span class="text-danger">*</span></label>
                            <input type="number"
                                   step="0.01"
                                   name="deposit_amount"
                                   class="form-control"
                                   value="{{ old('deposit_amount') }}"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Interest Rate (%)</label>
                            <input type="number"
                                   step="0.01"
                                   name="interest_rate"
                                   class="form-control"
                                   value="{{ old('interest_rate') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                            <input type="date"
                                   name="start_date"
                                   class="form-control"
                                   value="{{ old('start_date') }}"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Maturity Date</label>
                            <input type="date"
                                   name="maturity_date"
                                   class="form-control"
                                   value="{{ old('maturity_date') }}">
                        </div>

                       <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>

                            <select name="status" class="form-select" required>
                                <option value="">Select Status</option>
                                <option value="running">Running</option>
                                <option value="completed">Completed</option>
                                <option value="closed">Closed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Remark</label>
                            <textarea name="remark"
                                      rows="3"
                                      class="form-control">{{ old('remark') }}</textarea>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Save Deposit
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>
<script> 
document.addEventListener('DOMContentLoaded', function () {

    const memberSelect = document.getElementById('member_id');
    const memberCode = document.getElementById('member_code');

    memberSelect.addEventListener('change', function () {

        let selectedOption = this.options[this.selectedIndex];

        memberCode.value = selectedOption.dataset.memberCode || '';

    });

});
</script> 
@endsection