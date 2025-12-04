<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR – Employee Messages</title>

    <!-- Optional: Bootstrap CDN for table styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f5f5;">

    <div class="container mt-5">

        <h2 class="mb-4">Employee Messages</h2>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Employee Name</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($messages as $msg)
                            <tr>
                                <td>{{ $msg->employee->name }}</td>
                                <td>{{ $msg->subject }}</td>
                                <td>{{ $msg->message }}</td>
                                <td>{{ $msg->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    </div>

</body>
</html> 