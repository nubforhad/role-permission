<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\District;
use App\Models\Thana;

class BranchController extends Controller
{
    // INDEX
    public function index()
    {
        $branches = Branch::with(['district', 'thana'])
                        ->latest()
                        ->paginate(10);

        return view('branches.index', compact('branches'));
    }

    // CREATE
    public function create(Request $request)
    {
        $districts = District::all();

        $thanas = [];

        if ($request->district_id) {
            $thanas = Thana::where('district_id', $request->district_id)->get();
        }

        return view('branches.create', compact('districts', 'thanas'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required',
            'thana_id'    => 'required',
            'name'        => 'required|max:255',
            'address'     => 'nullable|max:255',
            'title'       => 'nullable|max:255',
        ]);

        Branch::create([
            'district_id' => $request->district_id,
            'thana_id'    => $request->thana_id,
            'name'        => $request->name,
            'address'     => $request->address,
            'title'       => $request->title,
        ]);

        return redirect()->route('branches.index')
            ->with('success', 'Branch created successfully.');
    }

    // SHOW
    public function show(Branch $branch)
    {
        $branch->load(['district', 'thana']);

        return view('branches.show', compact('branch'));
    }

    // EDIT
    public function edit(Request $request, Branch $branch)
    {
        $districts = District::all();

        $thanas = Thana::where('district_id', $branch->district_id)->get();

        return view('branches.edit', compact('branch', 'districts', 'thanas'));
    }

    // UPDATE
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'district_id' => 'required',
            'thana_id'    => 'required',
            'name'        => 'required|max:255',
            'address'     => 'nullable|max:255',
            'title'       => 'nullable|max:255',
        ]);

        $branch->update([
            'district_id' => $request->district_id,
            'thana_id'    => $request->thana_id,
            'name'        => $request->name,
            'address'     => $request->address,
            'title'       => $request->title,
        ]);

        return redirect()->route('branches.index')
            ->with('success', 'Branch updated successfully.');
    }

    // DELETE
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()->route('branches.index')
            ->with('success', 'Branch deleted successfully.');
    }
}