<?php

namespace App\Http\Controllers;

use App\Models\LoanUp;
use App\Models\LoanUpCategory;
use App\Models\Member;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\LoanInstallment;

class LoanUpController extends Controller
{


    private function generateInstallments($loan)
    {
        $total = $loan->total_payable;
        $duration = $loan->duration;

        $emi = $loan->emi_amount;

        for ($i = 1; $i <= $duration; $i++) {

            LoanInstallment::create([
                'loan_up_id' => $loan->id,
                'installment_no' => $i,
                'amount' => $emi,
                'paid_amount' => 0,
                'due_amount' => $emi,
                'due_date' => now()->addMonths($i),
                'status' => 'Pending',
            ]);
        }
    }

    /**
     * Display a listing of loans
     */
    public function index()
    {
        $loans = LoanUp::with(['member', 'branch', 'category'])
            ->latest()
            ->paginate(10);

        return view('loan_ups.index', compact('loans'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $branches = Branch::all();
        $members = Member::all();
        $categories = LoanUpCategory::where('status', 1)->get();

        return view('loan_ups.create', compact('branches', 'members', 'categories'));
    }

    /**
     * Store new loan
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'branch_id' => 'required',
    //         'member_id' => 'required',
    //         'loan_up_category_id' => 'required',
    //         'loan_amount' => 'required|numeric|min:0',
    //         'duration' => 'required|integer|min:1',
    //     ]);

    //     $category = LoanUpCategory::findOrFail($request->loan_up_category_id);

    //     $loanAmount = $request->loan_amount;
    //     $rate = $category->interest_rate;
    //     $duration = $request->duration;

    //     // 🔥 Interest Calculation (Simple Interest)
    //     $interest = ($loanAmount * $rate * $duration) / 100;

    //     $totalPayable = $loanAmount + $interest;
    //     $emi = $duration > 0 ? $totalPayable / $duration : 0;

    //     $loan = LoanUp::create([
    //         'branch_id' => $request->branch_id,
    //         'member_id' => $request->member_id,
    //         'loan_up_category_id' => $request->loan_up_category_id,

    //         'loan_amount' => $loanAmount,
    //         'interest_rate' => $rate,
    //         'interest_type' => $category->interest_type,

    //         'duration' => $duration,
    //         'duration_type' => $category->duration_type,
    //         'installment_type' => $category->installment_type,

    //         'total_interest' => $interest,
    //         'total_payable' => $totalPayable,
    //         'emi_amount' => $emi,

    //         'status' => 'Pending',
    //     ]);

    //     return redirect()
    //         ->route('loan-ups.index')
    //         ->with('success', 'Loan created successfully!');
    // }


public function store(Request $request)
{
    $request->validate([
        'branch_id' => 'required',
        'member_id' => 'required',
        'loan_up_category_id' => 'required',
        'loan_amount' => 'required|numeric|min:0',
        'duration' => 'required|integer|min:1',
    ]);

    /**
     * 🚨 CHECK ACTIVE INSTALLMENTS (REAL LOGIC)
     */
    $hasPendingInstallment = LoanInstallment::whereHas('loan', function ($q) use ($request) {
        $q->where('member_id', $request->member_id);
    })
    ->whereIn('status', ['Pending', 'Partial'])
    ->exists();

    if ($hasPendingInstallment) {
        return redirect()->back()->with('warning',
            'This member has unpaid installments. Please complete previous loan first.'
        );
    }

    $category = LoanUpCategory::findOrFail($request->loan_up_category_id);

    $loanAmount = $request->loan_amount;
    $rate = $category->interest_rate;
    $duration = $request->duration;

    // Interest
    $interest = ($loanAmount * $rate * $duration) / 100;

    $totalPayable = $loanAmount + $interest;

    $emi = $duration > 0 ? $totalPayable / $duration : 0;

    /**
     * ✅ CREATE LOAN
     */
    $loan = LoanUp::create([
        'branch_id' => $request->branch_id,
        'member_id' => $request->member_id,
        'loan_up_category_id' => $request->loan_up_category_id,

        'loan_amount' => $loanAmount,
        'interest_rate' => $rate,
        'interest_type' => $category->interest_type,

        'duration' => $duration,
        'duration_type' => $category->duration_type,
        'installment_type' => $category->installment_type,

        'total_interest' => $interest,
        'total_payable' => $totalPayable,
        'emi_amount' => $emi,

        'status' => 'Pending',
    ]);

    /**
     * 🚀 GENERATE INSTALLMENTS
     */
    // for ($i = 1; $i <= $duration; $i++) {
    //     LoanInstallment::create([
    //         'loan_up_id' => $loan->id,
    //         'installment_no' => $i,
    //         'amount' => $emi,
    //         'paid_amount' => 0,
    //         'due_amount' => $emi,
    //         'due_date' => now()->addMonths($i),
    //         'status' => 'Pending',
    //     ]);
    // }

    return redirect()
        ->route('loan-ups.index')
        ->with('success', 'Loan created successfully!');
}

 
    /**
     * Show single loan
     */
    public function show(LoanUp $loanUp)
    {
        $loanUp->load(['member', 'branch', 'category']);

        return view('loan_ups.show', compact('loanUp'));
    }

    /**
     * Edit form
     */
    public function edit(LoanUp $loanUp)
    {
        $branches = Branch::all();
        $members = Member::all();
        $categories = LoanUpCategory::where('status', 1)->get();

        return view('loan_ups.edit', compact('loanUp', 'branches', 'members', 'categories'));
    }

    /**
     * Update loan
     */
    public function update(Request $request, LoanUp $loanUp)
    {
        $request->validate([
            'branch_id' => 'required',
            'member_id' => 'required',
            'loan_up_category_id' => 'required',
            'loan_amount' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        $category = LoanUpCategory::findOrFail($request->loan_up_category_id);

        $loanAmount = $request->loan_amount;
        $rate = $category->interest_rate;
        $duration = $request->duration;

        $interest = ($loanAmount * $rate * $duration) / 100;

        $totalPayable = $loanAmount + $interest;
        $emi = $duration > 0 ? $totalPayable / $duration : 0;

        $loanUp->update([
            'branch_id' => $request->branch_id,
            'member_id' => $request->member_id,
            'loan_up_category_id' => $request->loan_up_category_id,

            'loan_amount' => $loanAmount,
            'interest_rate' => $rate,
            'interest_type' => $category->interest_type,

            'duration' => $duration,
            'duration_type' => $category->duration_type,
            'installment_type' => $category->installment_type,

            'total_interest' => $interest,
            'total_payable' => $totalPayable,
            'emi_amount' => $emi,
        ]);

        return redirect()
            ->route('loan-ups.index')
            ->with('success', 'Loan updated successfully!');
    }

    /**
     * Delete loan
     */
    public function destroy(LoanUp $loanUp)
    {
        $loanUp->delete();

        return redirect()
            ->route('loan-ups.index')
            ->with('success', 'Loan deleted successfully!');
    }


    public function approve($id)
    {
        $loan = LoanUp::findOrFail($id);

        $loan->update([
            'status' => 'Approved',
            'approval_date' => now(),
        ]);
$this->generateInstallments($loan);
        return back()->with('success', 'Loan Approved Successfully');
    }

    public function reject($id)
    {
        $loan = LoanUp::findOrFail($id);

        $loan->update([
            'status' => 'Rejected',
            'approval_date' => now(),
        ]);

        return back()->with('success', 'Loan Rejected Successfully');
    }





}