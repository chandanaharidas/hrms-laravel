<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use App\Models\Attendance;
use App\Models\HRMessage;
//use App\Http\Controllers\EmployeeAttendanceController;

class EmployeeDashboardController extends Controller
{
    public function dashboard()
{
    // Logged-in user
    $user = Auth::user();

    // Fetch employee record linked to this user
    $employee = Employee::where('user_id', $user->id)->first();

    // Attendance count
    $presentCount = Attendance::where('emp_id', $employee->id)
                    ->where('status', 'Present')
                    ->count();

    $absentCount = Attendance::where('emp_id', $employee->id)
                    ->where('status', 'Absent')
                    ->count();

    $totalWorkingDays = $presentCount + $absentCount;

    return view('employee.dashboard', compact(
        'user',
        'employee',
        'presentCount',
        'absentCount',
        'totalWorkingDays'
    ));
} 

    public function profile()
    {
        $employee = auth()->user();
        return view('employee.edit_profile', compact('employee'));
    }


   public function updateProfile(Request $request)
    {
        // 1) Get logged in user id
        $userId = Auth::id();

        // 2) Find employee by user_id (this assumes employees.user_id holds the users.id)
        $employee = Employee::where('user_id', $userId)->first();

        if (!$employee) {
            return back()->with('error', 'Employee record not found for this user.');
        }

    

        // 3) Validate input
        $request->validate([
            'personal_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:1000',
            //'profile_picture' => 'nullable|file||mimetypes:image/jpeg,image/png,image/jpg|max:2048',
            'profile_picture' => 'nullable|file||mimetypes:image/jpeg,image/jpg,image/png,image/x-png,image/webp|max:4096'
        ]);

        // 4) Update fields
        $employee->personal_email = $request->input('personal_email');
        $employee->phone = $request->input('phone');
        $employee->address = $request->input('address');

        // 5) Handle profile picture upload
       if ($request->hasFile('profile_picture')) {
    $file = $request->file('profile_picture');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads/profile_pictures'), $filename);
    $employee->profile_picture = $filename;
} 
        // 6) Save and return
        $employee->save();

        return back()->with('success', 'Profile updated successfully!');
    }




public function changePassword()
{
    return view('employee.change_password');
}


public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $user = auth()->user();
    

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect.');
    }

    $user->update([
        'password' => Hash::make($request->new_password),
    ]);

    return back()->with('success', 'Password updated successfully!');
} 

public function contactHRForm()
{
    return view('employee.contact-hr');
}


public function sendHRMail(Request $request)
{
    $request->validate([
        'subject' => 'required',
        'message' => 'required',
    ]);

    HRMessage::create([
        'emp_id' => auth()->user()->id,
        'subject' => $request->subject,
        'message' => $request->message,
    ]);

    return back()->with('success', 'Your message has been sent to HR.');
} 
} 
