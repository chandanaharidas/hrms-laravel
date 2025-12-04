<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-card {
            background-color: #fff;
            padding: 40px 45px;
            border-radius: 15px;
            width: 100%;
            max-width: 700px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-title {
            text-align: center;
            font-weight: 700;
            color: #4e73df;
            margin-bottom: 30px;
        }

        label {
            font-weight: 500;
            color: #333;
        }

        input.form-control, select.form-select {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            transition: all 0.3s ease;
        }

        input.form-control:focus, select.form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 8px rgba(78, 115, 223, 0.4);
        }

        .btn-primary {
            background-color: #4e73df;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: #858796;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #6c757d;
            transform: translateY(-1px);
        }

        .btn-row {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }
      
    </style>
</head>

<body>
    <div class="form-card">
        <h2 class="form-title">Add New Employee</h2>

  <!--When server side validation fails it will show error!-->      

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 


        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

       

            <div class="mb-3">
                <label>Employee ID</label>
                <input type="text" name="emp_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter company email username">
                <span style="margin-left: 5px;">@hrms.com</span>
          
            </div>

 
  <div class="mb-3">
  <label for="department" class="form-label fw-semibold">Department</label>
  <select name="department" id="department" class="form-select" required>
      <option value="" {{ old('department') ? '' : 'selected' }}>-- Select Department --</option>
      <option value="HR" {{ old('department') == 'HR' ? 'selected' : '' }}>HR</option>
      <option value="IT" {{ old('department') == 'IT' ? 'selected' : '' }}>IT</option>
      <option value="Finance" {{ old('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
       <option value="Marketing" {{ old('department') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
   <option value="Operations" {{ old('department') == 'Operations' ? 'selected' : '' }}>Operations</option>
    <option value="Admin" {{ old('department') == 'Admin' ? 'selected' : '' }}>Admin</option>
    </select>
</div> 


<div class="mb-3">
    <label for="designation" class="form-label fw-semibold">Designation</label>
    <select name="designation" id="designation" class="form-select" required>
        <option value="">-- Select Designation --</option>
    </select>
</div>

<script>
  document.getElementById("department").addEventListener("change", function() {
    const dept = this.value;
    const desigSelect = document.getElementById("designation");
    desigSelect.innerHTML = "<option value=''>-- Select Designation --</option>";

    if (dept === "HR") 
        {
      desigSelect.innerHTML +="<option>HR Manager</option><option>HR Executive</option>";
        } 
    else if (dept === "IT") 
        {
      desigSelect.innerHTML += "<option>Software Engineer</option><option>Tester</option><option>DevOps Engineer</option>";
        }
     else if (dept === "Finance") {
      desigSelect.innerHTML += "<option>Accountant</option><option>Finance Analyst</option>";
    }
    else if (dept === "Marketing") {
      desigSelect.innerHTML += "<option>Marketing Executive</option><option>SEO specialistst</option>";
    }
    else if (dept === "Operations") {
      desigSelect.innerHTML += "<option>Operaions Manager</option><option>Asst Manager</option>";
    }
    else if (dept === "Admin") {
      desigSelect.innerHTML += "<option>Office Assistant</option><option>Receptionist</option>";
    }
  });
</script>

<div class="mb-3">
    <label for="job_id" class="form-label">Assign Job</label>
    <select name="job_id" id="job_id" class="form-control">
        <option value="">-- Select Job --</option>
        @foreach($jobs as $job)
            @if($job->remaining_vacancies > 0)
                <option value="{{ $job->id }}">{{ $job->title }} ({{ $job->remaining_vacancies }} openings left)</option>
            @endif
        @endforeach
    </select>
</div> 




            <div class="mb-3">
                <label>Join Date</label>
                <input type="date" name="join_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Salary</label>
                <input type="number" name="salary" class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Resignation Date (optional)</label>
                <input type="date" name="resignation_date" class="form-control">
            </div>

            <div class="btn-row">
                <button type="submit" class="btn btn-primary">💾 Save Employee</button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">↩ Cancel</a>
            </div>
        </form>
    </div>
</body>
</html> 

	

	
