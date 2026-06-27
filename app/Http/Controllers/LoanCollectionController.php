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
        'loan_section_id'      => 'required|exists:loan_sections,id',
        'member_id'            => 'required|exists:members,id',
        'member_code'          => 'required',
        'installment_amount'   => 'required|numeric',
        'paid_amount'          => 'required|numeric',
        'penalty_charge'       => 'nullable|numeric',
        'installment_date'     => 'nullable|date',
        'paid_date'            => 'nullable|date',
        'expire_date'          => 'nullable|date',
        'status'               => 'required',
        'remark'               => 'nullable'
    ]);

    LoanCollection::create([
        'loan_section_id'     => $request->loan_section_id,
        'user_id'             => auth()->id(),
        'member_id'           => $request->member_id,
        'employee_id'         => auth()->id(),
        'member_code'         => $request->member_code,
        'installment_amount'  => $request->installment_amount,
        'paid_amount'         => $request->paid_amount,
        'penalty_charge'      => $request->penalty_charge,
        'installment_date'    => $request->installment_date,
        'paid_date'           => $request->paid_date,
        'expire_date'         => $request->expire_date,
        'status'              => $request->status,
        'remark'              => $request->remark,
    ]);

    return redirect()
        ->route('loan-collections.index')
        ->with('success','Loan Collection Added Successfully.');
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
        $loanCollection = LoanCollection::with(['loan', 'member', 'employee'])
            ->findOrFail($id);

        return view('loan_collections.show', compact('loanCollection'));
    }


public function downloadPdf(LoanCollection $loanCollection)
{
    $loanCollection->load([
        'member',
        'employee',
        'loanSection'
    ]);

    $pdf = Pdf::loadView('loan_collections.pdf', compact('loanCollection'))
              ->setPaper('A4', 'portrait');

    return $pdf->download('Loan-Collection-'.$loanCollection->id.'.pdf');
}
 

}