@extends('layout.master')

@section('title','Edit Memo')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Memo</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('memos.update', $memo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="to" class="form-label">To</label>
            <input type="text" name="to" class="form-control" value="{{ old('to', $memo->to) }}" required>
        </div>

        <div class="mb-3">
            <label for="from" class="form-label">From</label>
            <input type="text" name="from" class="form-control" value="{{ old('from', $memo->from) }}" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $memo->date) }}" required>
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" value="{{ old('subject', $memo->subject) }}" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" class="form-control" rows="4">{{ old('body', $memo->body) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $memo->amount) }}">
        </div>

        <div class="mb-3">
            <label for="currency" class="form-label">Currency</label>
            <input type="text" name="currency" class="form-control" value="{{ old('currency', $memo->currency) }}">
        </div>

        <div class="mb-3">
            <label for="name_of_employee" class="form-label">Name of Employee</label>
            <input type="text" name="name_of_employee" class="form-control" value="{{ old('name_of_employee', $memo->name_of_employee) }}" required>
        </div>

        <!-- <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="draft" {{ old('status', $memo->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="validate" {{ old('status', $memo->status) == 'validate' ? 'selected' : '' }}>Validate</option>
                <option value="authorize" {{ old('status', $memo->status) == 'authorize' ? 'selected' : '' }}>Authorize</option>
                <option value="process" {{ old('status', $memo->status) == 'process' ? 'selected' : '' }}>Process</option>
                <option value="disburse" {{ old('status', $memo->status) == 'disburse' ? 'selected' : '' }}>Disburse</option>
                <option value="credited" {{ old('status', $memo->status) == 'credited' ? 'selected' : '' }}>credited</option>
            </select>
        </div> -->

        <button type="submit" class="btn btn-info">Update Memo</button>
        <a href="{{ route('memos.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection