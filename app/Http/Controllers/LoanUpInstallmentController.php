<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanUpInstallment;
use App\Models\LoanUp;

class LoanUpInstallmentController extends Controller
{
    /**
     * Installment List (by loan or all)
     */
    public function index($loan_id = null)
    {
        $query = LoanUpInstallment::with('loan');

        if ($loan_id) {
            $query->where('loan_up_id', $loan_id);
        }

        $installments = $query->orderBy('installment_no')->get();

        return view('loan_up_installments.index', compact('installments'));
    }

    /**
     * Create page
     */
    public function create($loan_id)
    {
        $loan = LoanUp::findOrFail($loan_id);

        return view('loan_up_installments.create', compact('loan'));
    }

    /**
     * Store installment
     */
    public function store(Request $request)
    {
        $request->validate([
            'loan_up_id' => 'required|exists:loan_ups,id',
            'installment_no' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        LoanUpInstallment::create([
            'loan_up_id' => $request->loan_up_id,
            'installment_no' => $request->installment_no,
            'amount' => $request->amount,
            'due_amount' => $request->amount,
            'due_date' => $request->due_date,
            'status' => 'Pending',
        ]);

        return redirect()
            ->route('loanup.installments.index', ['loan_id' => $request->loan_up_id])
            ->with('success', 'Installment Created Successfully');
    }


    public function edit($id)
    {
        $installment = LoanUpInstallment::findOrFail($id);

        return view('loan_up_installments.edit', compact('installment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'installment_no' => 'required|integer',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required',
        ]);

        $installment = LoanUpInstallment::findOrFail($id);

        $installment->update([
            'installment_no' => $request->installment_no,
            'amount' => $request->amount,
            'due_amount' => $request->amount - $installment->paid_amount,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'note' => $request->note,
        ]);

        return redirect()->route('loanup.installments.index', ['loan_id' => $installment->loan_up_id])
            ->with('success', 'Installment Updated Successfully');
    }

    /**
     * Show single installment
     */
    public function show($id)
    {
        $installment = LoanUpInstallment::with('loan')->findOrFail($id);

        return view('loan_up_installments.show', compact('installment'));
    }

    /**
     * Full payment (cash)
     */
    public function pay(Request $request, $id)
    {
        $installment = LoanUpInstallment::findOrFail($id);

        $installment->update([
            'paid_amount' => $installment->amount,
            'due_amount' => 0,
            'status' => 'Paid',
            'paid_date' => now(),
            'note' => $request->note ?? 'Cash received',
        ]);

        return back()->with('success', 'Installment marked as Paid');
    }

    /**
     * Partial payment
     */
    public function partialPay(Request $request, $id)
    {
        $request->validate([
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $installment = LoanUpInstallment::findOrFail($id);

        $alreadyPaid = $installment->paid_amount ?? 0;
        $newPaid = $request->paid_amount;

        $totalPaid = $alreadyPaid + $newPaid;

        $installment->update([
            'paid_amount' => $totalPaid,
            'due_amount' => max($installment->amount - $totalPaid, 0),
            'status' => ($totalPaid >= $installment->amount) ? 'Paid' : 'Partial',
            'paid_date' => now(),
            'note' => $request->note ?? null,
        ]);

        return back()->with('success', 'Partial payment updated');
    }

    /**
     * Delete installment
     */
    public function destroy($id)
    {
        $installment = LoanUpInstallment::findOrFail($id);
        $installment->delete();

        return back()->with('success', 'Installment deleted successfully');
    }
}