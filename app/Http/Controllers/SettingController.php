<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }
    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                if (Hash::check($request->old_password, Auth::user()->password)) {
                    $user = User::find(Auth::user()->id);
                    $user->password = Hash::make($request->password);
                    $user->save();
                    return back()->with('success', 'Password changed successfully');
                } else {
                    return back()->with('error', 'Old password not matched');
                }
            }
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
    public function deleteAccount(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            $user->delete();
            return back()->with('message', 'Account deleted successfully');
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
