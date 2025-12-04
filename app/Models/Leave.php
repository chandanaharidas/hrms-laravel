<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'leaves';

    protected $fillable = [
        'emp_id',
        'leave_type',
        'start_date',
        'end_date',
        'reason',
        'status',
        'remark',
        'total_days',
    ];

    // Relation with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'emp_id');
    }
} 

?>