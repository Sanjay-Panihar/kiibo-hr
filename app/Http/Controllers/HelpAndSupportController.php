<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpAndSupportController extends Controller
{
    public function index()
    {
        return view('admin.help-and-support.index');
    }
}
