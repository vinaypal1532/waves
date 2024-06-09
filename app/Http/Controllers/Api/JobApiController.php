<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Topic;
use App\Models\Option;
use App\Models\Jobcreate;
use App\Models\Jobapply;
use App\Models\Usercontact;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
class JobApiController extends Controller
{
    public function get_jobs()
    {

        $Jobcreate = Jobcreate::where('status', 1)->get();
        
        if ($Jobcreate->isEmpty()) {
            return response()->json([
                'message' => 'Jobs Not Found',
            ], 404);
        } else {
            return response()->json([
                'data' => $Jobcreate,
                'message' => 'Jobs data retrieved successfully',
            ], 200);
        }
    }

    public function get_jobdetails($id){
        
        $Jobcreate = Jobcreate::find($id);
        
        if (!$Jobcreate) {
            return response()->json([
                'message' => 'Jobs Not Found',
            ], 404);
        } else {
            return response()->json([
                'data' => $Jobcreate,
                'message' => 'Job Description data retrieved successfully',
            ], 200);
        }
    }

    public function post_job_data(Request $request)
    {

        try {
            $validated = $request->validate([
                'user_id' => 'required|integer',
                'job_id' => 'required',
               
            ]);
    
            $report = Jobapply::create([
                'user_id' => $validated['user_id'],                
                'job_id' => $validated['job_id'],
            ]);
    
            return response()->json(['message' => 'Job Apply successful']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

    }

    public function get_my_jobapply($id)
    {
        $Jobapplies = Jobapply::where('user_id', $id)
            ->join('jobcreates', 'jobapplies.job_id', '=', 'jobcreates.id')
            ->select(
                'jobapplies.id',
                'jobapplies.job_id',
                'jobcreates.title',
                'jobcreates.c_name',
                'jobcreates.contact_person',
                'jobcreates.no_position',
                'jobcreates.domain',
                'jobcreates.email',
                'jobcreates.exp',
                'jobcreates.mobile_no',
                'jobcreates.details'
            )
            ->get();
        
        if ($Jobapplies->isEmpty()) {
            return response()->json([
                'message' => 'Apply Jobs Not Found',
            ], 404);
        } else {
            return response()->json([
                'data' => $Jobapplies,
                'message' => 'Apply data retrieved successfully',
            ], 200);
        }
    }

    public function user_contact(Request $request)
    {
        try {         
            $validated = $request->validate([
                'userdata' => 'required',
            ]);    
    
            $userContact = Usercontact::create([
                'userdata' => $validated['userdata'],          
            ]);
    
            return response()->json([
                'message' => 'User Contacts submitted successfully',
                'data' => $userContact
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while submitting user contacts'], 500);
        }
    }
    
    

}
