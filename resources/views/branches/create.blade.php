@extends('layouts.app')

@section('content')

<div class="page-wrapper">
<div class="page-content">

<div class="card p-4 shadow-sm">

<form method="GET" action="{{ route('branches.create') }}">

    <!-- District -->
    <div class="mb-3">
        <label>District</label>

        <select name="district_id" class="form-control" onchange="this.form.submit()">

            <option value="">Select District</option>

            @foreach($districts as $district)
                <option value="{{ $district->id }}"
                    {{ request('district_id') == $district->id ? 'selected' : '' }}>
                    {{ $district->name }}
                </option>
            @endforeach

        </select>
    </div>

</form>

<form method="POST" action="{{ route('branches.store') }}">
@csrf

<!-- hidden district -->
<input type="hidden" name="district_id" value="{{ request('district_id') }}">

<!-- Thana -->
<div class="mb-3">
    <label>Thana</label>

    <select name="thana_id" class="form-control">

        <option value="">Select Thana</option>

        @foreach($thanas as $thana)
            <option value="{{ $thana->id }}">
                {{ $thana->name }}
            </option>
        @endforeach

    </select>
</div>

<!-- Branch Name -->
<input type="text" name="name" class="form-control mb-2" placeholder="Branch Name">

<!-- Address -->
<input type="text" name="address" class="form-control mb-2" placeholder="Address">

<!-- Title -->
<input type="text" name="title" class="form-control mb-2" placeholder="Title">

<button class="btn btn-success">Save Branch</button>

</form>

</div>

</div>
</div>

@endsection