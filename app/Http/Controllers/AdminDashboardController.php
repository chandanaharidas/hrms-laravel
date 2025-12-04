<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\HRMessage;
class AdminDashboardController extends Controller
{
  
    public function index()
    {
        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', 'Active')->count();
        $inactiveEmployees = Employee::where('status', 'Inactive')->count();
        $recentEmployees = Employee::latest()->take(5)->get();
   
        $today = Carbon::today()->toDateString();//carbon:-date-time library

 
          // Today's attendance summary
    $presentToday = Attendance::whereDate('date', $today)
                              ->where('status', 'Present')
                              ->count();

    $absentToday = Attendance::whereDate('date', $today)
                             ->where('status', 'Absent')
                             ->count();

    $lateToday = Attendance::whereDate('date', $today)
                           ->where('status', 'Late')
                           ->count();

    // send all data to the view
    return view('admin.dashboard', compact(
            'totalEmployees',
            'activeEmployees',
            'inactiveEmployees',
        'presentToday',
        'absentToday',
        'lateToday'
    ));
} 



public function changePassword()
{
    return view('admin.change_password');
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


public function viewMessages()
{
    $messages = HRMessage::with('employee')->latest()->get();
    return view('admin.messages', compact('messages'));
} 



} 