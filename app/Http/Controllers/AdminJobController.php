<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
class AdminJobController extends Controller
{
   public function index()
{
    $jobs = Job::all();
    return view('admin.recruitment.jobs', compact('jobs'));
} 

public function create()
{
    return view('admin.recruitment.add_job');
}


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'description' => 'required',
        'total_vacancies' => 'required|integer|min:1',
    ]);

    Job::create([
        'title' => $request->title,
        'department' => $request->department,
        'description' => $request->description,
        'total_vacancies' => $request->total_vacancies,
        'filled_vacancies' => 0,
        'remaining_vacancies' => $request->total_vacancies,
        'status' => 'Active',
    ]);

    return redirect()->route('admin.jobs.index')->with('success', 'Job added successfully!');
} 
}
