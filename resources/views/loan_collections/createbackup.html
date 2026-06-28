@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-0">Add Loan Collection</h4>
                <small class="text-muted">Receive Installment From Member</small>
            </div>

            <a href="{{ route('loan-collections.index') }}" class="btn btn-secondary">
                ← Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('loan-collections.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        {{-- Loan --}}
                        <!-- <div class="col-md-6 mb-3">
                            <label class="form-label">Loan</label>

                            <select name="loan_section_id" class="form-control" required>
                                <option value="">Select Loan</option>

                                @foreach($loans as $loan)
                                    <option value="{{ $loan->id }}">
                                        Loan #{{ $loan->id }}
                                        ({{ number_format($loan->loan_amount,2) }})
                                    </option>
                                @endforeach

                            </select>
                        </div> -->
                        <div class="col-md-6 mb-3">
    <label class="form-label">Loan</label>

    <select name="loan_section_id" id="loan_section_id" class="form-control" required>
        <option value="">Select Loan</option>

        @foreach($loans as $loan)
            <option
                value="{{ $loan->id }}"
                data-member="{{ $loan->member_id }}"
                data-code="{{ $loan->member->member_code ?? '' }}"
                data-installment="{{ $loan->paid_per_installment }}">

                Loan #{{ $loan->id }}
                - {{ $loan->member->name ?? '' }}
                ({{ number_format($loan->loan_amount,2) }})

            </option>
        @endforeach

    </select>
</div>

                        {{-- Member --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Member</label>

                            <select name="member_id" id="member_id" class="form-control" required>

                                <option value="">Select Member</option>

                                @foreach($members as $member)

                                    <option
                                        value="{{ $member->id }}"
                                        data-code="{{ $member->member_code }}">

                                        {{ $member->name }}
                                        ({{ $member->member_code }})

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        {{-- Member Code --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Member Code</label>

                            <input
                                type="text"
                                name="member_code"
                                id="member_code"
                                class="form-control"
                                readonly>
                        </div>

                        {{-- Installment Amount --}}
                         <div class="col-md-6 mb-3">
    <label class="form-label">Installment Amount</label>

    <input
        type="number"
        step="0.01"
        name="installment_amount"
        id="installment_amount"
        class="form-control"
        readonly>
</div>

                        {{-- Paid Amount --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Paid Amount</label>

                            <input
                                type="number"
                                step="0.01"
                                name="paid_amount"
                                class="form-control"
                                required>
                        </div>

                        {{-- Penalty --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penalty Charge</label>

                            <input
                                type="number"
                                step="0.01"
                                name="penalty_charge"
                                value="0"
                                class="form-control">
                        </div>

                        {{-- Installment Date --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Installment Date</label>

                            <input
                                type="date"
                                name="installment_date"
                                class="form-control">
                        </div>

                        {{-- Paid Date --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Paid Date</label>

                            <input
                                type="date"
                                name="paid_date"
                                value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>

                        {{-- Expire Date --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Expire Date</label>

                            <input
                                type="date"
                                name="expire_date"
                                class="form-control">
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>

                            <select name="status" class="form-control">

                                <option value="pending">Pending</option>

                                <option value="paid">Paid</option>

                                <option value="partial">Partial</option>

                                <option value="late">Late</option>

                            </select>
                        </div>

                        {{-- Remark --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Remark</label>

                            <textarea
                                name="remark"
                                rows="3"
                                class="form-control"></textarea>
                        </div>

                    </div>

                    <button class="btn btn-primary">
                        Save Collection
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>
 
<script>

const loan = document.getElementById('loan_section_id');
const member = document.getElementById('member_id');
const memberCode = document.getElementById('member_code');
const installment = document.getElementById('installment_amount');

// Loan Change
loan.addEventListener('change', function () {

    let option = this.options[this.selectedIndex];

    if(option.value == ''){
        member.value = '';
        memberCode.value = '';
        installment.value = '';
        return;
    }

    // Auto Member Select
    member.value = option.dataset.member;

    // Auto Member Code
    memberCode.value = option.dataset.code;

    // Auto Installment Amount
    installment.value = option.dataset.installment;

});

// Member Change
member.addEventListener('change', function(){

    let option = this.options[this.selectedIndex];

    memberCode.value = option.dataset.code ?? '';

});

</script>

@endsection