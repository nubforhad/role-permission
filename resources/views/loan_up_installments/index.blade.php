@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4>Loan Up Installments</h4>

            {{-- ➕ CREATE BUTTON --}}
    <a href="{{ route('loanup.installment.create', request()->loan_id) }}"
       class="btn btn-primary">
        + Create Installment
    </a>

        </div>

        <div class="card">
            <div class="card-body">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Loan ID</th>
                            <th>Installment No</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th width="200">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($installments as $inst)

                        <tr>
                            <td>{{ $inst->id }}</td>

                            <td>
                                <a href="{{ route('loanups.show', $inst->loan_up_id) }}">
                                    {{ $inst->loan_up_id }}
                                </a>
                            </td>

                            <td>{{ $inst->installment_no }}</td>

                            <td>{{ number_format($inst->amount, 2) }}</td>

                            <td>{{ number_format($inst->paid_amount, 2) }}</td>

                            <td>{{ number_format($inst->due_amount, 2) }}</td>

                            <td>{{ $inst->due_date }}</td>

                            <td>
                                @if($inst->status == 'Paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($inst->status == 'Partial')
                                    <span class="badge bg-warning text-dark">Partial</span>
                                @else
                                    <span class="badge bg-danger">Pending</span>
                                @endif
                            </td>

                            <td>

                                {{-- VIEW --}}
                                <a href="{{ route('loanup.installment.show', $inst->id) }}"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                {{-- PAY --}}
                                @if($inst->status != 'Paid')

                                <form action="{{ route('loanup.installment.pay', $inst->id) }}"
                                      method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-success btn-sm">
                                        Pay
                                    </button>
                                </form>

                                @endif

                                {{-- DELETE --}}
                                <form action="{{ route('loanup.installment.delete', $inst->id) }}"
                                      method="POST"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this installment?')">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                No Installments Found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

    </div>
</div>

@endsection