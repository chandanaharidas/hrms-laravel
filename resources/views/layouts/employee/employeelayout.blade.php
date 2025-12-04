@extends('layouts.employee.employee')

@section('title', 'Admin Dashboard')

@section('content')

<h4 class="fw-bold mb-4 text-primary">Employee Dashboard</h4>

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">

        <!-- Profile Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white fw-semibold">
                <i class="fa fa-user me-2"></i> My Profile
            </div>
            <div class="card-body">
                <h5 class="card-title text-primary">Profile Details</h5>
                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Department:</strong> {{ Auth::user()->department ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Attendance Summary -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white fw-semibold">
                <i class="fa fa-calendar-check me-2"></i> Attendance Summary
            </div>
            <div class="card-body">
                <p><strong>Present Days:</strong> 18</p>
                <p><strong>Absent Days:</strong> 2</p>
                <p><strong>Total Working Days:</strong> 20</p>
            </div>
        </div>
    </div>
</div>

@endsection 