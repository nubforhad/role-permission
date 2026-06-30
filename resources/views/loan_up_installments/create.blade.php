 @extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Create Installment</h4>

            <a href="{{ route('loanup.installment.index') }}" class="btn btn-secondary">
                ← Back
            </a>
        </div>

        <!-- Form -->
        <div class="card">
            <div class="card-body">

                <form action="{{ route('loanup.installment.store') }}" method="POST">
                    @csrf

                    <!-- Loan Select -->
                    <div class="mb-3">
                        <label class="form-label">Select Loan</label>
                        <select name="loan_up_id" class="form-control" required>
                            <option value="">-- Choose Loan --</option>

                            @foreach($loans as $loan)
                                <option value="{{ $loan->id }}"
                                    {{ (isset($loan_up_id) && $loan_up_id == $loan->id) ? 'selected' : '' }}>
                                    {{ $loan->title ?? ('Loan #' . $loan->id) }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Installment No -->
                    <div class="mb-3">
                        <label class="form-label">Installment No</label>
                        <input type="number" name="installment_no" class="form-control"
                               placeholder="Enter installment number" required>
                    </div>

                    <!-- Amount -->
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" step="0.01" name="amount" class="form-control"
                               placeholder="Enter installment amount" required>
                    </div>

                    <!-- Due Date -->
                    <div class="mb-3">
                        <label class="form-label">Due Date</label>
                        <input type="date" name="due_date" class="form-control" required>
                    </div>

                    <!-- Note -->
                    <div class="mb-3">
                        <label class="form-label">Note (Optional)</label>
                        <textarea name="note" class="form-control" rows="3"
                                  placeholder="Write any note..."></textarea>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">
                        Save Installment
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection