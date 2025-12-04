<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Leave Management</title>

    <!-- ✅ Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #eaf3ff;
        }
        h2 {
            font-weight: 600;
            color: #007bff;
        }
        .btn-sm {
            padding: 4px 8px;
            font-size: 13px;
        }
        .form-control-sm {
            font-size: 13px;
        }
    </style>



</head>
<body>
 

    <div class="container my-5">
@if ($errors->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif 




        <div class="card border-0">
            <div class="card-header bg-primary text-white text-center">
                <h2 class="mb-0">HR Leave Management</h2>
            </div>
 

            <div class="card-body">


            <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-primary mb-0">Leave Management</h4>

    <div>
        <a href="{{ route('hr.leaves.index') }}" class="btn btn-secondary btn-sm">All</a>
        <a href="{{ route('hr.leaves.index', ['status' => 'Pending']) }}" class="btn btn-warning btn-sm">Pending</a>
        <a href="{{ route('hr.leaves.index', ['status' => 'Approved']) }}" class="btn btn-success btn-sm">Approved</a>
        <a href="{{ route('hr.leaves.index', ['status' => 'Rejected']) }}" class="btn btn-danger btn-sm">Rejected</a>
    </div>
</div> 

<!-- Show these buttons only when HR is viewing Pending leaves -->
@if(isset($status) && $status == 'Pending' && $leaves->count() > 0)
<div class="text-end mb-3">
    <form action="{{ route('hr.leaves.bulkUpdate') }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to approve all pending leaves?');">
        @csrf
        <button name="action" value="Approve" class="btn btn-success btn-sm">Approve All</button>
    </form>
    <form action="{{ route('hr.leaves.bulkUpdate') }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to reject all pending leaves?');">
        @csrf
        <button name="action" value="Reject" class="btn btn-danger btn-sm">Reject All</button>
    </form>
</div>
@endif 




                <table class="table table-bordered table-hover align-middle text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Name</th>
                            <th>Leave Type</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaves as $key => $leave)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $leave->employee->name ?? 'Unknown' }}</td>
                                <td>{{ $leave->leave_type }}</td>
                                <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}</td>
                                <td>{{ $leave->reason ?? '-' }}</td>
                                <td>
                                    @if($leave->status == 'Pending')
                                        <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                    @elseif($leave->status == 'Approved')
                                        <span class="badge bg-success px-3 py-2">Approved</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $leave->remark ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('hr.leaves.updateStatus', $leave->id) }}" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="remark" class="form-control form-control-sm" placeholder="Add remark" style="width: 150px;">
                                        <button type="submit" name="status" value="Approved" class="btn btn-success btn-sm">Approve</button>
                                        <button type="submit" name="status" value="Rejected" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-muted">No leave requests found.</td>
                            </tr>
                        @endforelse

                        </tbody>


                </table>


                <div class="mb-3 d-flex justify-content-end gap-2">
    <form action="{{ route('leave.approveAll') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Approve All</button>
    </form>

    <form action="{{ route('leave.rejectAll') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Reject All</button>
    </form>
</div> 


            </div>
        </div>
    </div>

    <!-- ✅ Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 