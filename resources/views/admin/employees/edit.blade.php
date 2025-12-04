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
        <h2 class="form-title">Update Employee Details</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
        <form action="{{ route('employees.update',$employee->emp_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Employee ID</label>
                <input type="text" name="emp-id" class="form-control" 
                value="{{ old('emp_id', $employee->emp_id)}}" readonly>
            </div>


            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required
                  value="{{ old('name', $employee->name)}}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required
                value="{{ old('email', $employee->email)}}" readonly>
            </div>

           

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required
                value="{{ old('phone', $employee->phone)}}">
            </div>

            <div class="mb-3">
                <label>Department</label>
                <input type="text" name="department" class="form-control" required
                 value="{{ old('department', $employee->department)}}">
            </div>

            <div class="mb-3">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control" required
                value="{{ old('designation', $employee->designation)}}">
            </div>

            <div class="mb-3">
                <label>Join Date</label>
                <input type="date" name="join_date" class="form-control" required
                 value="{{ old('join_date', $employee->join_date)}}">
            </div>

            <div class="mb-3">
                <label>Salary</label>
                <input type="number" name="salary" class="form-control" 
                value="{{ old('salary', $employee->salary)}}">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ $employee->status =='active' ? 'selected' : '' }} >Active</option>
                    <option value="inactive" {{ $employee->status =='active' ? 'selected' : '' }} >Inactive</option>
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
	