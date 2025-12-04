<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
    <style>
  .butn{
    margin-left: -160px;
  }
    </style>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    
<div class="container mt-4">

<div class="dash">
    <a href="{{ route('admin.dashboard') }}" class="butn btn-primary"> 
        ← Back to Dashboard
    </a>
    <h3 class="mb-3 text-center">Attendance Records</h3>


    <!-- Filter Form -->
    <form method="GET" action="{{ route('admin.attendance.index') }}" class="mb-4">
        <div class="row g-2 justify-content-center">
            <div class="col-md-3">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-3">
                <select name="emp_id" class="form-control">
                    <option value="">-- Select Employee --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Attendance Table -->
    <table class="table table-bordered table-striped align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Employee</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->employee->name ?? 'Unknown Employee' }} (emp_id:{{ $attendance->emp_id }})</td>
                    <td>{{ $attendance->check_in ?? '-' }}</td>
                    <td>{{ $attendance->check_out ?? '-' }}</td>
                    <td>
                        <span class="badge
                            @if($attendance->status == 'present') bg-success
                            @elseif($attendance->status == 'late') bg-warning
                            @else bg-danger @endif">
                            {{ ucfirst($attendance->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.attendance.edit', $attendance->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>