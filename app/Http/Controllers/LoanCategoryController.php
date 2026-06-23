<?php

namespace App\Http\Controllers;

use App\Models\LoanCategory;
use Illuminate\Http\Request;

class LoanCategoryController extends Controller
{
    public function index()
    {
        $categories = LoanCategory::latest()->paginate(10);

        return view('loanCategories.index', compact('categories'));
    }

    public function create()
    {
        return view('loanCategories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255|unique:loan_categories,name',
            'title'   => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        LoanCategory::create($request->all());

        return redirect()
            ->route('loan-categories.index')
            ->with('success', 'Loan category created successfully.');
    }

    public function show(LoanCategory $loanCategory)
    {
        return view('loanCategories.show', compact('loanCategory'));
    }

    public function edit(LoanCategory $loanCategory)
    {
        return view('loanCategories.edit', compact('loanCategory'));
    }

    public function update(Request $request, LoanCategory $loanCategory)
    {
        $request->validate([
            'name'    => 'required|string|max:255|unique:loan_categories,name,' . $loanCategory->id,
            'title'   => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        $loanCategory->update($request->all());

        return redirect()
            ->route('loan-categories.index')
            ->with('success', 'Loan category updated successfully.');
    }

    public function destroy(LoanCategory $loanCategory)
    {
        $loanCategory->delete();

        return redirect()
            ->route('loan-categories.index')
            ->with('success', 'Loan category deleted successfully.');
    }
}