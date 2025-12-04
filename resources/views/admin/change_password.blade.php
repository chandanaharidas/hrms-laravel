<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm col-md-6 mx-auto">
        <div class="card-header bg-primary text-white text-center">
            <h4>Change Password</h4>
        </div>

        <div class="card-body">
            {{-- Success / Error Messages --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Password Change Form --}}
            <form method="POST" action="{{ route('admin.updatePassword') }}">
                @csrf

                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Update Password</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>