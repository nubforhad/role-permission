<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\Branch;
use App\Models\LoanSection;
use App\Models\LoanCollection;
use Carbon\Carbon;

class HomeController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth');
    }

 
 

public function index(Request $request)
{
    $totalUser   = User::count();
    $totalBranch = Branch::count();
    $totalMember = Member::count();

    $from = $request->from;
    $to   = $request->to;

    $loanQuery = LoanSection::query();
    $paidQuery = LoanCollection::query();

    if ($request->filter == 'today') {

        $loanQuery->whereDate('created_at', Carbon::today());
        $paidQuery->whereDate('created_at', Carbon::today());

    } elseif ($request->filter == 'yesterday') {

        $loanQuery->whereDate('created_at', Carbon::yesterday());
        $paidQuery->whereDate('created_at', Carbon::yesterday());

    } elseif ($request->filter == 'week') {

        $loanQuery->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);

        $paidQuery->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);

    } elseif ($request->filter == 'month') {

        $loanQuery->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);

        $paidQuery->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);

    } elseif ($request->filter == 'year') {

        $loanQuery->whereYear('created_at', Carbon::now()->year);
        $paidQuery->whereYear('created_at', Carbon::now()->year);

    } elseif ($from && $to) {

        $loanQuery->whereBetween('created_at', [
            Carbon::parse($from)->startOfDay(),
            Carbon::parse($to)->endOfDay()
        ]);

        $paidQuery->whereBetween('created_at', [
            Carbon::parse($from)->startOfDay(),
            Carbon::parse($to)->endOfDay()
        ]);
    }

    $totalLoanAmount = $loanQuery->sum('loan_amount');
    $totalAmount     = $loanQuery->sum('total_amount');
    $totalPaid       = $paidQuery->sum('paid_amount');

    return view('home', compact(
        'totalUser',
        'totalBranch',
        'totalMember',
        'totalLoanAmount',
        'totalAmount',
        'totalPaid'
    ));
}
 
    // public function index()
    // {
    //     $totalUser = User::count();
    //     $totalBranch = Branch::count();
    //     $totalMember = Member::count();

    //     $totalLoanAmount = LoanSection::sum('loan_amount');
    //     $totalPaid = LoanCollection::sum('paid_amount');
    //     $totalAmount = LoanSection::sum('total_amount'); 

    //     return view('home', compact('totalUser','totalMember','totalBranch', 'totalLoanAmount', 'totalPaid', 'totalAmount'));
    // }
}
