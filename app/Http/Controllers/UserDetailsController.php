<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function index()
    {
        return view('admin.user-details.index');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $validator = validator($request->all(), [
                'education_details.*.degree' => 'required|string', // Validate each field in education details
                'education_details.*.institute' => 'required|string',
                'education_details.*.start_year' => 'required|integer',
                'education_details.*.end_year' => 'nullable|integer',
                'certifications.*.certification' => 'required|string', // Validate each field in certifications
                'certifications.*.institute' => 'required|string',
                'certifications.*.year' => 'required|integer',
                'certifications.*.score' => 'nullable|string',
            ]);
            if($validator->fails()){
                return response()->json(['message' => $validator->errors(), 'status' => 'false']);
            } else {

                return response()->json(['message' => 'User details added successfully', 'status' => 'true']);
            }
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage(), 'status' => 'false']);
        }
    }
}
