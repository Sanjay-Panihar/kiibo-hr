<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyTeamController extends Controller
{
    public function index()
    {
        return view('admin.my-team.index');
    }
}
