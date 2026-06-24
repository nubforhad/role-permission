<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with(['user', 'branch'])
            ->latest()
            ->paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();

        return view('members.create', compact('users', 'branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'branch_id' => 'nullable|exists:branches,id',
            'member_code' => 'nullable|unique:members,member_code',
            'email' => 'nullable|email',
            'mobile_number' => 'nullable|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'signature' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document_file' => 'nullable|file|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')
                ->store('members/photo', 'public');
        }

        if ($request->hasFile('signature')) {
            $data['signature'] = $request->file('signature')
                ->store('members/signature', 'public');
        }

        if ($request->hasFile('document_file')) {
            $data['document_file'] = $request->file('document_file')
                ->store('members/document', 'public');
        }

        $lastMember = Member::latest('id')->first();

        $data['member_code'] = $lastMember
            ? str_pad($lastMember->member_code + 1, 8, '0', STR_PAD_LEFT)
            : '10000001';

        Member::create($data);

        return redirect()
            ->route('members.index')
            ->with('success', 'Member created successfully.');
    }

    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $users = User::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();

        return view('members.edit', compact(
            'member',
            'users',
            'branches'
        ));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'branch_id' => 'nullable|exists:branches,id',
            'member_code' => 'nullable|unique:members,member_code,' . $member->id,
            'email' => 'nullable|email',
            'mobile_number' => 'nullable|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'signature' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document_file' => 'nullable|file|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')
                ->store('members/photo', 'public');
        }

        if ($request->hasFile('signature')) {
            $data['signature'] = $request->file('signature')
                ->store('members/signature', 'public');
        }

        if ($request->hasFile('document_file')) {
            $data['document_file'] = $request->file('document_file')
                ->store('members/document', 'public');
        }

        $member->update($data);

        return redirect()
            ->route('members.index')
            ->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()
            ->route('members.index')
            ->with('success', 'Member deleted successfully.');
    }
}