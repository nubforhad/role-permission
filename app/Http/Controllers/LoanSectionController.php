<?php

namespace App\Http\Controllers;

use App\Models\LoanSection;
use App\Models\User;
use App\Models\InstallmentType;
use App\Models\LoanCategory;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Member;

class LoanSectionController extends Controller
{
    public function index()
    {
        $loans = LoanSection::with([
            'user',
            'installmentType',
            'loanCategory',
            'branch',
            'member'
        ])->latest()->paginate(10);

        return view('loanSections.index', compact('loans'));
    }

    public function create()
    {
        $users = User::all();
        $installments = InstallmentType::all();
        $categories = LoanCategory::all();
        $branches = Branch::all();
        $members = Member::all();

        return view('loanSections.create', compact(
            'users',
            'installments',
            'categories',
            'branches',
            'members'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'installment_type_id' => 'required',
            'loan_category_id' => 'required',
            'branch_id' => 'required',
            'member_id' => 'required',
            'loan_amount' => 'required|numeric|min:0',
            'interest' => 'nullable|numeric|min:0',
            'total_installment' => 'required|numeric|min:1',
            'remark' => 'nullable|string',
        ]);

        $interest = $request->interest ?? 0;

        $totalAmount = $request->loan_amount +
            ($request->loan_amount * $interest / 100);

        $totalInstallment = $request->total_installment;

        $paidPerInstallment = $totalAmount / $totalInstallment;

        LoanSection::create([
            'user_id' => $request->user_id,
            'installment_type_id' => $request->installment_type_id,
            'loan_category_id' => $request->loan_category_id,
            'branch_id' => $request->branch_id,
           'member_id' => $request->member_id,

            'loan_amount' => $request->loan_amount,
            'interest' => $interest,
            'total_amount' => round($totalAmount, 2),

            'total_installment' => $totalInstallment,
            'paid_per_installment' => round($paidPerInstallment, 2),

            'loan_status' => 'pending',
            'upline_status' => 'pending',

            'remark' => $request->remark,
        ]);

        return redirect()
            ->route('loan-sections.index')
            ->with('success', 'Loan created successfully.');
    }

    public function show(LoanSection $loanSection)
    {
        $loanSection->load([
            'user',
            'installmentType',
            'loanCategory',
            'branch',
            'member'
        ]);

        return view('loanSections.show', compact('loanSection'));
    }

    public function edit(LoanSection $loanSection)
    {
        $users = User::all();
        $installments = InstallmentType::all();
        $categories = LoanCategory::all();
        $branches = Branch::all();
        $members = Member::all();

        return view('loanSections.edit', compact(
            'loanSection',
            'users',
            'installments',
            'categories',
            'branches',
            'members'
        ));
    }

    public function update(Request $request, LoanSection $loanSection)
    {
        $request->validate([
            'user_id' => 'required',
            'installment_type_id' => 'required',
            'loan_category_id' => 'required',
            'branch_id' => 'required',
            'member_id' => 'required',
            'loan_amount' => 'required|numeric|min:0',
            'interest' => 'nullable|numeric|min:0',
            'total_installment' => 'required|numeric|min:1',
            'loan_status' => 'required',
            'upline_status' => 'nullable',
            'remark' => 'nullable|string',
        ]);

        $interest = $request->interest ?? 0;

        $totalAmount = $request->loan_amount +
            ($request->loan_amount * $interest / 100);

        $totalInstallment = $request->total_installment;

        $paidPerInstallment = $totalAmount / $totalInstallment;

        $loanSection->update([
            'user_id' => $request->user_id,
            'installment_type_id' => $request->installment_type_id,
            'loan_category_id' => $request->loan_category_id,
            'branch_id' => $request->branch_id,
            'member_id' => $request->member_id,

            'loan_amount' => $request->loan_amount,
            'interest' => $interest,
            'total_amount' => round($totalAmount, 2),

            'total_installment' => $totalInstallment,
            'paid_per_installment' => round($paidPerInstallment, 2),

            'loan_status' => $request->loan_status,
            'upline_status' => $request->upline_status,

            'remark' => $request->remark,
        ]);

        return redirect()
            ->route('loan-sections.index')
            ->with('success', 'Loan updated successfully.');
    }

    public function destroy(LoanSection $loanSection)
    {
        $loanSection->delete();

        return redirect()
            ->route('loan-sections.index')
            ->with('success', 'Loan deleted successfully.');
    }
}