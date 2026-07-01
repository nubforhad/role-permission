<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LoanUInstallment;
use App\Models\LoanUp;

class LoanUInstallmentController extends Controller
{
    public function index()
    {
        $installments = LoanUInstallment::latest()->paginate(10);

        return view('loan_u_installments.index', compact('installments'));
    }

    public function create()
    {
        $loans = LoanUp::where('status', 'Approved')->get();

        return view('loan_u_installments.create', compact('loans'));
    }

public function store(Request $request)
{
    $request->validate([
        'loan_up_id'       => 'required|exists:loan_ups,id',
        'installment_no'   => 'required|integer|min:1',
        'amount'           => 'required|numeric|min:0',
        'due_amount'       => 'required|numeric|min:0',
        'due_date'         => 'nullable|date',
        'status'           => 'required|in:Pending,Partial,Paid',
    ]);

    LoanUInstallment::create([
        'loan_up_id'     => $request->loan_up_id,
        'installment_no' => $request->installment_no,
        'amount'         => $request->amount,
        'paid_amount'    => $request->paid_amount ?? 0,
        'due_amount'     => $request->due_amount,
        'due_date'       => $request->due_date,
        'paid_date'      => $request->paid_date,
        'status'         => $request->status,
    ]);

    return redirect()
        ->route('loan-u-installments.index')
        ->with('success', 'Installment created successfully.');
}

    public function edit($id)
    {
        $installment = LoanUInstallment::findOrFail($id);
        $loans = LoanUp::all();

        return view('loan_u_installments.edit', compact('installment', 'loans'));
    }
public function update(Request $request, $id)
{
    $request->validate([
        'loan_up_id'       => 'required|exists:loan_ups,id',
        'installment_no'   => 'required|integer|min:1',
        'amount'           => 'required|numeric|min:0',
        'due_amount'       => 'required|numeric|min:0',
        'due_date'         => 'nullable|date',
        'status'           => 'required|in:Pending,Partial,Paid',
    ]);

    $installment = LoanUInstallment::findOrFail($id);

    $installment->update([
        'loan_up_id'     => $request->loan_up_id,
        'installment_no' => $request->installment_no,
        'amount'         => $request->amount,
        'paid_amount'    => $request->paid_amount ?? 0,
        'due_amount'     => $request->due_amount,
        'due_date'       => $request->due_date,
        'paid_date'      => $request->paid_date,
        'status'         => $request->status,
    ]);

    return redirect()
        ->route('loan-u-installments.index')
        ->with('success', 'Installment updated successfully.');
}

}
