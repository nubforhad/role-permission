@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit Loan</h4>
                <small class="text-muted">Update loan information</small>
            </div>

            <a class="btn btn-primary btn-sm" href="{{ route('loan-sections.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Error -->
        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="card border-0 shadow-sm rounded-3">

            <div class="card-body">

                <form action="{{ route('loan-sections.update', $loanSection->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- User -->
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">User</label>

                            <select class="form-control" disabled>
                                @foreach($users as $user)
                                    @if($user->id == auth()->id())
                                        <option selected>{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        </div>

                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select name="loan_category_id" class="form-control" >
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $loanSection->loan_category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Installment -->
                        <div class="col-md-6 mb-3">
                            <label>Installment</label>
                            <select name="installment_type_id" class="form-control">
                                @foreach($installments as $ins)
                                    <option value="{{ $ins->id }}"
                                        {{ $loanSection->installment_type_id == $ins->id ? 'selected' : '' }}>
                                        {{ $ins->type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Branch -->
                        <div class="col-md-6 mb-3">
                            <label>Branch</label>
                            <select name="branch_id" class="form-control">
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ $loanSection->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Member -->
                        <div class="col-md-6 mb-3">
                            <label>Member</label>
                            <select name="member_id" id="member_id" class="form-control" disabled required>
                                @foreach($members as $member)
                                    <option
                                        value="{{ $member->id }}"
                                        data-code="{{ $member->member_code }}"
                                        {{ $loanSection->member_id == $member->id ? 'selected' : '' }}>
                                        ({{ $member->member_code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Member Code (auto filled from selected Member) -->
                        <div class="col-md-6 mb-3">
                            <label>Member Code</label>
                            <input type="text"
                                   name="member_code"
                                   id="member_code"
                                   class="form-control"
                                   value="{{ $loanSection->member_code }}"
                                   readonly>
                        </div>

                        <!-- Loan Amount -->
                        <div class="col-md-4 mb-3">
                            <label>Loan Amount</label>
                            <input type="number"
                                   step="0.01"
                                   name="loan_amount"
                                   id="loan_amount"
                                   class="form-control"
                                   value="{{ $loanSection->loan_amount }}" readonly >
                        </div>

                        <!-- Interest -->
                        <div class="col-md-4 mb-3">
                            <label>Interest (%)</label>
                            <input type="number"
                                   step="0.01"
                                   name="interest"
                                   id="interest"
                                   class="form-control"
                                   value="{{ $loanSection->interest }}">
                        </div>

                        <!-- Total Amount -->
                        <div class="col-md-4 mb-3">
                            <label>Total Amount</label>
                            <input type="text"
                                   name="total_amount"
                                   id="total_amount"
                                   class="form-control"
                                   value="{{ $loanSection->total_amount }}"
                                   readonly>
                        </div>

                        <!-- Total Installment -->
                        <div class="col-md-6 mb-3">
                            <label>Total Installment</label>
                            <input type="number"
                                   name="total_installment"
                                   id="total_installment"
                                   class="form-control"
                                   value="{{ $loanSection->total_installment }}">
                        </div>

                        <!-- Paid Per Installment -->
                        <div class="col-md-6 mb-3">
                            <label>Paid Per Installment</label>
                            <input type="text"
                                   name="paid_per_installment"
                                   id="paid_per_installment"
                                   class="form-control"
                                   value="{{ $loanSection->paid_per_installment }}"
                                   readonly>
                        </div>

                        <!-- Loan Status -->
                        <div class="col-md-6 mb-3">
                            <label>Loan Status</label>
                            <select name="loan_status" class="form-control">
                                <option value="pending" {{ $loanSection->loan_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $loanSection->loan_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="approved" {{ $loanSection->loan_status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $loanSection->loan_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <!-- Upline Status -->
                        <div class="col-md-6 mb-3">
                            <label>Upline Status</label>
                             <select name="upline_status" class="form-control">
                                <option value="pending" {{ $loanSection->upline_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $loanSection->upline_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="approved" {{ $loanSection->upline_status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $loanSection->upline_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <!-- Remark -->
                        <div class="col-md-12 mb-3">
                            <label>Remark</label>
                            <textarea name="remark" class="form-control" rows="3">{{ $loanSection->remark }}</textarea>
                        </div>

                        <!-- Submit -->
                        <div class="col-md-12">
                            <button class="btn btn-success">
                                <i class="fa fa-save"></i> Update Loan
                            </button>
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loanAmount = document.getElementById('loan_amount');
        const interest = document.getElementById('interest');
        const totalAmount = document.getElementById('total_amount');
        const totalInstallment = document.getElementById('total_installment');
        const paidPerInstallment = document.getElementById('paid_per_installment');

        const memberSelect = document.getElementById('member_id');
        const memberCode = document.getElementById('member_code');

        function calculateTotal() {
            let amount = parseFloat(loanAmount.value) || 0;
            let rate = parseFloat(interest.value) || 0;

            let interestAmount = (amount * rate) / 100;
            let total = amount + interestAmount;

            totalAmount.value = total.toFixed(2);

            calculatePerInstallment();
        }

        function calculatePerInstallment() {
            let total = parseFloat(totalAmount.value) || 0;
            let installments = parseInt(totalInstallment.value) || 0;

            if (installments > 0) {
                let perInstallment = total / installments;
                paidPerInstallment.value = perInstallment.toFixed(2);
            } else {
                paidPerInstallment.value = '';
            }
        }

        // Member পরিবর্তন করলে Member Code-ও আপডেট হবে
        memberSelect.addEventListener('change', function () {
            const option = this.options[this.selectedIndex];
            memberCode.value = option.dataset.code ?? '';
        });

        loanAmount.addEventListener('input', calculateTotal);
        interest.addEventListener('input', calculateTotal);
        totalInstallment.addEventListener('input', calculatePerInstallment);
    });
</script>

@endsection