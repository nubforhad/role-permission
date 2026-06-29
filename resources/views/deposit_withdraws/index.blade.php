@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Deposit Withdraws</h4>
                <small class="text-muted">Manage all withdraw transactions</small>
            </div>

            <a href="{{ route('deposit-withdraws.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Create Withdraw
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-primary">
                            <tr>
                                <th>SL</th>
                                <th>Withdraw No</th>
                                <th>Deposit No</th>
                                <th>Member</th>
                                <th>Branch</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($withdraws as $withdraw)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $withdraw->withdraw_no }}</td>

                                <td>{{ $withdraw->deposit->deposit_no ?? 'N/A' }}</td>

                                <td>{{ $withdraw->deposit->member->member_name ?? 'N/A' }}</td>

                                <td>{{ $withdraw->branch->name ?? 'N/A' }}</td>

                                <td>{{ number_format($withdraw->withdraw_amount,2) }}</td>

                                <td>{{ ucfirst($withdraw->payment_method) }}</td>

                                <td>{{ \Carbon\Carbon::parse($withdraw->withdraw_date)->format('d M Y') }}</td>

                                <td>
                                    @if($withdraw->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif($withdraw->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>

                                <td class="text-center">

                                    <form action="{{ route('deposit-withdraws.destroy',$withdraw->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        <a href="{{ route('deposit-withdraws.show',$withdraw->id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('deposit-withdraws.edit',$withdraw->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="10" class="text-center py-4">
                                    No Withdraw Found.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection