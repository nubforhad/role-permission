<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\LoanUp;
use App\Models\LoanInstallment;

class LoanInstallmentController extends Controller
{
    /**
     * 🔹 Page
     */
    public function index()
    {
        return view('loan_installments.index');
    }

    /**
     * 🔍 Search by Member Code (AJAX)
     */
   public function search(Request $request)
{
    $member = Member::where('member_code', $request->member_code)->first();

    if (!$member) {
        return response()->json([
            'status' => false,
            'message' => 'Member not found'
        ]);
    }

    // 🔥 Get latest loan
    $loan = LoanUp::where('member_id', $member->id)
        ->latest()
        ->first();

    if (!$loan) {
        return response()->json([
            'status' => false,
            'message' => 'No loan found'
        ]);
    }

    // 🔥 Get next pending installment
    $installment = LoanInstallment::where('loan_up_id', $loan->id)
        ->whereIn('status', ['Pending', 'Partial'])
        ->orderBy('installment_no', 'asc')
        ->first();

    // ❗ If no pending installment
    if (!$installment) {
        return response()->json([
            'status' => false,
            'message' => 'All installments are Paid (Loan Completed)'
        ]);
    }

    return response()->json([
        'status' => true,
        'member' => $member,
        'loan' => $loan,
        'installment' => $installment
    ]);
}

    /**
     * 💰 Payment Collect
     */
    public function pay(Request $request)
    {
        $request->validate([
            'installment_id' => 'required|exists:loan_installments,id',
            'paid_amount' => 'required|numeric|min:1',
        ]);

        $installment = LoanInstallment::findOrFail($request->installment_id);

        // 🔥 update payment
        $installment->paid_amount += $request->paid_amount;
        $installment->due_amount = $installment->amount - $installment->paid_amount;

        if ($installment->due_amount <= 0) {
            $installment->status = 'Paid';
            $installment->paid_date = now();
            $installment->due_amount = 0;
        } else {
            $installment->status = 'Partial';
        }

        $installment->save();

        // 🔥 check loan complete
        $loan = $installment->loan;

        $remaining = LoanInstallment::where('loan_up_id', $loan->id)
            ->whereIn('status', ['Pending', 'Partial'])
            ->count();

        if ($remaining == 0) {
            $loan->update([
                'status' => 'Completed'
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Payment Successful');
    }
}