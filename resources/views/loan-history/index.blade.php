@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-0 fw-bold">Loan History</h4>
                <small class="text-muted">View member loan collection history</small>
            </div>
        </div>

        <!-- Search Card -->
        <div class="card mb-4">
            <div class="card-body">

                <form action="{{ route('loan-history.search') }}" method="POST">
                    @csrf

                    <div class="row align-items-end">

                        <div class="col-md-4">
                            <label class="form-label">Select Member</label>

                            <select name="member_code" class="form-select" required>
                                <option value="">Select Member</option>

                                @foreach($members as $member)

                                    <option value="{{ $member->member_code }}"
                                        @if(request('member_code') == $member->member_code) selected @endif>

                                        {{ $member->member_code }} - {{ $member->member_name }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">
                                <i class="bx bx-search"></i> Search
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

        @if(isset($loan))

        <!-- Summary Cards -->
        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card border-success">
                    <div class="card-body text-center">

                        <h6 class="text-muted mb-2">
                            Total Loan
                        </h6>

                        <h3 class="text-success fw-bold">
                            {{ number_format($totalLoan,2) }}
                        </h3>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-body text-center">

                        <h6 class="text-muted mb-2">
                            Total Paid
                        </h6>

                        <h3 class="text-info fw-bold">
                            {{ number_format($totalPaid,2) }}
                        </h3>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-danger">
                    <div class="card-body text-center">

                        <h6 class="text-muted mb-2">
                            Remaining
                        </h6>

                        <h3 class="text-danger fw-bold">
                            {{ number_format($due,2) }}
                        </h3>

                    </div>
                </div>
            </div>

        </div>

        <!-- Collection History -->
        <div class="card">

            <div class="card-header">
                <h5 class="mb-0">
                    Collection History
                </h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th width="60">SL</th>
                                <th>Date</th>
                                <th>Paid Amount</th>
                                <th>Receipt No</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($collections as $key=>$row)

                            <tr>

                                <td>{{ $key + 1 }}</td>

                                <td>{{ $row->collection_date }}</td>

                                <td>{{ number_format($row->paid_amount,2) }}</td>

                                <td>#{{ str_pad($row->id,6,'0',STR_PAD_LEFT) }}</td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="4" class="text-center text-muted">

                                    No Collection Found

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        @endif

    </div>
</div>

@endsection