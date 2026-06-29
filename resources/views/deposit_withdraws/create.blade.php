@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Create Withdraw</h4>
                <small class="text-muted">Create a new deposit withdraw</small>
            </div>

            <a href="{{ route('deposit-withdraws.index') }}" class="btn btn-secondary btn-sm">
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

                <form action="{{ route('deposit-withdraws.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <!-- Deposit -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deposit <span class="text-danger">*</span></label>

                            <select name="deposit_id" id="deposit_id" class="form-select" required>
                                <option value="">Select Deposit</option>

                                @foreach($deposits as $deposit)
                                    <option value="{{ $deposit->id }}"
                                            data-balance="{{ $deposit->total_amount - $deposit->paid_amount }}">
                                        {{ $deposit->deposit_no }}
                                        ({{ $deposit->member->member_name ?? '' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Branch -->
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

                        <!-- Available Balance -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Available Balance</label>

                            <input type="text"
                                   id="available_balance"
                                   class="form-control"
                                   readonly>
                        </div>

                        <!-- Withdraw Amount -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Withdraw Amount <span class="text-danger">*</span></label>

                            <input type="number"
                                   step="0.01"
                                   name="withdraw_amount"
                                   id="withdraw_amount"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- Date -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Withdraw Date <span class="text-danger">*</span></label>

                            <input type="date"
                                   name="withdraw_date"
                                   class="form-control"
                                   required>
                        </div>

                        <!-- Payment Method -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Payment Method <span class="text-danger">*</span></label>

                            <select name="payment_method" class="form-select" required>
                                <option value="cash">Cash</option>
                                <option value="bkash">Bkash</option>
                                <option value="nagad">Nagad</option>
                                <option value="rocket">Rocket</option>
                                <option value="bank">Bank</option>
                            </select>
                        </div>

                        <!-- Remark -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Remark</label>

                            <textarea name="remark" rows="3" class="form-control"></textarea>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Save Withdraw
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const depositSelect = document.getElementById('deposit_id');
    const balanceInput = document.getElementById('available_balance');

    depositSelect.addEventListener('change', function () {

        let selected = this.options[this.selectedIndex];
        let balance = selected.getAttribute('data-balance');

        balanceInput.value = balance ?? 0;

    });

});
</script>

@endsection