<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Poppins', sans-serif;
        }

        .attendance-container {
            max-width: 1000px;
            margin: 40px auto;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }

        .card-header {
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
        }

        .checkin-btn {
            background-color: #198754;
            color: white;
        }

        .checkout-btn {
            background-color: #ffc107;
            color: black;
        }

        .summary-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        table th {
            background-color: #f1f5f9;
        }
    </style>
</head>
<body>

    <div class="attendance-container">
        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Header --}}
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">Employee Attendance</h2>
            <p class="text-muted mb-0">{{ \Carbon\Carbon::now()->format('l, M d, Y') }}</p>
        </div>


        <div class="card mb-4">
    <div class="card-header">Mark Attendance</div>
    <div class="card-body text-center">

      
        {{-- ✅ Button Logic --}}
        @if(!$todayAttendance)
            {{-- No record yet → Show Check In --}}
            <form action="{{ route('employee.attendance.checkin') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Check In</button>
            </form>

        @elseif(empty($todayAttendance->check_out))
            {{-- Record exists, check_out is NULL → Show Check Out --}}
            <form action="{{ route('employee.attendance.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger mt-2">Check Out</button>
            </form>

        @else
            {{-- Already checked out → Show success message --}}
            <span class="badge bg-success mt-2">You have checked out today!</span>
        @endif
    </div>
</div> 














        {{-- Summary --}}
        <div class="summary-card mb-4">
            <div class="row text-center">
                <div class="col-md-4 border-end">
                    <h6 class="text-success mb-0">Present</h6>
                    <h4>{{ $presentCount }}</h4>
                </div>
                <div class="col-md-4 border-end">
                    <h6 class="text-danger mb-0">Absent</h6>
                    <h4>{{ $absentCount }}</h4>
                </div>
                <div class="col-md-4">
                    <h6 class="text-secondary mb-0">Total</h6>
                    <h4>{{ \App\Models\Attendance::where('emp_id', $employee->emp_id)->count() }}</h4>
                </div>
            </div>
        </div>

        {{-- Monthly Attendance Table --}}
        <div class="card">
            <div class="card-header bg-light text-dark fw-semibold">
                This Month’s Attendance
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $a)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($a->date)->format('M d, Y') }}</td>
                                    <td>{{ $a->check_in ? \Carbon\Carbon::parse($a->check_in)->format('h:i A') : '-' }}</td>
                                    <td>{{ $a->check_out ? \Carbon\Carbon::parse($a->check_out)->format('h:i A') : '-' }}</td>
                                    <td>
                                        @if($a->status == 'Late')
                                            <span class="badge bg-warning text-dark">{{ $a->status }}</span>
                                        @elseif($a->status == 'absent')
                                            <span class="badge bg-danger">{{ $a->status }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $a->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-muted">No records for this month.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Back to Dashboard --}}
        <div class="text-center mt-4">
            <a href="{{ route('employee.dashboard') }}" class="btn btn-outline-secondary">
                ← Back to Dashboard
            </a>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> 