<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanUpInstallment;
use App\Models\LoanUp;
 
class LoanUpInstallmentController extends Controller
{
    /**
     * List all installments
     */
    public function index()
    {
        $installments = LoanUpInstallment::with('loan')
            ->latest()
            ->get();

        return view('loan_up_installments.index', compact('installments'));
    }

    /**
     * Create form
     */
    public function create($loan_up_id = null)
    {
        $loans = LoanUp::all();

        return view('loan_up_installments.create', compact('loans', 'loan_up_id'));
    }

    /**
     * Store installment
     */
    public function store(Request $request)
    {
        $request->validate([
            'loan_up_id' => 'required|exists:loan_ups,id',
            'installment_no' => 'required|integer',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        $data = $request->all();

        $data['due_amount'] = $request->amount;
        $data['paid_amount'] = 0;
        $data['status'] = 'Pending';

        LoanUpInstallment::create($data);

        return redirect()->route('loanup.installment.index')
            ->with('success', 'Installment created successfully');
    }

    /**
     * Show single record
     */
    public function show($id)
    {
        $installment = LoanUpInstallment::with('loan')->findOrFail($id);

        return view('loan_up_installments.show', compact('installment'));
    }

    /**
     * Edit form
     */
    public function edit($id)
    {
        $installment = LoanUpInstallment::findOrFail($id);
        $loans = LoanUp::all();

        return view('loan_up_installments.edit', compact('installment', 'loans'));
    }

    /**
     * Update
     */
    public function update(Request $request, $id)
    {
        $installment = LoanUpInstallment::findOrFail($id);

        $request->validate([
            'loan_up_id' => 'required|exists:loan_ups,id',
            'installment_no' => 'required|integer',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        $data = $request->all();

        // auto calculate due
        $data['due_amount'] = $request->amount - $installment->paid_amount;

        // status update
        if ($installment->paid_amount == 0) {
            $data['status'] = 'Pending';
        } elseif ($installment->paid_amount < $request->amount) {
            $data['status'] = 'Partial';
        } else {
            $data['status'] = 'Paid';
        }

        $installment->update($data);

        return redirect()->route('loanup.installment.index')
            ->with('success', 'Installment updated successfully');
    }

    /**
     * Delete
     */
    public function destroy($id)
    {
        LoanUpInstallment::findOrFail($id)->delete();

        return back()->with('success', 'Installment deleted successfully');
    }
}