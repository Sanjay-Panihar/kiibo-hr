<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public function getLeaveTypeNameAttribute()
    {
        $types = [
            1 => 'Sick Leave',
            2 => 'Earned Leave',
            3 => 'Casual Leave',
            4 => 'Optional Leave',
            5 => 'Compensatory Leave',
            6 => 'Short Leave',
            7 => 'Optional Holiday'
        ];

        return $types[$this->leave_type] ?? 'Unknown';
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
