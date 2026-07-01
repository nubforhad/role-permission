@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header">
                <h4>Edit Loan Installment</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('loan-u-installments.update', $installment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Loan</label>

                            <select name="loan_up_id" class="form-control" required>

                                @foreach($loans as $loan)

                                    <option value="{{ $loan->id }}"
                                        {{ $installment->loan_up_id == $loan->id ? 'selected' : '' }}>

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
                                   value="{{ old('installment_no', $installment->installment_no) }}"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Amount</label>

                            <input type="number"
                                   step="0.01"
                                   name="amount"
                                   class="form-control"
                                   value="{{ old('amount', $installment->amount) }}"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Paid Amount</label>

                            <input type="number"
                                   step="0.01"
                                   name="paid_amount"
                                   class="form-control"
                                   value="{{ old('paid_amount', $installment->paid_amount) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Due Amount</label>

                            <input type="number"
                                   step="0.01"
                                   name="due_amount"
                                   class="form-control"
                                   value="{{ old('due_amount', $installment->due_amount) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Due Date</label>

                            <input type="date"
                                   name="due_date"
                                   class="form-control"
                                   value="{{ $installment->due_date }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Paid Date</label>

                            <input type="date"
                                   name="paid_date"
                                   class="form-control"
                                   value="{{ $installment->paid_date }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>

                            <select name="status" class="form-control">

                                <option value="Pending" {{ $installment->status=='Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="Partial" {{ $installment->status=='Partial' ? 'selected' : '' }}>
                                    Partial
                                </option>

                                <option value="Paid" {{ $installment->status=='Paid' ? 'selected' : '' }}>
                                    Paid
                                </option>

                            </select>

                        </div>

                    </div>

                    <button class="btn btn-primary">
                        Update
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