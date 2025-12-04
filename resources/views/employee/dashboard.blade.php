@extends('layouts.employee.employeelayout')

@section('title', 'Employee Dashboard')

@section('content')

<style>
  body {
    background-color: #f4f6f9;
  }

  .dashboard-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-items: flex-start;
    padding: 20px;
  }

  .card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 20px;
    width: 320px;
    flex: 0 0 auto;
    transition: all 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
  }

  .profile-card {
    border-top: 5px solid #3b82f6;
    text-align: center;
  }

  .profile-card img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #3b82f6;
    margin-bottom: 10px;
  }

  .upload-btn {
    display: inline-block;
    padding: 6px 12px;
    font-size: 14px;
    color: #fff;
    background-color: #3b82f6;
    border-radius: 6px;
    cursor: pointer;
    margin-bottom: 10px;
  }

  .attendance-card {
    border-top: 5px solid #f59e0b;
  }

  .quick-card {
    border-top: 5px solid #10b981;
  }

  h2 {
    font-size: 18px;
    color: #333;
    margin-top: 0;
  }

  p {
    color: #555;
    margin: 6px 0;
  }

  ul {
    list-style-type: none;
    padding: 0;
  }

  ul li {
    margin: 8px 0;
  }

  ul li a {
    text-decoration: none;
    color: #10b981;
    font-weight: bold;
  }

  ul li a:hover {
    color: #059669;
  }


  #chatbot-icon {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background: #0099ff;
    color: white;
    padding: 15px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

#chatbot-window {
    position: fixed;
    bottom: 90px;
    right: 25px;
    width: 320px;
    height: 420px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    display: none;
    flex-direction: column;
}

.chat-header {
    background: #007bff;
    color: white;
    padding: 10px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-actions button {
    background: transparent;
    color: white;
    font-size: 18px;
    border: none;
    cursor: pointer;
    margin-left: 5px;
}

.chat-body {
    flex: 1;
    overflow-y: auto;
    padding: 10px;
    background: #f1f1f1;
}

.chat-input {
    padding: 10px;
    display: flex;
    border-top: 1px solid #ccc;
}

.chat-input input {
    flex: 1;
    padding: 8px;
}

.chat-input button {
    margin-left: 10px;
}

</style>

<div class="dashboard-container">
  <!-- Profile Card -->
  <div class="card profile-card">
    <img id="profileImage" src="https://via.placeholder.com/120" >
    <label for="fileInput" class="upload-btn">Change Photo</label>
    <input type="file" id="fileInput" accept="image/*" style="display:none;">
    <h2>My Profile</h2>
    <p><strong>Name:</strong> {{ $employee->name ?? '' }}</p>
    <p><strong>Email:</strong> {{ $employee->email ?? '' }}</p>
    <p><strong>Designation:</strong> {{ $employee->designation ?? '' }}</p>
  </div>

  <!-- Attendance Summary -->
  <div class="card attendance-card">
    <h2>Attendance Summary</h2>
    <p>Present Days: {{ $presentCount}}</p>
    <p>Absent Days:{{  $absentCount}} </p>
    <p>Total Working Days: {{ \App\Models\Attendance::where('emp_id', $employee->emp_id)->count() }}</p>
  </div>

  <!-- Quick Actions -->
  <div class="card quick-card">
    <h2>Quick Actions</h2>
    <ul>
      <li><a href="{{ route('employee.profile') }}">✏️ Edit Profile</a></li>
      <li><a href="{{ route('employee.changePassword') }}">🔒 Change Password</a></li>
      <li><a href="{{ route('employee.leave') }}">📝 Apply Leave</a></li>
      <li><a href="{{ route('employee.contactHR') }}">📨 Contact HR</a></li> 
    </ul>
  </div>
</div>

<script>
  // Preview new profile photo before uploading
  const fileInput = document.getElementById('fileInput');
  const profileImage = document.getElementById('profileImage');

  fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        profileImage.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>
@endsection 


