@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-bold">Deposits</h4>
                <small class="text-muted">Manage all deposits</small>
            </div>

            <a href="{{ route('deposits.create') }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Create New Deposit
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
                                <th>Deposit No</th>
                                <th>Member</th>
                                <th>Category</th>
                                <th>Branch</th>
                                <th>Amount</th>
                                <th>Interest</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($deposits as $deposit)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $deposit->deposit_no }}</td>

                                <td>
                                    {{ $deposit->member->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $deposit->category->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $deposit->branch->name ?? 'N/A' }}
                                </td>

                                <td>{{ number_format($deposit->deposit_amount,2) }}</td>

                                <td>{{ $deposit->interest_rate }}%</td>

                                <td>{{ number_format($deposit->total_amount,2) }}</td>

                                <td>{{ number_format($deposit->paid_amount,2) }}</td>

                                <td>{{ number_format($deposit->due_amount,2) }}</td>

                                <td>
                                    @if($deposit->status == 'active')
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            {{ ucfirst($deposit->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">

                                    <form action="{{ route('deposits.destroy',$deposit->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        <a href="{{ route('deposits.show',$deposit->id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('deposits.edit',$deposit->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-pen-to-square"></i>
                                        </a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this deposit?')">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="12" class="text-center py-4">
                                    No Deposit Found.
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