<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Log;

class LeaveController extends Controller
{

public function index()
{
    // get employee record for the logged-in user
    $employee = Employee::where('user_id', Auth::id())->first();

    // fetch leave history for this employee
    $leaves = Leave::where('emp_id', $employee->emp_id)->latest()->get();

    // total allowed leaves per type
    $totalLeaves = [
        'Casual Leave' => 10,
        'Sick Leave'   => 8,
        'Paid Leave'   => 12,
    ];

    // sum approved leave days by leave_type (use total_days column)
    $usedLeaves = Leave::where('emp_id', $employee->emp_id)
        ->whereRaw('LOWER(status) = "approved"')   // case-insensitive match
        ->get()
        ->groupBy('leave_type')
        ->map(function ($group) {
            return $group->sum('total_days');      // sum days, not count rows
        });

    // calculate remaining
    $remainingLeaves = [];
    foreach ($totalLeaves as $type => $limit) {
        $used = $usedLeaves[$type] ?? 0;
        $remainingLeaves[$type] = $limit - $used;
    }

    return view('employee.leave', compact('leaves', 'remainingLeaves', 'totalLeaves'));
}



   // Employee: Apply Leave
    public function create()
    {
        return view('employee.leave');
    }



    public function store(Request $request)
{
       // Step 1: Custom validation messages
    $messages = [
        'start_date.after_or_equal' => 'Start date cannot be in the past.',
        'end_date.after_or_equal' => 'End date must be after the start date.',
    ];

    // Step 2: Validate user input
    $request->validate([
        'leave_type' => 'required|string|max:50',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date'   => 'required|date|after_or_equal:start_date',
        'reason'     => 'nullable|string|max:255',
    ], $messages);

    // Step 3: Get employee record
    $employee = Employee::where('user_id', Auth::id())->first();

    // Step 4: Define total allowed leaves
    $totalLeaves = [
        'Casual Leave' => 10,
        'Sick Leave'   => 8,
        'Paid Leave'   => 12,
    ];

    // Step 5: Calculate total used leaves (Approved only)
    $usedLeaves = Leave::where('emp_id', $employee->emp_id)
        ->where(function ($query) {
            $query->whereRaw('LOWER(TRIM(status)) = ?', ['approved']);
        })
        ->get()
        ->groupBy('leave_type')
        ->map(function ($group) {
            return $group->sum('total_days') ?? 0;
        });

    // Step 6: Determine remaining leaves
    $leaveType = $request->leave_type;
    $remaining = ($totalLeaves[$leaveType] ?? 0) - ($usedLeaves[$leaveType] ?? 0);

    // Step 7: Block if no remaining leaves
    if ($remaining <= 0) {
        return redirect()->route('employee.leave')
    ->withErrors(['error' => "You have no remaining $leaveType available."])
    ->withInput();
    }

    // Step 8: Calculate total working days (excluding Sundays)
    $startDate = Carbon::parse($request->start_date);
    $endDate   = Carbon::parse($request->end_date);
    $period    = CarbonPeriod::create($startDate, $endDate);

    $workingDays = 0;
    foreach ($period as $date) {
        if ($date->isSunday()) continue; // Skip Sundays
        $workingDays++;
    }

    // Step 9: Check if requested days exceed remaining balance
 
    
    if ($workingDays > $remaining) {
        Log::info('Error Message Triggered:', ['type' => $leaveType, 'remaining' => $remaining]); 
        return redirect()->route('employee.leave')
    ->withErrors(['error' => "You only have $remaining $leaveType remaining, but you requested $workingDays days."])
    ->withInput(); 
    }

//Step 1: Get current logged-in employee
$userId = Auth::id();
$employee = Employee::where('user_id', $userId)->first();

// Step 2: Check if there's already a pending leave for same type
$existingLeave = Leave::where('emp_id', $employee->id)
    ->where('leave_type', $request->leave_type)
    ->where('status', 'Pending')
    ->first();

if ($existingLeave) {
    return redirect()->back()->with('error', 'You already have a pending leave request for this type.');
} 






    // Step 10: Store the leave request
    Leave::create([
        'emp_id'      => $employee->emp_id,
        'leave_type'  => $request->leave_type,
        'start_date'  => $request->start_date,
        'end_date'    => $request->end_date,
        'reason'      => $request->reason,
        'status'      => 'Pending',
        'total_days'  => $workingDays,
    ]);

    // Step 11: Redirect with success message
    return redirect()->route('employee.leave')
        ->with('success', "Leave request submitted successfully for $workingDays days!");
} 


    // Admin: View All Leaves
   public function adminIndex(Request $request)
{
    $status = $request->query('status'); // e.g., Pending / Approved / Rejected

    $query = Leave::with('employee')->latest();

    if ($status && in_array($status, ['Pending', 'Approved', 'Rejected'])) {
        $query->where('status', $status);
    }

    $leaves = $query->paginate(10);

    return view('admin.leaves.index', compact('leaves', 'status'));
} 

    // Admin: Approve / Reject
    public function updateStatus(Request $request, $id)
{
    
    $leave = Leave::findOrFail($id);

    $leave->update([
        'status' => $request->status,
        'remark' => $request->remark,
    ]);

    return back()->with('success', 'Leave ' . strtolower($request->status) . ' successfully!');
} 

public function bulkUpdate(Request $request)
{
    $action = $request->input('action'); // Approve or Reject
    $status = $action == 'Approve' ? 'Approved' : 'Rejected';

    Leave::where('status', 'Pending')->update(['status' => $status]);

    return back()->with('success', "All pending leaves have been {$status}!");
} 



public function approveAll()
{
    Leave::where('status', 'Pending')->update(['status' => 'Approved']);
    return redirect()->back()->with('success', 'All pending leave requests approved successfully!');
}

public function rejectAll()
{
    Leave::where('status', 'Pending')->update(['status' => 'Rejected']);
    return redirect()->back()->with('success', 'All pending leave requests rejected successfully!');
} 




} 
