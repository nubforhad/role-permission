@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Create Loan</h4>
                <small class="text-muted">Add new loan application</small>
            </div>

            <a href="{{ route('loan-sections.index') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('loan-sections.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- User -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">User</label>
                            <select name="user_id" class="form-control" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Branch -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Branch</label>
                            <select name="branch_id" class="form-control" required>
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Loan Category -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Loan Category</label>
                            <select name="loan_category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Installment Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Installment Type</label>
                            <select name="installment_type_id" class="form-control" required>
                                <option value="">Select Installment Type</option>
                                @foreach($installments as $installment)
                                    <option value="{{ $installment->id }}">
                                        {{ $installment->type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Loan Amount -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Loan Amount</label>
                            <input type="number"
                                   step="0.01"
                                   name="loan_amount"
                                   id="loan_amount"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- Interest -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Interest (%)</label>
                            <input type="number"
                                   step="0.01"
                                   name="interest"
                                   id="interest"
                                   class="form-control"
                                   value="0">
                        </div>

                        <!-- Total Amount -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Total Amount</label>
                            <input type="text"
                                   id="total_amount"
                                   class="form-control"
                                   readonly>
                        </div>

                        <!-- Total Installment -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Installment</label>
                            <input type="number"
                                   name="total_installment"
                                   id="total_installment"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- Paid Per Installment -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Paid Per Installment</label>
                            <input type="text"
                                   name="paid_per_installment"
                                   id="paid_per_installment"
                                   class="form-control"
                                   readonly>
                        </div>

                        <!-- Remark -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Remark</label>
                            <textarea name="remark"
                                      class="form-control"
                                      rows="3"></textarea>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Save Loan
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

        loanAmount.addEventListener('input', calculateTotal);
        interest.addEventListener('input', calculateTotal);
        totalInstallment.addEventListener('input', calculatePerInstallment);
    });
</script>

@endsection

