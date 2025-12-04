<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token()}}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HRMS Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
<style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        overflow-x: hidden; /* removes unwanted side scrolling */
    }

    .d-flex {
        margin: 0;
        padding: 0;
    }

    nav.sidebar {
        width: 250px; /* fixed sidebar width */
        min-height: 100vh;
        background-color: indigo;
    }

    main {
        flex-grow: 1;
        padding: 20px;
        background-color: #f8f9fa;
    }

    /* Optional: Make sure content doesn’t shrink */
    .flex {
        flex-wrap: nowrap !important;
    }
</style> 

</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Sidebar -->
        <nav class="sidebar text-white p-3">
            <h5 class="fw-bold mb-4 text-white">HRMS</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('employee.profile') }}" class="nav-link text-white">
                        <i class="fa fa-user me-2"></i> Edit Profile
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{route('employee.attendance')}}" class="nav-link text-white">
                        <i class="fa fa-calendar-check me-2"></i> Attendance
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{route('employee.leave')}}" class="nav-link text-white">
                        <i class="fa fa-plane-departure me-2"></i> Leaves
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a href="{{route('employee.changePassword')}}" class="nav-link text-white">
                        <i class="fa fa-lock me-2"></i> Change Password
                    </a>
                </li>
                <li class="nav-item mt-auto">
                    <a href="#" class="nav-link text-white fw-bold" id="logout-link">
                        <i class="fa fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
        </nav>

        <!-- Main Content -->
        <main> 
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const logoutLink = document.getElementById("logout-link");
            const logoutForm = document.getElementById("logout-form");

            logoutLink.addEventListener("click", function(event) {
                event.preventDefault();
                logoutForm.submit();
            });
        });
    </script>
</body> 
</html> 
