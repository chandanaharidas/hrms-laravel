<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Attendance</title>

    <!-- Bootstrap CSS (for styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Edit Attendance Record</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.attendance.update', $attendance->id) }}" method="POST">
                    @csrf
@method('PUT')
                    <!-- Employee selection -->
                    <div class="mb-3">
                        <label for="emp_id" class="form-label">Select Employee</label>
                        <select name="emp_id" id="emp_id" class="form-select" required>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->emp_id }}" {{ $attendance->emp_id == $employee->emp_id ? 'selected' : '' }}>
                                    {{ $employee->name }}

                                    ({{ $employee->emp_id}})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status selection -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Attendance Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                            <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
                            <option value="late" {{ $attendance->status == 'late' ? 'selected' : '' }}>Late</option>
                        </select>
                    </div>

<div class="mb-3">
        <label>Check-In Time</label>
        <input type="time" name="check_in" class="form-control" value="{{ $attendance->check_in }}">
    </div>

    <div class="mb-3">
        <label>Check-Out Time</label>
        <input type="time" name="check_out" class="form-control" value="{{ $attendance->check_out }}">
    </div>



                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Update Attendance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for button styling and responsiveness) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>