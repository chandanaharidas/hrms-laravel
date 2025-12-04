<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'employees';

    // Primary key column (your table uses emp_id, not id)
    protected $primaryKey = 'emp_id';

    // Because emp_id is a string like Emp003 (not an integer)
    public $incrementing = false;
    protected $keyType = 'string';

    // Columns that can be mass-assigned
    protected $fillable = [
        'emp_id',
        'user_id',
        'name',
        'email',
        'personal_email',
        'phone',
        'address',
        'department',
        'designation',
        'profile_picture',
        'join_date',
        'salary',
        'status',
        'resignation_date',
    ];

    /**
     * Relationship with users table
     * (Each employee belongs to one user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with leave table
     * (One employee can have many leaves)
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'emp_id', 'emp_id');
    }

    /**
     * Relationship with attendance table
     * (One employee can have many attendance records)
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'emp_id', 'id');
    }
} 