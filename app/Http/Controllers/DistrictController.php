<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::latest()->paginate(10);

        return view('districts.index', compact('districts'));
    }

    public function create()
    {
        return view('districts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'title' => 'nullable|max:255',
        ]);

        District::create([
            'name'  => $request->name,
            'title' => $request->title,
        ]);

        return redirect()->route('districts.index')
            ->with('success', 'District created successfully.');
    }

    public function show(District $district)
    {
        return view('districts.show', compact('district'));
    }

    public function edit(District $district)
    {
        return view('districts.edit', compact('district'));
    }

    public function update(Request $request, District $district)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'title' => 'nullable|max:255',
        ]);

        $district->update([
            'name'  => $request->name,
            'title' => $request->title,
        ]);

        return redirect()->route('districts.index')
            ->with('success', 'District updated successfully.');
    }

    public function destroy(District $district)
    {
        $district->delete();

        return redirect()->route('districts.index')
            ->with('success', 'District deleted successfully.');
    }
}