<?php

namespace App\Http\Controllers;

use App\Models\LoanCollection;
use App\Models\LoanSection;
use App\Models\Member;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class LoanCollectionController extends Controller
{
    /**
     * Show create form
     */
    public function create()
    {
        // 'member' eager load করা হলো, কারণ blade তে $loan->member ব্যবহার হচ্ছে
        // (আগে 'user' eager load করা ছিল, যা এই view তে আদৌ লাগছিল না)
        $loans   = LoanSection::with('member')->get();
        $members = Member::all();

        // JS এর জন্য Loan এর তথ্য আগে থেকেই flat array বানিয়ে রাখা হলো,
        // যাতে blade ফাইলের ভেতর @json() এর মধ্যে multi-line closure/array
        // লেখার দরকার না পড়ে (এটা কিছু editor/linter কে বিভ্রান্ত করে এবং
        // মেইনটেইন করাও কঠিন হয়ে যায়)
        $loanData = $loans->map(function ($loan) {
            return [
                'id'          => $loan->id,
                'member_id'   => $loan->member_id,
                'installment' => $loan->paid_per_installment,
                'label'       => 'Loan #' . $loan->id . ' (' . number_format($loan->loan_amount, 2) . ')',
            ];
        })->values();

        return view('loan_collections.create', compact('loans', 'members', 'loanData'));
    }

    /**
     * Store installment collection
     */
    public function store(Request $request)
    {
        $request->validate([
            'loan_section_id'    => 'required|exists:loan_sections,id',
            'member_id'          => 'required|exists:members,id',
            'member_code'        => 'required',
            'installment_amount' => 'required|numeric',
            'paid_amount'        => 'required|numeric',
            'penalty_charge'     => 'nullable|numeric',
            'installment_date'   => 'nullable|date',
            'paid_date'          => 'nullable|date',
            'expire_date'        => 'nullable|date',
            'status'             => 'required',
            'remark'             => 'nullable',
        ]);

        // সিকিউরিটি চেক: ফর্মে যে Loan সিলেক্ট হয়েছে সেটা যেন আসলেই
        // সিলেক্ট করা Member এর Loan হয় (UI থেকে filter করা হলেও, server side এ
        // confirm না করলে কেউ inspect element করে অন্য member এর loan id পাঠাতে পারবে)
        $loan = LoanSection::find($request->loan_section_id);

        if (! $loan || $loan->member_id != $request->member_id) {
            return back()
                ->withInput()
                ->withErrors(['loan_section_id' => 'এই Loan টি সিলেক্ট করা Member এর নয়।']);
        }

        LoanCollection::create([
            'loan_section_id'    => $request->loan_section_id,
            'user_id'            => auth()->id(),
            'member_id'          => $request->member_id,
            'employee_id'        => auth()->id(),
            'member_code'        => $request->member_code,
            'installment_amount' => $request->installment_amount,
            'paid_amount'        => $request->paid_amount,
            'penalty_charge'     => $request->penalty_charge,
            'installment_date'   => $request->installment_date,
            'paid_date'          => $request->paid_date,
            'expire_date'        => $request->expire_date,
            'status'             => $request->status,
            'remark'             => $request->remark,
        ]);

        return redirect()
            ->route('loan-collections.index')
            ->with('success', 'Loan Collection Added Successfully.');
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
    public function show(LoanCollection $loanCollection)
    {
        $loanCollection->load([
            'member',
            'employee',
            'loanSection',
        ]);

        // Total Loan Amount
        $totalLoanAmount = $loanCollection->loanSection->total_amount;

        // Total Paid Amount for this Loan
        $totalPaidAmount = LoanCollection::where('loan_section_id', $loanCollection->loan_section_id)
            ->sum('paid_amount');

        // Total Due
        $totalDue = $totalLoanAmount - $totalPaidAmount;

        return view('loan_collections.show', compact(
            'loanCollection',
            'totalLoanAmount',
            'totalPaidAmount',
            'totalDue'
        ));
    }

    public function downloadPdf(LoanCollection $loanCollection)
    {
        $loanCollection->load([
            'member',
            'employee',
            'loanSection',
        ]);

        $pdf = Pdf::loadView('loan_collections.pdf', compact('loanCollection'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download('Loan-Collection-' . $loanCollection->id . '.pdf');
    }
}