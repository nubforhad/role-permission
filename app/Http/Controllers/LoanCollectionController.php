<?php

namespace App\Http\Controllers;

use App\Models\LoanCollection;
use App\Models\LoanSection;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanCollectionController extends Controller
{
    /**
     * Show create form
     */
    public function create()
    {
        $loans = LoanSection::with('user')->get();
        $members = Member::all();

        return view('loan_collections.create', compact('loans', 'members'));
    }

    /**
     * Store installment collection
     */
    public function store(Request $request)
    {
        $request->validate([
            'loan_section_id'   => 'required|exists:loan_sections,id',
            'member_id'         => 'required|exists:members,id',
            'member_code'       => 'required',
            'installment_amount'=> 'required|numeric|min:0',
            'paid_amount'       => 'required|numeric|min:0',
            'penalty_charge'    => 'nullable|numeric|min:0',
            'paid_date'         => 'nullable|date',
        ]);

        $loan = LoanSection::findOrFail($request->loan_section_id);

        // Create collection
        $collection = LoanCollection::create([
            'loan_section_id'    => $loan->id,
            'user_id'            => auth()->id(),
            'member_id'          => $request->member_id,
            'employee_id'        => auth()->id(),
            'member_code'        => $request->member_code,
            'installment_amount' => $request->installment_amount,
            'paid_amount'        => $request->paid_amount,
            'penalty_charge'     => $request->penalty_charge ?? 0,
            'installment_date'   => now(),
            'paid_date'          => $request->paid_date,
        ]);

        // Auto status update
        $this->updateStatus($collection);

        return redirect()->back()->with('success', 'Installment collected successfully!');
    }

    /**
     * Update installment status
     */
    private function updateStatus(LoanCollection $collection)
    {
        $total = $collection->installment_amount + $collection->penalty_charge;

        if ($collection->paid_amount >= $total) {
            $collection->status = 'paid';
        } elseif ($collection->paid_amount > 0) {
            $collection->status = 'partial';
        } else {
            $collection->status = 'pending';
        }

        // Overdue check
        if ($collection->expire_date && now()->gt($collection->expire_date) && $collection->status != 'paid') {
            $collection->status = 'late';
        }

        $collection->save();
    }

    /**
     * List view
     */
    public function index()
    {
        $collections = LoanCollection::with(['loan', 'member', 'employee'])
            ->latest()
            ->paginate(20);

        return view('loan_collections.index', compact('collections'));
    }

    /**
     * Show single record
     */
    public function show($id)
    {
        $collection = LoanCollection::with(['loan', 'member', 'employee'])
            ->findOrFail($id);

        return view('loan_collections.show', compact('collection'));
    }
}