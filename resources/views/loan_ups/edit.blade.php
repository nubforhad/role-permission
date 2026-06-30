@extends('layouts.app')

@section('title', 'Edit Loan')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Edit Loan</h4>
                <p class="text-muted mb-0">Update loan information</p>
            </div>

            <a href="{{ route('loan-ups.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <form action="{{ route('loan-ups.update', $loanUp->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Branch -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Branch</label>
                            <select name="branch_id" class="form-select" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ $loanUp->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Member -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Member</label>
                            <select name="member_id" class="form-select" required>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}"
                                        {{ $loanUp->member_id == $member->id ? 'selected' : '' }}>
                                        {{ $member->name ?? 'Member #'.$member->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Category -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Loan Category</label>
                            <select name="loan_up_category_id" id="category" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        data-rate="{{ $cat->interest_rate }}"
                                        data-type="{{ $cat->interest_type }}"
                                        {{ $loanUp->loan_up_category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Loan Amount -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Loan Amount</label>
                            <input type="number"
                                   name="loan_amount"
                                   id="loan_amount"
                                   class="form-control"
                                   value="{{ old('loan_amount', $loanUp->loan_amount) }}"
                                   required>
                        </div>

                        <!-- Duration -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Duration</label>
                            <input type="number"
                                   name="duration"
                                   id="duration"
                                   class="form-control"
                                   value="{{ old('duration', $loanUp->duration) }}"
                                   required>
                        </div>

                        <!-- Interest Rate -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Interest Rate (%)</label>
                            <input type="text"
                                   id="interest_rate"
                                   class="form-control"
                                   value="{{ $loanUp->interest_rate }}"
                                   readonly>
                        </div>

                        <!-- Interest Type -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Interest Type</label>
                            <input type="text"
                                   id="interest_type"
                                   class="form-control"
                                   value="{{ $loanUp->interest_type }}"
                                   readonly>
                        </div>

                        <!-- Total Interest -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Total Interest</label>
                            <input type="text"
                                   id="total_interest"
                                   class="form-control"
                                   value="{{ $loanUp->total_interest }}"
                                   readonly>
                        </div>

                        <!-- Total Payable -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Total Payable</label>
                            <input type="text"
                                   id="total_payable"
                                   class="form-control"
                                   value="{{ $loanUp->total_payable }}"
                                   readonly>
                        </div>

                        <!-- EMI -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">EMI</label>
                            <input type="text"
                                   id="emi"
                                   class="form-control"
                                   value="{{ $loanUp->emi_amount }}"
                                   readonly>
                        </div>

                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Update Loan
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection


{{-- 🔥 CALCULATION SCRIPT --}}
@push('scripts')
<script>
    let rate = parseFloat(document.querySelector('#category option:checked').dataset.rate || 0);

    document.getElementById('category').addEventListener('change', function () {

        let selected = this.options[this.selectedIndex];

        rate = parseFloat(selected.getAttribute('data-rate')) || 0;

        document.getElementById('interest_rate').value = rate;
        document.getElementById('interest_type').value = selected.getAttribute('data-type');

        calculate();
    });

    function calculate() {

        let amount = parseFloat(document.getElementById('loan_amount').value) || 0;
        let duration = parseInt(document.getElementById('duration').value) || 0;

        let interest = (amount * rate * duration) / 100;
        let total = amount + interest;
        let emi = duration > 0 ? total / duration : 0;

        document.getElementById('total_interest').value = interest.toFixed(2);
        document.getElementById('total_payable').value = total.toFixed(2);
        document.getElementById('emi').value = emi.toFixed(2);
    }

    document.getElementById('loan_amount').addEventListener('input', calculate);
    document.getElementById('duration').addEventListener('input', calculate);

    // initial calculate
    calculate();
</script>
@endpush