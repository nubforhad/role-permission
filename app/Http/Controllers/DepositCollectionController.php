<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\DepositCollection;
use App\Models\Branch;

class DepositCollectionController extends Controller
{
    /**
     * List
     */
    public function index()
    {
        $collections = DepositCollection::with(['deposit','branch'])
            ->latest()
            ->get();

        return view('deposit_collections.index', compact('collections'));
    }

    /**
     * Create
     */
    public function create()
    {
        $deposits = Deposit::with('member')->get();
        $branches = Branch::all();

        return view('deposit_collections.create', compact('deposits','branches'));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([
            'deposit_id' => 'required',
            'branch_id' => 'required',
            'collection_amount' => 'required|numeric|min:1',
            'collection_date' => 'required|date',
            'payment_method' => 'required',
        ]);

        $deposit = Deposit::findOrFail($request->deposit_id);

        $collectionNo = 'COL-' . time();

        // Create Collection
        $collection = DepositCollection::create([
            'user_id' => auth()->id(),
            'branch_id' => $request->branch_id,
            'deposit_id' => $request->deposit_id,

            'collection_no' => $collectionNo,
            'collection_date' => $request->collection_date,
            'collection_amount' => $request->collection_amount,

            'payment_method' => $request->payment_method,
            'status' => 'completed',
            'remark' => $request->remark,
        ]);

        // Update Deposit Balance
        $deposit->paid_amount += $request->collection_amount;
        $deposit->due_amount = $deposit->total_amount - $deposit->paid_amount;

        // Auto status update
        if ($deposit->due_amount <= 0) {
            $deposit->status = 'completed';
            $deposit->due_amount = 0;
        }

        $deposit->save();

        return redirect()->route('deposit-collections.index')
            ->with('success','Collection added successfully');
    }

    /**
     * Show
     */
    public function show(DepositCollection $depositCollection)
    {
        $depositCollection->load(['deposit','branch','user']);

        return view('deposit_collections.show', compact('depositCollection'));
    }

    /**
     * Edit
     */
    public function edit(DepositCollection $depositCollection)
    {
        $deposits = Deposit::all();
        $branches = Branch::all();

        return view('deposit_collections.edit', compact('depositCollection','deposits','branches'));
    }

    /**
     * Update
     */
    public function update(Request $request, DepositCollection $depositCollection)
    {
        $request->validate([
            'collection_amount' => 'required|numeric|min:1',
            'collection_date' => 'required|date',
            'payment_method' => 'required',
        ]);

        $oldAmount = $depositCollection->collection_amount;
        $newAmount = $request->collection_amount;

        $deposit = $depositCollection->deposit;

        // Reverse old amount
        $deposit->paid_amount -= $oldAmount;

        // Apply new amount
        $deposit->paid_amount += $newAmount;

        $deposit->due_amount = $deposit->total_amount - $deposit->paid_amount;

        if ($deposit->due_amount <= 0) {
            $deposit->status = 'completed';
            $deposit->due_amount = 0;
        } else {
            $deposit->status = 'running';
        }

        $deposit->save();

        // Update collection
        $depositCollection->update([
            'collection_amount' => $newAmount,
            'collection_date' => $request->collection_date,
            'payment_method' => $request->payment_method,
            'remark' => $request->remark,
        ]);

        return redirect()->route('deposit-collections.index')
            ->with('success','Collection updated successfully');
    }

    /**
     * Delete
     */
    public function destroy(DepositCollection $depositCollection)
    {
        $deposit = $depositCollection->deposit;

        // Reverse amount before delete
        $deposit->paid_amount -= $depositCollection->collection_amount;
        $deposit->due_amount = $deposit->total_amount - $deposit->paid_amount;

        if ($deposit->due_amount > 0) {
            $deposit->status = 'running';
        }

        $deposit->save();

        $depositCollection->delete();

        return redirect()->route('deposit-collections.index')
            ->with('success','Collection deleted successfully');
    }
}