@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit Withdraw</h4>
                <small class="text-muted">Update withdraw information</small>
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

                <form action="{{ route('deposit-withdraws.update', $depositWithdraw->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Deposit (readonly) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deposit</label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $depositWithdraw->deposit->deposit_no ?? '' }}"
                                   readonly>
                        </div>

                        <!-- Branch -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Branch</label>

                            <select name="branch_id" class="form-select" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ $depositWithdraw->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Available Balance (info only) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Available Balance</label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $depositWithdraw->deposit->total_amount - $depositWithdraw->deposit->paid_amount }}"
                                   readonly>
                        </div>

                        <!-- Withdraw Amount -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Withdraw Amount</label>

                            <input type="number"
                                   step="0.01"
                                   name="withdraw_amount"
                                   class="form-control"
                                   value="{{ $depositWithdraw->withdraw_amount }}"
                                   required>
                        </div>

                        <!-- Withdraw Date -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Withdraw Date</label>

                            <input type="date"
                                   name="withdraw_date"
                                   class="form-control"
                                   value="{{ \Carbon\Carbon::parse($depositWithdraw->withdraw_date)->format('Y-m-d') }}"
                                   required>
                        </div>

                        <!-- Payment Method -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Payment Method</label>

                            <select name="payment_method" class="form-select" required>

                                <option value="cash" {{ $depositWithdraw->payment_method == 'cash' ? 'selected' : '' }}>
                                    Cash
                                </option>

                                <option value="bkash" {{ $depositWithdraw->payment_method == 'bkash' ? 'selected' : '' }}>
                                    Bkash
                                </option>

                                <option value="nagad" {{ $depositWithdraw->payment_method == 'nagad' ? 'selected' : '' }}>
                                    Nagad
                                </option>

                                <option value="rocket" {{ $depositWithdraw->payment_method == 'rocket' ? 'selected' : '' }}>
                                    Rocket
                                </option>

                                <option value="bank" {{ $depositWithdraw->payment_method == 'bank' ? 'selected' : '' }}>
                                    Bank
                                </option>

                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>

                            <select name="status" class="form-select">

                                <option value="completed" {{ $depositWithdraw->status == 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                                <option value="pending" {{ $depositWithdraw->status == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="cancelled" {{ $depositWithdraw->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>

                            </select>
                        </div>

                        <!-- Remark -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Remark</label>

                            <textarea name="remark" rows="3" class="form-control">
                                {{ $depositWithdraw->remark }}
                            </textarea>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update Withdraw
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection