<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Job;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class EmployeeController extends Controller
{

     //****Displaying Employee list Page for employee editing****///
   
     public function index()
{
    $employees = Employee::all(); // fetch all employees
    return view('admin.employees.index', compact('employees'));
}



    // Show the employee create form
   public function create()
{
    $jobs = Job::where('status', 'Active')->get(); // get all active jobs
    return view('admin.employees.create', compact('jobs'));
} 


    // Store new employee record
    public function store(Request $request)
    {
        // Step 1: Validate form data
        $request->validate([
            'emp_id' => 'required|unique:employees,emp_id',
            'name' => 'required|string|max:250',
            'email' => 'required|string|unique:employees,email',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:50',
            'join_date' => 'required|date',
            'salary' => 'nullable|numeric',
            'status' => 'nullable|string',
            'job_id' =>'nullable|exists:jobs,id',
            
        ]);


      //Auto generated company email
  $companyemail=strtolower(trim($request->email)).'@hrms.com';



        // Step 2: Check if a user with this email already exists in user table
        //paralely creating record in user table also
        $existingUser = User::where('email', $companyemail)->first();

        if ($existingUser) {
            // If exists, use that user id
            $user = $existingUser;
        } else {
            // Otherwise create new user with default password 123456
            $user = User::create([
                'name' => $request->name,
                'email' => $companyemail,
                'password' => Hash::make('123456'),
            ]);
        }

        // Step 3: Create new employee record
        Employee::create([
            'emp_id' => $request->emp_id,
            'name' => $request->name,
            'email' => $companyemail,
            'phone' => $request->phone,
            'department' => $request->department,
            'designation' => $request->designation,
            'join_date' => $request->join_date,
            'salary' => $request->salary,
            'status' => $request->status,
            'user_id' => $user->id,

        ]);

        //  Update job vacancy counts if job is selected
if ($request->job_id) {
    $job = Job::find($request->job_id);
    if ($job) {
        $job->filled_vacancies += 1;
        $job->remaining_vacancies = $job->total_vacancies - $job->filled_vacancies;

        if ($job->remaining_vacancies <= 0) {
            $job->status = 'Closed';
        }

        $job->save();
    }
} 

        // Step 4: Redirect back with success message
        return redirect()->route('employees.index')
            ->with('success', 'Employee added successfully. Default password: 123456 (if new user was created)');
    }




//Search Ajax method
   public function search(Request $request)
{
    $query = $request->get('query');

    if ($query != '') {
        $employees = \App\Models\Employee::where('emp_id', 'like', "%{$query}%")
            ->orWhere('name', 'like', "%{$query}%")
            ->orWhere('department', 'like', "%{$query}%")
            ->get();
    } else {
        $employees = \App\Models\Employee::all();
    }
    $output = '';
    foreach ($employees as $employee) {
        $output .= '
        <tr>
            <td>'.$employee->emp_id.'</td>
            <td>'.$employee->name.'</td>
            <td>'.$employee->email.'</td>
            <td>'.$employee->department.'</td>
            <td>'.$employee->designation.'</td>
            <td>'.$employee->status.'</td>

  <td>
            <a href="'.route('employees.edit', $employee->id).'" class="btn btn-warning btn-sm">Edit</a>
            <form action="'.route('employees.destroy', $employee->id).'" method="POST" style="display:inline;">
                '.csrf_field().method_field('DELETE').'
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>

        </tr>';
    }

    if ($employees->count() == 0) {
        $output = '<tr><td colspan="6" class="text-center text-danger">No employees found</td></tr>';
    }

    return response($output);
} 





//Showing Employee Form to edit
public function edit($emp_id)
{
    // Step 1: Get the employee by ID
    $employee = \App\Models\Employee::findOrFail($emp_id);

    // Step 2: Pass employee data to the edit view
    return view('admin.employees.edit', compact('employee'));
} 


public function update(Request $request, $emp_id)
{
    // Step 1: Validate the form inputs
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'department' => 'nullable|string|max:255',
        'designation' => 'nullable|string|max:255',
        'status' => 'required|string|max:255',
        
    ]);

    // Step 2: Find the employee record
    $employee = \App\Models\Employee::findOrFail($emp_id);

    // Step 3: Update the record
    $employee->update($validated);

    // Step 4: Redirect back with success message
    return redirect()->route('employees.index')
                     ->with('success', 'Employee details updated successfully!');
} 



public function destroy($emp_id)
{
    $employee = \App\Models\Employee::findOrFail($emp_id);
    $employee->delete();

    return redirect()->route('employees.index')
                     ->with('success', 'Employee deleted successfully!');
} 


public function dashboard()
{
    return view('employee.dashboard');
}






} 