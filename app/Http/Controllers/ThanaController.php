<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thana;
use App\Models\District;

class ThanaController extends Controller
{
    public function index()
    {
        $thanas = Thana::with('district')->latest()->paginate(10);

        return view('thana.index', compact('thanas'));
    }

    public function create()
    {
        $districts = District::all();

        return view('thana.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name'        => 'required|max:255',
            'title'       => 'nullable|max:255',
        ]);

        Thana::create([
            'district_id' => $request->district_id,
            'name'        => $request->name,
            'title'       => $request->title,
        ]);

        return redirect()->route('thanas.index')
            ->with('success', 'Thana created successfully.');
    }

    public function show(Thana $thana)
    {
        $thana->load('district');

        return view('thana.show', compact('thana'));
    }

    public function edit(Thana $thana)
    {
        $districts = District::all();

        return view('thana.edit', compact('thana', 'districts'));
    }

    public function update(Request $request, Thana $thana)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name'        => 'required|max:255',
            'title'       => 'nullable|max:255',
        ]);

        $thana->update([
            'district_id' => $request->district_id,
            'name'        => $request->name,
            'title'       => $request->title,
        ]);

        return redirect()->route('thanas.index')
            ->with('success', 'Thana updated successfully.');
    }

    public function destroy(Thana $thana)
    {
        $thana->delete();

        return redirect()->route('thanas.index')
            ->with('success', 'Thana deleted successfully.');
    }
}