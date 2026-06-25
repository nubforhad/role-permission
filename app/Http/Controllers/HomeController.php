<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\Branch;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUser = User::count();
        $totalBranch = Branch::count();
        $totalMember = Member::count();

        return view('home', compact('totalUser','totalMember','totalBranch'));
    }
}
