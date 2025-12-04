@extends('layouts.admin.admin')
@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')
@section('content')
<style>
.total_employees{
  margin-top: 70px;
  width: 450px;
  margin-left: 5px;
}
.active_employees{
     margin-top: 70px;
  width: 440px;
  margin-right: -20px;
}
.inactive_employees{
    margin-top: -152px;
    height: 129px;
    margin-left: 7px;
    width: 450px;
}
</style>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

<h2 class="text-xl font-semibold text-gray-800 mb-2 mt-6">
    Hello, {{ Auth::user()->name }} 👋 
</h2> 

                       <!-- Total Employees -->
    <div class=" total_employees bg-white shadow-lg rounded-xl p-6 border-l-4 border-indigo-600  ">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-600 uppercase">Total Employees</h3>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalEmployees }}</p>
            </div>
            <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
                <i class="fa-solid fa-users fa-lg"></i>
            </div>
        </div>
    </div>

                            <!-- Active Employees -->
    <div class="active_employees bg-white shadow-lg rounded-xl p-6 border-l-4 border-green-500 ">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-600 uppercase">Active Employees</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $activeEmployees }}</p>
            </div>
            <div class="bg-green-100 text-green-600 p-3 rounded-full">
                <i class="fa-solid fa-user-check fa-lg"></i>
            </div>
        </div>
    </div>



                              <!-- Inactive Employees -->
    <div class="inactive_employees bg-white shadow-lg rounded-xl p-6 border-l-4 border-red-500 ">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-sm font-semibold text-gray-600 uppercase">Inactive Employees</h3>
                <p class="text-3xl font-bold text-red-600 mt-2">{{ $inactiveEmployees }}</p>
            </div>
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                <i class="fa-solid fa-user-xmark fa-lg"></i>
            </div>
        </div>
    </div>
</div> 


<!-- Attendance Overview Title -->
<h2 class="text-xl font-semibold text-gray-800 mb-2">
    Attendance Report — {{ \Carbon\Carbon::today()->format('F j, Y') }}
</h2>
<!-- Today's Attendance Summary -->
<div class="mt-10">
  <h3 class="text-lg font-semibold text-gray-700 mb-4">Today's Attendance Summary</h3>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Present -->
    <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-green-600">
      <h4 class="text-sm font-semibold text-gray-600 uppercase">Present</h4>
      <p class="text-3xl font-bold text-green-600 mt-2">{{ $presentToday }}</p>
    </div>

    <!-- Absent -->
    <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-red-600">
      <h4 class="text-sm font-semibold text-gray-600 uppercase">Absent</h4>
      <p class="text-3xl font-bold text-red-600 mt-2">{{ $absentToday }}</p>
    </div>

    <!-- Late -->
    <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-yellow-500">
      <h4 class="text-sm font-semibold text-gray-600 uppercase">Late</h4>
      <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $lateToday }}</p>
    </div>
  </div>
</div> 

@endsection 
