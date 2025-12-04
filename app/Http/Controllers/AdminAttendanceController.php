<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AdminAttendanceController extends Controller
{
    // Display attendance records
    public function index(Request $request)
    {
        $today = Carbon::today()->toDateString();

        // Get all employees
        $employees = Employee::all();


// Auto-mark absentees (only once per day)
foreach ($employees as $employee) {

    $empId = $employee->emp_id;

    // Check if an attendance record already exists for today
    $exists = Attendance::where('emp_id', $empId)
        ->whereDate('date', $today)
        ->exists();

    // If a record already exists (present/late/absent), do NOTHING
    if ($exists) {
        continue;
    }

    // Create absent only if no record exists
    Attendance::create([
        'emp_id' => $empId,
        'date'   => $today,
        'status' => 'absent',
    ]);
} 


 

        //  Filter and show attendance records
        $query = Attendance::with('employee');

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        } else {
            $query->whereDate('date', $today);
        }

        if ($request->filled('emp_id')) {
            $query->where('emp_id', $request->emp_id);
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        return view('admin.attendance.index', compact('attendances', 'employees'));
    }




    // Show edit form
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        return view('admin.attendance.edit', compact('attendance', 'employees'));
    }




public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required',
        'check_in' => 'nullable|date_format:H:i',
        'check_out' => 'nullable|date_format:H:i',
    ]);

    $attendance = Attendance::findOrFail($id);
    $attendance->status = $request->status;
    $attendance->check_in = $request->check_in;
    $attendance->check_out = $request->check_out;

    
    $attendance->save();

    return redirect()->route('admin.attendance.index')->with('success', 'Attendance updated successfully!');
} 


} 