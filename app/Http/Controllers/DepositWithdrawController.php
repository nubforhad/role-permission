<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\DepositWithdraw;
use App\Models\Branch;

class DepositWithdrawController extends Controller
{
    /**
     * List
     */
    public function index()
    {
        $withdraws = DepositWithdraw::with(['deposit','branch'])
            ->latest()
            ->get();

        return view('deposit_withdraws.index', compact('withdraws'));
    }

    /**
     * Create
     */
    public function create()
    {
        $deposits = Deposit::with('member')->get();
        $branches = Branch::all();

        return view('deposit_withdraws.create', compact('deposits','branches'));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([
            'deposit_id' => 'required',
            'branch_id' => 'required',
            'withdraw_amount' => 'required|numeric|min:1',
            'withdraw_date' => 'required|date',
            'payment_method' => 'required',
        ]);

        $deposit = Deposit::findOrFail($request->deposit_id);

        // Optional: prevent over withdraw
        if ($request->withdraw_amount > $deposit->total_amount) {
            return back()->withErrors(['withdraw_amount' => 'Withdraw amount exceeds deposit balance']);
        }

        $withdraw = DepositWithdraw::create([
            'user_id' => auth()->id(),
            'branch_id' => $request->branch_id,
            'deposit_id' => $request->deposit_id,

            'withdraw_no' => 'WTH-' . time(),
            'withdraw_date' => $request->withdraw_date,
            'withdraw_amount' => $request->withdraw_amount,

            'payment_method' => $request->payment_method,
            'status' => 'completed',
            'remark' => $request->remark,
        ]);

        // OPTIONAL LOGIC:
        // If you treat withdraw as reducing balance
        $deposit->paid_amount -= $request->withdraw_amount;

        if ($deposit->paid_amount < 0) {
            $deposit->paid_amount = 0;
        }

        $deposit->due_amount = $deposit->total_amount - $deposit->paid_amount;

        $deposit->status = ($deposit->due_amount <= 0) ? 'completed' : 'running';

        $deposit->save();

        return redirect()->route('deposit-withdraws.index')
            ->with('success','Withdraw created successfully');
    }

    /**
     * Show
     */
    public function show(DepositWithdraw $depositWithdraw)
    {
        $depositWithdraw->load(['deposit','branch','user']);

        return view('deposit_withdraws.show', compact('depositWithdraw'));
    }

    /**
     * Edit
     */
    public function edit(DepositWithdraw $depositWithdraw)
    {
        $deposits = Deposit::all();
        $branches = Branch::all();

        return view('deposit_withdraws.edit', compact('depositWithdraw','deposits','branches'));
    }

    /**
     * Update
     */
    public function update(Request $request, DepositWithdraw $depositWithdraw)
    {
        $request->validate([
            'withdraw_amount' => 'required|numeric|min:1',
            'withdraw_date' => 'required|date',
            'payment_method' => 'required',
        ]);

        $deposit = $depositWithdraw->deposit;

        // Reverse old withdraw
        $deposit->paid_amount += $depositWithdraw->withdraw_amount;

        // Apply new withdraw
        $deposit->paid_amount -= $request->withdraw_amount;

        if ($deposit->paid_amount < 0) {
            $deposit->paid_amount = 0;
        }

        $deposit->due_amount = $deposit->total_amount - $deposit->paid_amount;

        $deposit->status = ($deposit->due_amount <= 0) ? 'completed' : 'running';

        $deposit->save();

        $depositWithdraw->update([
            'withdraw_amount' => $request->withdraw_amount,
            'withdraw_date' => $request->withdraw_date,
            'payment_method' => $request->payment_method,
            'remark' => $request->remark,
        ]);

        return redirect()->route('deposit-withdraws.index')
            ->with('success','Withdraw updated successfully');
    }

    /**
     * Delete
     */
    public function destroy(DepositWithdraw $depositWithdraw)
    {
        $deposit = $depositWithdraw->deposit;

        // Reverse withdraw
        $deposit->paid_amount += $depositWithdraw->withdraw_amount;

        $deposit->due_amount = $deposit->total_amount - $deposit->paid_amount;

        $deposit->status = ($deposit->due_amount <= 0) ? 'completed' : 'running';

        $deposit->save();

        $depositWithdraw->delete();

        return redirect()->route('deposit-withdraws.index')
            ->with('success','Withdraw deleted successfully');
    }
}