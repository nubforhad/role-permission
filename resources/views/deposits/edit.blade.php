@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit Deposit</h4>
                <small class="text-muted">Update deposit information</small>
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

                <form action="{{ route('deposits.update',$deposit->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Branch</label>

                            <select name="branch_id" class="form-select" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ $deposit->branch_id==$branch->id ? 'selected':'' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Member</label>

                            <select name="member_id" id="member_id" class="form-select" required>

                                @foreach($members as $member)

                                    <option value="{{ $member->id }}"
                                            data-member-code="{{ $member->member_code }}"
                                            {{ $deposit->member_id==$member->id ? 'selected':'' }}>
                                        {{ $member->member_name }}
                                    </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Deposit Category</label>

                            <select name="deposit_category_id" class="form-select" required>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}"
                                        {{ $deposit->deposit_category_id==$category->id ? 'selected':'' }}>
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Member Code</label>

                            <input type="text"
                                   id="member_code"
                                   name="member_code"
                                   class="form-control"
                                   value="{{ $deposit->member_code }}"
                                   readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Deposit Amount</label>

                            <input type="number"
                                   step="0.01"
                                   name="deposit_amount"
                                   value="{{ $deposit->deposit_amount }}"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Interest Rate (%)</label>

                            <input type="number"
                                   step="0.01"
                                   name="interest_rate"
                                   value="{{ $deposit->interest_rate }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Start Date</label>

                            <input type="date"
                                   name="start_date"
                                   value="{{ $deposit->start_date->format('Y-m-d') }}"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Maturity Date</label>

                            <input type="date"
                                   name="maturity_date"
                                   value="{{ optional($deposit->maturity_date)->format('Y-m-d') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Status</label>

                            <select name="status" class="form-select">

                                <option value="running" {{ $deposit->status=='running'?'selected':'' }}>
                                    Running
                                </option>

                                <option value="completed" {{ $deposit->status=='completed'?'selected':'' }}>
                                    Completed
                                </option>

                                <option value="closed" {{ $deposit->status=='closed'?'selected':'' }}>
                                    Closed
                                </option>

                                <option value="cancelled" {{ $deposit->status=='cancelled'?'selected':'' }}>
                                    Cancelled
                                </option>

                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Remark</label>

                            <textarea name="remark"
                                      rows="3"
                                      class="form-control">{{ $deposit->remark }}</textarea>
                        </div>

                    </div>

                    <button class="btn btn-primary">
                        <i class="fa fa-save"></i> Update Deposit
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

    function updateMemberCode() {
        const option = memberSelect.options[memberSelect.selectedIndex];
        memberCode.value = option.dataset.memberCode || '';
    }

    updateMemberCode();

    memberSelect.addEventListener('change', updateMemberCode);
});
</script>

@endsection