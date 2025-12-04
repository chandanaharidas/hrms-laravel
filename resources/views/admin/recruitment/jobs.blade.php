<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Jobs | HRMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5 p-4 bg-white shadow rounded">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Job Listings</h2>
            <a href="{{ route('admin.jobs.create') }}" class="btn btn-success">+ Add New Job</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Department</th>
                    <th>Total</th>
                    <th>Filled</th>
                    <th>Remaining</th>
                    <th>Status</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->department }}</td>
                        <td>{{ $job->total_vacancies }}</td>
                        <td>{{ $job->filled_vacancies }}</td>
                        <td>{{ $job->remaining_vacancies }}</td>
                        <td>
                            @if($job->status == 'Active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Closed</span>
                            @endif
                        </td>
                        <td>{{ $job->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No jobs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html> 