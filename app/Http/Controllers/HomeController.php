<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\Branch;
use App\Models\LoanSection;
use App\Models\LoanCollection;


class HomeController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $totalUser = User::count();
        $totalBranch = Branch::count();
        $totalMember = Member::count();

        $totalLoanAmount = LoanSection::sum('loan_amount');
        $totalPaid = LoanCollection::sum('paid_amount');
        $totalAmount = LoanSection::sum('total_amount'); 

        return view('home', compact('totalUser','totalMember','totalBranch', 'totalLoanAmount', 'totalPaid', 'totalAmount'));
    }
}
