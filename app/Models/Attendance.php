<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'emp_id', 'date', 'check_in', 'check_out', 'status', 'note'
    ];

    protected $dates = ['check_in', 'check_out', 'date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id','emp_id');
       
    }
} 
