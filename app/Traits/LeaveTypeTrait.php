<?php

namespace App\Traits;

trait LeaveTypeTrait{

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
        $leaveType = $this->leave_type ?? $this->type ?? null;
        
        return isset($types[$leaveType]) ? $types[$leaveType] : 'Unknown';

    }
}