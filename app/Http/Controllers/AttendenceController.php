<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    public function index()
    {
        return view('admin.attendence.index');
    }
}
