<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Leave</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 40px;
            margin-bottom: 40px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        h3 {
            font-weight: 600;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>

<div class="container">


{{-- Leave Summary --}}
<div class="card mb-4">
    <div class="card-header bg-primary text-white fw-bold">
        Leave Summary
    </div>
    <div class="card-body">
        <div class="row text-center">
            @foreach($totalLeaves as $type => $limit)
                <div class="col-md-3 col-6 mb-3">
                    <div class="border rounded p-3 shadow-sm">
                        <h6 class="fw-bold text-secondary">{{ $type }}</h6>
                        <p class="mb-1">Used: <span class="fw-bold text-danger">{{ $limit - $remainingLeaves[$type] }}</span></p>
                        <p class="mb-0">Remaining: <span class="fw-bold text-success">{{ $remainingLeaves[$type] }}</span> / {{ $limit }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> 

    {{-- Title --}}
    <h3 class="text-center text-primary mb-4">Apply for Leave</h3>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- Error Message --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif 

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif






    {{-- Leave Application Form --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('employee.leave.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Leave Type</label>
                        <select name="leave_type" class="form-select" required>
                            <option value="">-- Select Type --</option>
                            <option value="Casual Leave">Casual Leave</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Paid Leave">Paid Leave</option>
                            <option value="Unpaid Leave">Unpaid Leave</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Start Date</label>
                        <input type="date" class="form-control" name="start_date" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">End Date</label>
                        <input type="date" class="form-control" name="end_date" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Reason</label>
                    <textarea name="reason" class="form-control" rows="3" placeholder="Reason (optional)"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">Submit Leave</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Leave History --}}
    <h4 class="text-secondary mb-3">Your Leave History</h4>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Applied On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaves as $key => $leave)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $leave->leave_type }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}</td>
                            <td>{{ $leave->reason ?? '-' }}</td>
                            <td>
                                @if($leave->status == 'Pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($leave->status == 'Approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $leave->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted">No leave records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>