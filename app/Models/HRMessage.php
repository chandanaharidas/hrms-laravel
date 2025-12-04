<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id',
        'subject',
        'message'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
} 