<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nominee;
use App\Models\Member;

class NomineeController extends Controller
{
    public function index()
    {
        $nominees = Nominee::with('member')
            ->latest()
            ->paginate(20);

        return view('nominees.index', compact('nominees'));
    }

    public function create()
    {
        $members = Member::orderBy('member_code')->get();

        return view('nominees.create', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'nominee_name' => 'required|string|max:255',
            'mobile_number' => 'nullable|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'signature' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document_file' => 'nullable|file|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')
                ->store('nominees/photo', 'public');
        }

        if ($request->hasFile('signature')) {
            $data['signature'] = $request->file('signature')
                ->store('nominees/signature', 'public');
        }

        if ($request->hasFile('document_file')) {
            $data['document_file'] = $request->file('document_file')
                ->store('nominees/document', 'public');
        }

        Nominee::create($data);

        return redirect()
            ->route('nominees.index')
            ->with('success', 'Nominee created successfully.');
    }

    public function show(Nominee $nominee)
    {
        return view('nominees.show', compact('nominee'));
    }

    public function edit(Nominee $nominee)
    {
        $members = Member::orderBy('member_code')->get();

        return view('nominees.edit', compact('nominee', 'members'));
    }

    public function update(Request $request, Nominee $nominee)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'nominee_name' => 'required|string|max:255',
            'mobile_number' => 'nullable|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'signature' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document_file' => 'nullable|file|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')
                ->store('nominees/photo', 'public');
        }

        if ($request->hasFile('signature')) {
            $data['signature'] = $request->file('signature')
                ->store('nominees/signature', 'public');
        }

        if ($request->hasFile('document_file')) {
            $data['document_file'] = $request->file('document_file')
                ->store('nominees/document', 'public');
        }

        $nominee->update($data);

        return redirect()
            ->route('nominees.index')
            ->with('success', 'Nominee updated successfully.');
    }

    public function destroy(Nominee $nominee)
    {
        $nominee->delete();

        return redirect()
            ->route('nominees.index')
            ->with('success', 'Nominee deleted successfully.');
    }
}