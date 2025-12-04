<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HRMS Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen">
        
        <!-- Sidebar -->
        <nav class="sidebar text-white p-3 vh-100" style="background-color: indigo;">
            <h5 class="fw-bold mb-4">HRMS</h5>

<!-- Recruitment Menu -->
<li class="nav-item list-unstyled position-relative">
  <a href="#" id="recruitmentToggle"
     class="nav-link text-white d-flex justify-content-between align-items-center px-3 py-2">
      <span><i class="fas fa-briefcase me-2"></i> Recruitment</span>
      <i class="fas fa-chevron-right small" id="recruitmentArrow"></i>
  </a>

  <!-- Submenu (opens right side) -->
  <ul id="recruitmentSubmenu"
      class="bg-dark text-white rounded shadow list-unstyled position-absolute"
      style="display:none; top:0; left:100%; width:180px; z-index:9999;">
      <li><a href="{{ route('admin.jobs.create') }}" class="d-block text-white px-3 py-2">➕ Add Job</a></li>
      <li><a href="{{ route('admin.jobs.index') }}" class="d-block text-white px-3 py-2">📋 View Jobs</a></li>
  </ul>
</li> 

<script>
document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.getElementById('recruitmentToggle');
  const submenu = document.getElementById('recruitmentSubmenu');
  const arrow = document.getElementById('recruitmentArrow');

  // Open on hover
  toggle.addEventListener('mouseenter', () => {
    submenu.style.display = 'block';
    arrow.style.transform = 'rotate(90deg)';
    arrow.style.transition = 'transform 0.2s';
  });

  // Close when mouse leaves both the link and submenu
  toggle.addEventListener('mouseleave', () => {
    setTimeout(() => {
      if (!submenu.matches(':hover')) {
        submenu.style.display = 'none';
        arrow.style.transform = 'rotate(0deg)';
      }
    }, 100);
  });

  submenu.addEventListener('mouseleave', () => {
    submenu.style.display = 'none';
    arrow.style.transform = 'rotate(0deg)';
  });
});
</script> 



            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('employees.index') }}" class="nav-link text-white">
                        <i class="fa fa-user me-2"></i> Employees
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{route('admin.attendance.index')}}" class="nav-link text-white">
                        <i class="fa fa-calendar-check me-2"></i> Attendance
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{route('hr.leaves.index')}}" class="nav-link text-white">
                        <i class="fa fa-plane-departure me-2"></i> Leaves
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{route('admin.changePassword')}}"  class="nav-link text-white">
                        <i class="fa fa-lock me-2"></i> Change Password
                    </a>
                </li>

 <li class="nav-item mb-2">
                    <a href="{{route('hr.messages')}}"  class="nav-link text-white">
                        <i class="fa fa-message me-2"></i> Employee Messages
                    </a>
                </li>


               <li class="nav-item mt-3">
    <a href="#" class="nav-link text-white fw-bold" id="logout-link">
        <i class="fa fa-sign-out-alt me-2"></i> Logout
    </a>


    <!-- Laravel logout should be in post -->
    <!-- Hidden Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li> 
            </ul>



        </nav>
   
        <!-- Main Content -->
        <main class="flex-1 p-0 m-0">
            @yield('content')
        </main>
    </div>
  
<!--using script will hide the form or button for logout -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    const logoutLink = document.getElementById("logout-link");
    const logoutForm = document.getElementById("logout-form");

    logoutLink.addEventListener("click", function(event) {
        event.preventDefault(); // stops the GET request
        logoutForm.submit();    // submits the hidden POST form
    });
});
</script> 



</body> 
</html> 
