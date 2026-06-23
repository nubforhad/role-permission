<?php

namespace App\Http\Controllers;

use App\Models\InstallmentType;
use Illuminate\Http\Request;

class InstallmentTypeController extends Controller
{
    public function index()
    {
        $installments = InstallmentType::latest()->paginate(10);

        return view('installmentTypes.index', compact('installments'));
    }

    public function create()
    {
        return view('installmentTypes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name'  => 'required|string|max:255',
            'duration'   => 'required|integer',
            'ins_code'   => 'required|string|unique:installment_types,ins_code',
        ]);

        InstallmentType::create($request->all());

        return redirect()
            ->route('installment-types.index')
            ->with('success', 'Installment Type created successfully.');
    }

    public function show(InstallmentType $installmentType)
    {
        return view('installmentTypes.show', compact('installmentType'));
    }

    public function edit(InstallmentType $installmentType)
    {
        return view('installmentTypes.edit', compact('installmentType'));
    }

    public function update(Request $request, InstallmentType $installmentType)
    {
        $request->validate([
            'type_name'  => 'required|string|max:255',
            'duration'   => 'required|integer',
            'ins_code'   => 'required|string|unique:installment_types,ins_code,' . $installmentType->id,
        ]);

        $installmentType->update($request->all());

        return redirect()
            ->route('installment-types.index')
            ->with('success', 'Installment Type updated successfully.');
    }

    public function destroy(InstallmentType $installmentType)
    {
        $installmentType->delete();

        return redirect()
            ->route('installment-types.index')
            ->with('success', 'Installment Type deleted successfully.');
    }
}