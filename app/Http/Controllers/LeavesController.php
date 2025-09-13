<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeavesController extends Controller
{
    /**
     * Display a list of all leave applications.
     */
    public function index()
    {
        $leaves = Leave::latest()->get();
        return view('leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new leave application.
     */
    public function create()
    {
        return view('leaves.create');
    }

    /**
     * Store a newly created leave application.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Applicant details
            'full_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',

            // Leave info
            'leave_type' => 'required|string|max:100',
            'reason' => 'nullable|string',

            // Leave details
            'date_last_leave' => 'nullable|date',
            'days_entitled' => 'nullable|integer|min:0',
            'days_applied_for' => 'nullable|integer|min:0',
            'days_already_utilized' => 'nullable|integer|min:0',
            'date_commencement' => 'required|date',
            'date_resumption' => 'required|date|after_or_equal:date_commencement',
            'date_of_application' => 'nullable|date',

            // Signatures
            'signature' => 'nullable|string',
            'administrator_name' => 'nullable|string|max:255',
            'administrator_signature' => 'nullable|string',
            'administrator_date' => 'nullable|date',
            'zonal_coordinator_name' => 'nullable|string|max:255',
            'zonal_coordinator_signature' => 'nullable|string',
            'zonal_coordinator_date' => 'nullable|date',

            // Status
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        // Default status if not provided
        $validated['status'] = $validated['status'] ?? 'pending';

        Leave::create($validated);

        return redirect()
            ->route('leaves.index')
            ->with('success', 'Leave request submitted successfully!');
    }

    /**
     * Display a single leave application.
     */
    public function show(Leave $leave)
    {
        return view('leaves.show', compact('leave'));
    }

    /**
     * Show the form for editing a leave application.
     */
    public function edit(Leave $leave)
    {
        return view('leaves.edit', compact('leave'));
    }

    /**
     * Update a leave application.
     */
    public function update(Request $request, Leave $leave)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'leave_type' => 'required|string|max:100',
            'reason' => 'nullable|string',
            'date_last_leave' => 'nullable|date',
            'days_entitled' => 'nullable|integer|min:0',
            'days_applied_for' => 'nullable|integer|min:0',
            'days_already_utilized' => 'nullable|integer|min:0',
            'date_commencement' => 'required|date',
            'date_resumption' => 'required|date|after_or_equal:date_commencement',
            'date_of_application' => 'nullable|date',
            'signature' => 'nullable|string',
            'administrator_name' => 'nullable|string|max:255',
            'administrator_signature' => 'nullable|string',
            'administrator_date' => 'nullable|date',
            'zonal_coordinator_name' => 'nullable|string|max:255',
            'zonal_coordinator_signature' => 'nullable|string',
            'zonal_coordinator_date' => 'nullable|date',
            'status' => 'nullable|in:draft,pending,approved,rejected',
        ]);

        $leave->update($validated);

        return redirect()
            ->route('leaves.index')
            ->with('success', 'Leave request updated successfully!');
    }

    /**
     * Remove a leave application.
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();

        return redirect()
            ->route('leaves.index')
            ->with('success', 'Leave request deleted successfully!');
    }

    /**
     * Approve a leave (for Admin/Coordinator use).
     */
    public function approve(Leave $leave)
    {
        $leave->update(['status' => 'approved']);

        return back()->with('success', 'Leave approved successfully.');
    }

    /**
     * Reject a leave (for Admin/Coordinator use).
     */
    public function reject(Leave $leave)
    {
        $leave->update(['status' => 'rejected']);

        return back()->with('success', 'Leave rejected successfully.');
    }
}
