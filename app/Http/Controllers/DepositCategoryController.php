<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepositCategory;
use App\Models\InstallmentType;

class DepositCategoryController extends Controller
{
    public function index()
    {
        $categories = DepositCategory::with('installmentType')
            ->latest()
            ->get();

        return view('deposit_categories.index', compact('categories'));
    }

    public function create()
    {
        $installmentTypes = InstallmentType::all();

        return view('deposit_categories.create', compact('installmentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:deposit_categories,code',
            'interest_rate' => 'required|numeric',
            'deposit_type' => 'required',
            'duration' => 'required',
            'duration_type' => 'required',
            'minimum_amount' => 'required|numeric',
            'maximum_amount' => 'required|numeric',
        ]);

        DepositCategory::create([
            'user_id' => auth()->id(),
            'installment_type_id' => $request->installment_type_id,
            'name' => $request->name,
            'code' => $request->code,
            'interest_rate' => $request->interest_rate,
            'deposit_type' => $request->deposit_type,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'minimum_amount' => $request->minimum_amount,
            'maximum_amount' => $request->maximum_amount,
            'status' => $request->status ?? 1,
            'description' => $request->description,
        ]);

        return redirect()->route('deposit-categories.index')
            ->with('success', 'Deposit Category created successfully');
    }

    public function show(DepositCategory $depositCategory)
    {
        $depositCategory->load('deposits', 'installmentType', 'user');

        return view('deposit_categories.show', compact('depositCategory'));
    }

    public function edit(DepositCategory $depositCategory)
    {
        $installmentTypes = InstallmentType::all();

        return view('deposit_categories.edit', compact('depositCategory', 'installmentTypes'));
    }

    public function update(Request $request, DepositCategory $depositCategory)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:deposit_categories,code,' . $depositCategory->id,
            'interest_rate' => 'required|numeric',
            'deposit_type' => 'required',
            'duration' => 'required',
            'duration_type' => 'required',
            'minimum_amount' => 'required|numeric',
            'maximum_amount' => 'required|numeric',
        ]);

        $depositCategory->update([
            'installment_type_id' => $request->installment_type_id,
            'name' => $request->name,
            'code' => $request->code,
            'interest_rate' => $request->interest_rate,
            'deposit_type' => $request->deposit_type,
            'duration' => $request->duration,
            'duration_type' => $request->duration_type,
            'minimum_amount' => $request->minimum_amount,
            'maximum_amount' => $request->maximum_amount,
            'status' => $request->status ?? 1,
            'description' => $request->description,
        ]);

        return redirect()->route('deposit-categories.index')
            ->with('success', 'Deposit Category updated successfully');
    }

    public function destroy(DepositCategory $depositCategory)
    {
        $depositCategory->delete();

        return redirect()->route('deposit-categories.index')
            ->with('success', 'Deposit Category deleted successfully');
    }
}