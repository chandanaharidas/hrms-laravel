<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact HR</title>

    <!-- Optional: Bootstrap CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f7f7f7;">

    <div class="container mt-5">

        <div class="card shadow-sm">
            <div class="card-header">
                <h3>Contact HR</h3>
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('employee.sendHRMail') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" rows="5" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>

            </div>
        </div>

    </div>

</body>
</html>