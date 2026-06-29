@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Edit Collection</h4>
                <small class="text-muted">Update deposit collection</small>
            </div>

            <a href="{{ route('deposit-collections.index') }}" class="btn btn-secondary btn-sm">
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

                <form action="{{ route('deposit-collections.update', $depositCollection->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Deposit (readonly) -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deposit</label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $depositCollection->deposit->deposit_no ?? '' }}"
                                   readonly>
                        </div>

                        <!-- Branch -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Branch</label>

                            <select name="branch_id" class="form-select" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ $depositCollection->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Available Balance -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Available Balance</label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $depositCollection->deposit->total_amount - $depositCollection->deposit->paid_amount }}"
                                   readonly>
                        </div>

                        <!-- Collection Amount -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Collection Amount</label>

                            <input type="number"
                                   step="0.01"
                                   name="collection_amount"
                                   class="form-control"
                                   value="{{ $depositCollection->collection_amount }}"
                                   required>
                        </div>

                        <!-- Collection Date -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Collection Date</label>

                            <input type="date"
                                   name="collection_date"
                                   class="form-control"
                                   value="{{ \Carbon\Carbon::parse($depositCollection->collection_date)->format('Y-m-d') }}"
                                   required>
                        </div>

                        <!-- Payment Method -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Payment Method</label>

                            <select name="payment_method" class="form-select" required>

                                <option value="cash" {{ $depositCollection->payment_method == 'cash' ? 'selected' : '' }}>
                                    Cash
                                </option>

                                <option value="bkash" {{ $depositCollection->payment_method == 'bkash' ? 'selected' : '' }}>
                                    Bkash
                                </option>

                                <option value="nagad" {{ $depositCollection->payment_method == 'nagad' ? 'selected' : '' }}>
                                    Nagad
                                </option>

                                <option value="rocket" {{ $depositCollection->payment_method == 'rocket' ? 'selected' : '' }}>
                                    Rocket
                                </option>

                                <option value="bank" {{ $depositCollection->payment_method == 'bank' ? 'selected' : '' }}>
                                    Bank
                                </option>

                            </select>
                        </div>

                        <!-- Remark -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Remark</label>

                            <textarea name="remark" rows="3" class="form-control">
                                {{ $depositCollection->remark }}
                            </textarea>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update Collection
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection