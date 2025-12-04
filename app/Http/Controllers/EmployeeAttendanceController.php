<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmployeeAttendanceController extends Controller
{
    // Show attendance page (mark + history)

    public function index()
{
    $userId = Auth::id();
    $employee = Employee::where('user_id', $userId)->first();

    if (!$employee) {
        return redirect()->back()->with('error', 'Employee record not found.');
    }

    // Current date
    $today = Carbon::today()->toDateString();


    // Fetch today's attendance using emp_id (not id)
   $todayAttendance = Attendance::where('emp_id', $employee->emp_id)
    ->whereDate('date', Carbon::today()->toDateString())
    ->whereNotNull('check_in')
    ->first(); 


    if ($todayAttendance && $todayAttendance->status == 'absent') {
    $todayAttendance = null; // treat absent as no check-in
} 

    //  Fetch this month's records
    $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
    $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

    $attendances = Attendance::where('emp_id', $employee->emp_id)
        ->whereBetween('date', [$startOfMonth, $endOfMonth])
        ->orderBy('date', 'desc')
        ->get();

    //  Counts
    $presentCount = Attendance::where('emp_id', $employee->emp_id)
        ->where('status', 'present')
        ->count();

    $absentCount = Attendance::where('emp_id', $employee->emp_id)
        ->where('status', 'absent')
        ->count();

    return view('employee.attendance', compact(
        'employee',
        'todayAttendance',
        'attendances',
        'presentCount',
        'absentCount'
    ));
}

public function checkIn(Request $request)
{
    $userId = auth()->user()->id;

    // Find employee record
    $employee = Employee::where('user_id', $userId)->first();

    if (!$employee) {
        return back()->with('error', 'Employee record not found.');
    }

    $today = Carbon::today()->toDateString();

    // Check if attendance exists for this employee today
    $attendance = Attendance::where('emp_id', $employee->emp_id)
        ->whereDate('date', $today)
        ->first();

    // Case 1: Attendance already exists and has a check_in
    if ($attendance && $attendance->check_in) {
        return back()->with('error', 'You have already checked in today.');
    }

    // Case 2: Attendance exists but is marked absent -> update it to check in
    if ($attendance && !$attendance->check_in) {
        $attendance->update([
            'check_in' => now(),
            'status' => now()->gt(now()->setTime(9, 30, 0)) ? 'late' : 'present',
        ]);
    }
    // Case 3: No record at all -> create a new one
    else {
        Attendance::create([
            'emp_id'   => $employee->emp_id,
            'date'     => $today,
            'check_in' => now(),
            'status'   => now()->gt(now()->setTime(9, 30, 0)) ? 'late' : 'present',
        ]);
    }

    return back()->with('success', 'You have checked in successfully!');
} 







    public function checkOut()
{
    $today = \Carbon\Carbon::today()->toDateString();
    $userId = auth()->user()->id;

    $employee = Employee::where('user_id', $userId)->first();

    if (!$employee) {
        return back()->with('error', 'No employee record found for this user.');
    }

    $attendance = Attendance::where('emp_id', $employee->emp_id)
        ->whereDate('date', $today)
        ->first();

    if (!$attendance) {
        return back()->with('error', 'You have not checked in yet.');
    }

    if ($attendance->check_out) {
        return back()->with('error', 'You have already checked out today.');
    }

    $attendance->update([
        'check_out' => now(),
    ]);

    return back()->with('success', 'You have checked out successfully!');
} 
    
}
