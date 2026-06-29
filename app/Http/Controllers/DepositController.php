<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Member;
use App\Models\Branch;
use App\Models\DepositCategory;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with(['member', 'branch', 'category'])
            ->latest()
            ->get();

        return view('deposits.index', compact('deposits'));
    }

    public function create()
    {
        $members = Member::all();
        $branches = Branch::all();
        $categories = DepositCategory::all();

        return view('deposits.create', compact('members', 'branches', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'branch_id' => 'required',
            'deposit_category_id' => 'required',
            'deposit_amount' => 'required|numeric',
            'start_date' => 'required|date',
             'status' => 'required|in:running,completed,closed,cancelled',
        ]);

        // auto calculation (optional but useful)
        $interest = $request->interest_rate ?? 0;

        $interestAmount = ($request->deposit_amount * $interest) / 100;
        $totalAmount = $request->deposit_amount + $interestAmount;

        Deposit::create([
            'user_id' => auth()->id(),
            'branch_id' => $request->branch_id,
            'member_id' => $request->member_id,
            'deposit_category_id' => $request->deposit_category_id,

            'deposit_no' => 'DEP-' . time(),
            'member_code' => $request->member_code,

            'deposit_amount' => $request->deposit_amount,
            'interest_rate' => $interest,
            'interest_amount' => $interestAmount,
            'total_amount' => $totalAmount,

            'paid_amount' => 0,
            'due_amount' => $totalAmount,

            'start_date' => $request->start_date,
            'maturity_date' => $request->maturity_date,

             'status' => $request->status,
            'remark' => $request->remark,
        ]);

        return redirect()->route('deposits.index')
            ->with('success', 'Deposit created successfully');
    }

    public function show(Deposit $deposit)
    {
        $deposit->load(['member', 'branch', 'category', 'collections', 'withdraws']);

        return view('deposits.show', compact('deposit'));
    }

    public function edit(Deposit $deposit)
    {
        $members = Member::all();
        $branches = Branch::all();
        $categories = DepositCategory::all();

        return view('deposits.edit', compact('deposit', 'members', 'branches', 'categories'));
    }

    public function update(Request $request, Deposit $deposit)
    {
        $request->validate([
            'member_id' => 'required',
            'branch_id' => 'required',
            'deposit_category_id' => 'required',
            'deposit_amount' => 'required|numeric',
            'start_date' => 'required|date',
        ]);

        $interest = $request->interest_rate ?? 0;

        $interestAmount = ($request->deposit_amount * $interest) / 100;
        $totalAmount = $request->deposit_amount + $interestAmount;

        $deposit->update([
            'branch_id' => $request->branch_id,
            'member_id' => $request->member_id,
            'deposit_category_id' => $request->deposit_category_id,

            'member_code' => $request->member_code,

            'deposit_amount' => $request->deposit_amount,
            'interest_rate' => $interest,
            'interest_amount' => $interestAmount,
            'total_amount' => $totalAmount,

            'due_amount' => $totalAmount - $deposit->paid_amount,

            'start_date' => $request->start_date,
            'maturity_date' => $request->maturity_date,

            'remark' => $request->remark,
        ]);

        return redirect()->route('deposits.index')
            ->with('success', 'Deposit updated successfully');
    }

    public function destroy(Deposit $deposit)
    {
        $deposit->delete();

        return redirect()->route('deposits.index')
            ->with('success', 'Deposit deleted successfully');
    }
}