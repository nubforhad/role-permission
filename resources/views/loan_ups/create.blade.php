@extends('layouts.app')

@section('title', 'Create Loan')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Create Loan</h4>
                <p class="text-muted mb-0">Create new loan for member</p>
            </div>

            <a href="{{ route('loan-ups.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <form action="{{ route('loan-ups.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- Branch -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Branch</label>
                            <select name="branch_id" class="form-select" required>
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Member -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Member</label>
                            <select name="member_id" class="form-select" required>
                                <option value="">Select Member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">
                                        {{ $member->member_name ?? 'Member #'.$member->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Category -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Loan Category</label>
                            <select name="loan_up_category_id" id="category" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option 
                                        value="{{ $cat->id }}"
                                        data-rate="{{ $cat->interest_rate }}"
                                        data-type="{{ $cat->interest_type }}"
                                        data-duration="{{ $cat->duration }}"
                                        data-durationtype="{{ $cat->duration_type }}"
                                        data-installment="{{ $cat->installment_type }}"
                                    >
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Loan Amount -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Loan Amount</label>
                            <input type="number" name="loan_amount" id="loan_amount" class="form-control" required>
                        </div>

                        <!-- Duration -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Duration</label>
                            <input type="number" name="duration" id="duration" class="form-control" required>
                        </div>

                        <!-- Interest Rate -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Interest Rate (%)</label>
                            <input type="text" id="interest_rate" class="form-control" readonly>
                        </div>

                        <!-- Interest Type -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Interest Type</label>
                            <input type="text" id="interest_type" class="form-control" readonly>
                        </div>

                        <!-- Total Interest -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Total Interest</label>
                            <input type="text" id="total_interest" class="form-control" readonly>
                        </div>

                        <!-- Total Payable -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Total Payable</label>
                            <input type="text" id="total_payable" class="form-control" readonly>
                        </div>

                        <!-- EMI -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Monthly EMI</label>
                            <input type="text" id="emi" class="form-control" readonly>
                        </div>

                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Save Loan
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>



@endsection

{{-- 🔥 JS CALCULATION --}}
@push('scripts')
<script>
    let rate = 0;

    const category = document.getElementById('category');
    const loanAmount = document.getElementById('loan_amount');
    const duration = document.getElementById('duration');

    function updateCategoryData() {
        let selected = category.options[category.selectedIndex];

        if (!selected) return;

        rate = parseFloat(selected.getAttribute('data-rate')) || 0;

        document.getElementById('interest_rate').value = rate;
        document.getElementById('interest_type').value = selected.getAttribute('data-type') || '';
    }

    function calculateLoan() {

        let amount = parseFloat(loanAmount.value) || 0;
        let dur = parseInt(duration.value) || 0;

        let interest = (amount * rate * dur) / 100;
        let total = amount + interest;
        let emi = dur > 0 ? total / dur : 0;

        document.getElementById('total_interest').value = interest.toFixed(2);
        document.getElementById('total_payable').value = total.toFixed(2);
        document.getElementById('emi').value = emi.toFixed(2);
    }

    // category change
    category.addEventListener('change', function () {
        updateCategoryData();
        calculateLoan();
    });

    // input change
    loanAmount.addEventListener('input', calculateLoan);
    duration.addEventListener('input', calculateLoan);

    // 🔥 IMPORTANT: page load e auto trigger
    window.addEventListener('load', function () {
        updateCategoryData();
        calculateLoan();
    });

</script>
@endpush 