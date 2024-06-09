<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
    
        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated',
            ], 401);
        }
            
        $accessToken = $request->bearerToken();
    
        return response()->json([
            'user' => $user,           
            'message' => 'User profile retrieved successfully',
        ], 200);
    }
    
    
  
    public function update_personalinfo(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated',
            ], 401);
        }
    
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'mobile_no' => ['integer', Rule::unique('users')->ignore($user->id)],
            
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $dataToUpdate = $request->only(['name', 'email', 'mobile_no', 'city']);
    
       
        if (empty(array_filter($dataToUpdate))) {
            return response()->json([
                'message' => 'No data provided for update',
            ], 400);
        }
    
        $user->update($dataToUpdate);
    
        return response()->json([
            'data' => $user,
            'message' => 'User profile and personal data updated successfully',
        ], 200);
    }
   
}

 

  