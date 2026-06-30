@extends('layouts.app')

@section('content')

<div class="container">

    <h3>Edit Installment</h3>

    <form action="{{ route('loanup.installment.update', $installment->id) }}" method="POST">
        @csrf

        <!-- Installment No -->
        <div class="mb-3">
            <label>Installment No</label>
            <input type="number" name="installment_no"
                   class="form-control"
                   value="{{ $installment->installment_no }}" required>
        </div>

        <!-- Amount -->
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" name="amount"
                   class="form-control"
                   value="{{ $installment->amount }}" required>
        </div>

        <!-- Due Date -->
        <div class="mb-3">
            <label>Due Date</label>
            <input type="date" name="due_date"
                   class="form-control"
                   value="{{ $installment->due_date }}" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">

                <option value="Pending" {{ $installment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Partial" {{ $installment->status == 'Partial' ? 'selected' : '' }}>Partial</option>
                <option value="Paid" {{ $installment->status == 'Paid' ? 'selected' : '' }}>Paid</option>

            </select>
        </div>

        <!-- Note -->
        <div class="mb-3">
            <label>Note</label>
            <textarea name="note" class="form-control">{{ $installment->note }}</textarea>
        </div>

        <button class="btn btn-primary">
            Update Installment
        </button>

    </form>

</div>

@endsection