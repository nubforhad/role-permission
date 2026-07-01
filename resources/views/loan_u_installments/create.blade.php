@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header">
                <h4>Create Loan Installment</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('loan-u-installments.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Loan</label>
                            <select name="loan_up_id" class="form-control" required>
                                <option value="">Select Loan</option>

                                @foreach($loans as $loan)
                                    <option value="{{ $loan->id }}">
                                        Loan #{{ $loan->id }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Installment No</label>
                            <input type="number"
                                   name="installment_no"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Amount</label>
                            <input type="number"
                                   step="0.01"
                                   name="amount"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Due Amount</label>
                            <input type="number"
                                   step="0.01"
                                   name="due_amount"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Due Date</label>
                            <input type="date"
                                   name="due_date"
                                   class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>

                            <select name="status" class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="Partial">Partial</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>

                    </div>

                    <button class="btn btn-primary">
                        Save Installment
                    </button>

                    <a href="{{ route('loan-u-installments.index') }}"
                       class="btn btn-secondary">
                        Back
                    </a>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection