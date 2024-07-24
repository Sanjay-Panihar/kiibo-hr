<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function setFullNameAttribute($value)
    {
        $this->attributes['name'] = trim($this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name);
    }
}
