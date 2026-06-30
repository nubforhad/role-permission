<?php

namespace App\Http\Controllers;

use App\Models\LoanUpCategory;
use Illuminate\Http\Request;

class LoanUpCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loanUpCategories = LoanUpCategory::latest()->paginate(10);

        return view('loan_up_categories.index', compact('loanUpCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loan_up_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255|unique:loan_up_categories,name',
            'interest_rate'     => 'required|numeric|min:0',
            'interest_type'     => 'required|in:Flat,Reducing',
            'duration'          => 'required|integer|min:1',
            'duration_type'     => 'required|in:Day,Week,Month,Year',
            'installment_type'  => 'required|in:Daily,Weekly,Monthly,Quarterly,Yearly',
            'processing_fee'    => 'nullable|numeric|min:0',
            'late_fee'          => 'nullable|numeric|min:0',
            'minimum_amount'    => 'required|numeric|min:0',
            'maximum_amount'    => 'required|numeric|gte:minimum_amount',
            'status'            => 'required|boolean',
            'description'       => 'nullable|string',
        ]);

        LoanUpCategory::create($validated);

        return redirect()
            ->route('loan-up-categories.index')
            ->with('success', 'Loan Up Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LoanUpCategory $loanUpCategory)
    {
        return view('loan_up_categories.show', compact('loanUpCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanUpCategory $loanUpCategory)
    {
        return view('loan_up_categories.edit', compact('loanUpCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanUpCategory $loanUpCategory)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255|unique:loan_up_categories,name,' . $loanUpCategory->id,
            'interest_rate'     => 'required|numeric|min:0',
            'interest_type'     => 'required|in:Flat,Reducing',
            'duration'          => 'required|integer|min:1',
            'duration_type'     => 'required|in:Day,Week,Month,Year',
            'installment_type'  => 'required|in:Daily,Weekly,Monthly,Quarterly,Yearly',
            'processing_fee'    => 'nullable|numeric|min:0',
            'late_fee'          => 'nullable|numeric|min:0',
            'minimum_amount'    => 'required|numeric|min:0',
            'maximum_amount'    => 'required|numeric|gte:minimum_amount',
            'status'            => 'required|boolean',
            'description'       => 'nullable|string',
        ]);

        $loanUpCategory->update($validated);

        return redirect()
            ->route('loan-up-categories.index')
            ->with('success', 'Loan Up Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanUpCategory $loanUpCategory)
    {
        $loanUpCategory->delete();

        return redirect()
            ->route('loan-up-categories.index')
            ->with('success', 'Loan Up Category deleted successfully.');
    }
}