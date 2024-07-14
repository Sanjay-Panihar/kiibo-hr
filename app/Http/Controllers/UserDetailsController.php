<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function index()
    {
        return view('admin.user-details.index');
    }
}
