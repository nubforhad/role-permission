<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\LoanSection;
use App\Models\LoanCollection;

class LoanHistoryController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('member_code')->get();

        return view('loan-history.index', compact('members'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'member_code' => 'required'
        ]);

        $members = Member::orderBy('member_code')->get();

        $member = Member::where('member_code',$request->member_code)->first();

        $loan = LoanSection::where('member_code',$request->member_code)->first();

        $collections = LoanCollection::where('member_code',$request->member_code)
                        ->latest()
                        ->get();

        $totalLoan = LoanSection::where('member_code',$request->member_code)
                        ->sum('total_amount');

        $totalPaid = LoanCollection::where('member_code',$request->member_code)
                        ->sum('paid_amount');

        $due = $totalLoan - $totalPaid;

        return view('loan-history.index',compact(
            'members',
            'member',
            'loan',
            'collections',
            'totalLoan',
            'totalPaid',
            'due'
        ));
    }
}