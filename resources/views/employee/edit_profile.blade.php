<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    {{-- Bootstrap CDN for styling --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#f8f9fa;">

<div class="container mt-5">
    <div class="card shadow p-4" style="max-width:700px; margin:auto;">
        <h3 class="mb-4 text-center">Edit Profile</h3>

        {{-- Success message --}}
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        {{-- Error messages --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('employee.updateProfile') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $employee->name) }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Personal Email ID</label>
                <input type="text" name="personal_email" class="form-control"
                       value="">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control"
                       value="{{ old('phone', $employee->phone) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control"
                       value="{{ old('address', $employee->address) }}">
            </div>

               <div class="mb-2">
        @if($employee->profile_picture)
            <img src="{{ asset('uploads/profile_pictures/' . $employee->profile_picture) }}" width="80" height="80" class="rounded mb-2">
            <div class="form-check">
                <input type="checkbox" name="remove_photo" id="remove_photo" class="form-check-input">
                <label for="remove_photo" class="form-check-label">Remove current photo</label>
            </div>
        @endif
        <input type="file" name="profile_picture" class="form-control mt-2">
    </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('employee.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

</body>
</html> 
