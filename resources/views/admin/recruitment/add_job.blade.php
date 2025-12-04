<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Job | HRMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5 p-4 bg-white shadow rounded">
        <h2 class="text-center mb-4">Add New Job</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.jobs.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Job Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter job title" required>
            </div>

            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" id="department" name="department" class="form-control" placeholder="Enter department name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Job Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter job details" required></textarea>
            </div>

            <div class="mb-3">
                <label for="total_vacancies" class="form-label">Total Vacancies</label>
                <input type="number" id="total_vacancies" name="total_vacancies" class="form-control" placeholder="Enter total vacancies" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">Add Job</button>
                <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary px-4">Back to Jobs</a>
            </div>
        </form>
    </div>

</body>
</html> 