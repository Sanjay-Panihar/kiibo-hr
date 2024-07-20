<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\EducationDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\UserDetails;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;
use ErrorException;


class UserDetailsController extends Controller
{
    public function index()
    {
       try {
        $user = User::with(['userDetails', 'certification', 'educationDetails'])->find(Auth::user()->id);

        $skills = $user->userDetails ? json_decode($user->userDetails->skills, true) ?? [] : [];
        $hobbies = $user->userDetails ? json_decode($user->userDetails->hobbies, true) ?? [] : [];
        $educationDetails = $user->educationDetails ? json_decode($user->educationDetails, true) ?? [] : [];
        $certifications = $user->certification ? json_decode($user->certification, true) ?? [] : [];
        $experienceDetails = $user->experienceDetails ? json_decode($user->experienceDetails, true) ?? [] : [];

        return view('admin.user-details.index', compact('user', 'skills', 'hobbies', 'educationDetails', 'certifications', 'experienceDetails'));
       } catch (Exception | ErrorException $th) {
           return redirect()->back()->with('error', $th->getMessage());
       }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'govt_id' => 'nullable|integer|in:1,2,3,4,5',
                'govt_id_no' => 'required_with:govt_id|string|max:20',
                'skills' => 'nullable|array',
                'skills.*' => 'nullable|integer',
                'hobbies' => 'nullable|array',
                'hobbies.*' => 'nullable|integer',
                'about_me' => 'nullable|string',
                'achievements' => 'nullable|string',
                'current_address' => 'nullable|string',
                'permanent_address' => 'nullable|string',
                'education_details' => 'nullable|array',
                'education_details.*.degree' => 'nullable|string',
                'education_details.*.institute' => 'nullable|string',
                'education_details.*.start_year' => 'nullable|integer',
                'education_details.*.end_year' => 'nullable|integer|gte:education_details.*.start_year',
                'certifications' => 'nullable|array',
                'certifications.*.certification' => 'nullable|string',
                'certifications.*.institute' => 'nullable|string',
                'certifications.*.year' => 'nullable|integer|gte:certifications.*.year',
                'certifications.*.score' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first(), 'status' => 'false']);
            } else {
                $userId = Auth::id();

                $userDetails = UserDetails::updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'govt_id' => $request->govt_id,
                        'govt_id_no' => $request->govt_id_no,
                        'skills' => json_encode($request->skills),
                        'hobbies' => json_encode($request->hobbies),
                        'about_me' => $request->about_me,
                        'achievements' => $request->achievements,
                        'current_address' => $request->current_address,
                        'permanent_address' => $request->permanent_address,
                        'created_by' => $userId,
                    ]
                );

                if (!$userDetails) {
                    DB::rollBack();
                    return response()->json(['message' => 'Failed to save user details', 'status' => 'false']);
                }

                // Handle education details
                if ($request->has('education_details')) {
                    // Delete existing records
                    EducationDetails::where('user_id', $userDetails->user_id)->delete();

                    // Insert new records
                    foreach ($request->education_details as $education) {
                        if (isset($education['degree'], $education['institute'], $education['start_year'], $education['end_year'])) {
                            EducationDetails::create([
                                'user_id' => $userId,
                                'degree' => $education['degree'],
                                'institute' => $education['institute'],
                                'start_year' => $education['start_year'],
                                'end_year' => $education['end_year']
                            ]);
                        }
                    }
                }

                // Handle certifications
                if ($request->has('certifications')) {
                    // Delete existing records
                    Certification::where('user_id', $userDetails->user_id)->delete();

                    // Insert new records
                    foreach ($request->certifications as $certification) {
                        if (isset($certification['certification'], $certification['institute'], $certification['year'], $certification['score'])) {
                            Certification::create([
                                'user_id' => $userId,
                                'certification' => $certification['certification'],
                                'institute' => $certification['institute'],
                                'year' => $certification['year'],
                                'score' => $certification['score']
                            ]);
                        }
                    }
                }

                DB::commit();
                return response()->json(['message' => 'User details updated successfully', 'status' => 'true']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(), 'status' => 'false']);
        }
    }



}
