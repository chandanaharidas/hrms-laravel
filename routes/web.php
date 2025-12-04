<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Http\Controllers\EmployeeAttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\AdminJobController;


                  //home page of bizland
                 Route::get('/', function () {
                  return view('home');
                  });


                    //****ADMIN*****//

                //admin dashboard
Route::middleware(['auth', 'role:Admin'])->group(function () 
{
    
          //***Admin Dashboard route */
 Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

         //Recruitment
 Route::get('/admin/jobs', [AdminJobController::class, 'index'])->name('admin.jobs.index');
 //Return addjob form
 Route::get('/admin/jobs/create', [AdminJobController::class, 'create'])->name('admin.jobs.create');
Route::Post('/admin/jobs/create', [AdminJobController::class, 'store'])->name('admin.jobs.create');
Route::Post('/admin/jobs/store', [AdminJobController::class, 'store'])->name('admin.jobs.store');

      //index,create,store,show,edit,delete.Created for admin
  Route::resource('employees',EmployeeController::class);

  //Employee search
  Route::get('/employee/search', [EmployeeController::class, 'search'])->name('employees.search');

    Route::get('/admin/attendance', [AdminAttendanceController::class, 'index'])->name('admin.attendance.index');
    Route::get('/admin/attendance/edit/{id}', [AdminAttendanceController::class, 'edit'])->name('admin.attendance.edit');
    
    Route::put('/admin/attendance/update/{id}', [AdminAttendanceController::class, 'update'])->name('admin.attendance.update');

Route::get('/hr/leaves', [LeaveController::class, 'adminIndex'])->name('hr.leaves.index');
Route::put('/hr/leaves/{id}/status', [LeaveController::class, 'updateStatus'])->name('hr.leaves.updateStatus'); 
Route::post('/hr/leaves/bulk-update', [LeaveController::class, 'bulkUpdate'])->name('hr.leaves.bulkUpdate'); 
Route::post('/admin/leave/approve-all', [LeaveController::class, 'approveAll'])->name('leave.approveAll');
Route::post('/admin/leave/reject-all', [LeaveController::class, 'rejectAll'])->name('leave.rejectAll'); 




Route::get('/admin/change-password', [AdminDashboardController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('/admin/update-password', [AdminDashboardController::class, 'updatePassword'])->name('admin.updatePassword');
Route::get('/hr/messages', [AdminDashboardController::class, 'viewMessages'])->name('hr.messages'); 

});




              /// Employee   ////////
    

Route::middleware(['auth','role:Employee'])->group(function()
{
      // View of Employee Dashboard // 
          Route::get('employee/dashboard', function ()
        {
          return view('employee.dashboard');
         })->name('employee.dashboard');


    Route::get('employee/dashboard', [EmployeeDashboardController::class, 'dashboard'])->name('employee.dashboard');
   

    // 👇 Add these routes for the profile page
    Route::get('/employee/profile', [EmployeeDashboardController::class, 'profile'])->name('employee.profile');
    Route::post('/employee/profile', [EmployeeDashboardController::class, 'updateProfile'])->name('employee.updateProfile');
    Route::post('/employee/remove-profile-pic', [EmployeeDashboardController::class, 'removeProfilePic'])
    ->name('employee.removeProfilePic'); 


    //Attendance route
     Route::get('/employee/attendance', [EmployeeAttendanceController::class, 'index'])->name('employee.attendance');
    Route::post('/employee/attendance/checkin', [EmployeeAttendanceController::class, 'checkIn'])
    ->name('employee.attendance.checkin');

Route::post('/employee/attendance/checkout', [EmployeeAttendanceController::class, 'checkOut'])
    ->name('employee.attendance.checkout'); 

//Leaves
    Route::get('/employee/leave', [LeaveController::class, 'index'])->name('employee.leave');
    Route::post('/employee/leave', [LeaveController::class, 'store'])->name('employee.leave.store');
// for showing the apply form (optional if you want separate)
Route::get('/employee/leave/create', [LeaveController::class, 'create'])->name('employee.leave.create');


    Route::get('/employee/change-password', [EmployeeDashboardController::class, 'changePassword'])->name('employee.changePassword');
    Route::post('/employee/update-password', [EmployeeDashboardController::class, 'updatePassword'])->name('employee.updatePassword');


    Route::get('/employee/contact-hr', [EmployeeDashboardController::class, 'contactHRForm'])
    ->name('employee.contactHR');

Route::post('/employee/contact-hr', [EmployeeDashboardController::class, 'sendHRMail'])
    ->name('employee.sendHRMail');

   
});

require __DIR__.'/auth.php';

