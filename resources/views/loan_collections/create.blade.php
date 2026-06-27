@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="fw-bold mb-0">Add Loan Collection</h4>
                <small class="text-muted">Receive installment from member</small>
            </div>

            <a href="{{ route('loan-collections.index') }}" class="btn btn-secondary">
                ← Back
            </a>
        </div>

        <!-- Form Card -->
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

                        <!-- Loan -->
                        <div class="col-md-6 mb-3">
                            <label>Loan</label>
                            <select name="loan_section_id" class="form-control" required>
                                <option value="">Select Loan</option>
                                @foreach($loans as $loan)
                                    <option value="{{ $loan->id }}">
                                        Loan #{{ $loan->id }} - {{ $loan->loan_amount }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Member -->
                        <div class="col-md-6 mb-3">
                            <label>Member</label>
                            <select name="member_id" id="member_id" class="form-control" required>
                                <option value="">Select Member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" data-code="{{ $member->member_code }}">
                                        {{ $member->name }} ({{ $member->member_code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Member Code (auto fill) -->
                        <div class="col-md-6 mb-3">
                            <label>Member Code</label>
                            <input type="text" name="member_code" id="member_code" class="form-control" readonly>
                        </div>

                        <!-- Installment -->
                        <div class="col-md-6 mb-3">
                            <label>Installment Amount</label>
                            <input type="number" step="0.01" name="installment_amount" class="form-control" required>
                        </div>

                        <!-- Paid -->
                        <div class="col-md-6 mb-3">
                            <label>Paid Amount</label>
                            <input type="number" step="0.01" name="paid_amount" class="form-control" required>
                        </div>

                        <!-- Penalty -->
                        <div class="col-md-6 mb-3">
                            <label>Penalty Charge</label>
                            <input type="number" step="0.01" name="penalty_charge" class="form-control" value="0">
                        </div>

                        <!-- Paid Date -->
                        <div class="col-md-6 mb-3">
                            <label>Paid Date</label>
                            <input type="date" name="paid_date" class="form-control">
                        </div>

                        <!-- Remark -->
                        <div class="col-md-12 mb-3">
                            <label>Remark</label>
                            <textarea name="remark" class="form-control" rows="3"></textarea>
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

<!-- JS for auto member code -->
<script>
document.getElementById('member_id').addEventListener('change', function () {
    let code = this.options[this.selectedIndex].getAttribute('data-code');
    document.getElementById('member_code').value = code ?? '';
});
</script>

@endsection