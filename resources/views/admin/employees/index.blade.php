<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 30px;
        }
        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: -43px;
           
        }
      
        .header-row h2 {
            margin-left: 560px;
            font-weight: 600;
            color: #333;
        }
        .employee-table th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }
        .employee-table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-edit {
            background-color: #ffc107;
            color: #fff;
            border: none;
            padding: 7px 12px;
            border-radius: 5px;
            
        }
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 3px 6px;
            border-radius: 5px;
        }
        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.9;
        }
       
        #search{
           
            margin-bottom: 5px;
            margin-right: -100px;
            padding: 5px;
            
        }
  
    
    </style>
</head>

<body>

  <div class="header-row">
        <h2>Employee List</h2>


                  <!-- SEARCH -->
        <div>
              <input type="text" id="search" name="search"  
               placeholder="Search by name,ID or department">
               
        </div>
      


      
                  <!--Register/Back to dashboard -->
        <a href="{{ route('employees.create') }}" class="btn btn-primary">+Register Employees</a>
    </div>

<div class="dash">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary"> 
        ← Back to Dashboard
    </a>
    </div>




                    <!--Employee Table-->"
    <table class="table table-bordered table-striped employee-table">
      
            <tr>
                <th>Employee_ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Status</th>
                <th style="width: 150px;">Action</th>
            </tr>
       
        <tbody id="employeeTable">
            @foreach ($employees as $employee)
            <tr>
                 <td>{{ $employee->emp_id }}</td>
                  <td>{{ $employee->name}}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->designation }}</td>
                <td>
                    <span class="badge
    @if($employee->status == 'active') bg-success
    @elseif($employee->status == 'inactive') bg-secondary
    @else bg-danger
    @endif">
    {{ $employee->status }}
</span> 
                </td>
   <td>



        <!--Edit Button -->
        <a href="{{ route('employees.edit', $employee->emp_id) }}"
           class="btn btn-warning btn-sm text-white d-inline-flex align-items-center justify-content-center"
           style="height:32px; padding:0 12px; border-radius:6px; font-size:14px; text-decoration:none;">
           Edit
        </a>

           <!-- Delete Button --> 
<form action="{{ route('employees.destroy', $employee->emp_id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit"
        class="btn btn-danger btn-sm d-inline-flex align-items-center justify-content-center"
        style="height:32px; padding:0 12px; border-radius:6px; font-size:14px;"
        onclick="return confirm('Are you sure you want to delete this employee?')">
        Delete
    </button>
</form> 
</td>
            </tr>
            @endforeach
        </tbody>
    </table>


                  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Reusable function for AJAX call
    function fetchEmployees(query = '') {
        $.ajax({
            url: "{{ route('employees.search') }}",
            type: "GET",
            data: { query: query },
            success: function(data){
                $('#employeeTable').html(data);
            },
            error: function(xhr){
                console.error("❌ AJAX error:", xhr.responseText);
            }
        });
    }

    // 🔹 Case 1: Keyup — Live Search
    $('#search').on('keyup', function(){
        let query = $(this).val().trim();
        fetchEmployees(query);
    });
    
});
</script> 
</body>
</html> 