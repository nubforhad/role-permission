@extends('layouts.app')

@section('content')

<div class="container">

    <h3>Create Installment</h3>

    <form action="{{ route('loanup.installment.store') }}" method="POST">
        @csrf

        <input type="hidden" name="loan_up_id" value="{{ $loan->id }}">

        <!-- Loan Info -->
        <div class="mb-3">
            <label>Loan ID</label>
            <input type="text" class="form-control" value="{{ $loan->id }}" disabled>
        </div>

        <!-- Installment No -->
        <div class="mb-3">
            <label>Installment No</label>
            <input type="number" name="installment_no" class="form-control" required>
        </div>

        <!-- Amount -->
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <!-- Due Date -->
        <div class="mb-3">
            <label>Due Date</label>
            <input type="date" name="due_date" class="form-control" required>
        </div>

        <button class="btn btn-primary">
            Save Installment
        </button>

    </form>

</div>

@endsection