<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

use App\Services\SmsService;

class UserAuthController extends Controller
{
    protected $smsService;
    protected $otp;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',      
                'mobile_no' => 'required|numeric|unique:users',         
               
            ]);
            $requirePostsCount =  User::where('role' , 'user')->count();
            $unique_id = 'WAVES' . str_pad($requirePostsCount + 1, 5, '0', STR_PAD_LEFT);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'user',
                'mobile_no'=> $request->mobile_no,
                'password' => Hash::make(12345),
                'status' => 1,           
                'unique_id' => $unique_id,
            ]);    
    
            $token = $user->createToken('api-token')->plainTextToken;   
        
            return response()->json(['token' => $token, 'message' => 'Registration successful']);
            
        } catch (ValidationException $e) {
       
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
      
    
        public function login(Request $request)
        {
         try{
               $data = $request->validate([
                'mobile_no' => 'required|numeric',
            ]);
        
            $user = User::where('mobile_no', $data['mobile_no'])->first();
        
            if (!$user) {
                return response(['message' => 'User not found']);
            }           
           
            $otpSecret = rand(1000, 9999);
        
            $user->update([
                'otp' => $otpSecret,
            ]);    
           
            $smsResult = $this->smsService->sendSms(
                $user->mobile_no,            
                "Dear User, Your Login OTP is $otpSecret for BookAdSpace. Thanks Team Waves"
            );
        
            if ($smsResult['status'] != 1) {
                return response([
                    'message' => 'Failed to send OTP via SMS',
                    'error_details' => $smsResult['error_message'] ?? 'Unknown error',
                    'status' => $smsResult['status'], 
                ]);
            }
        
            return response([
                'message' => 'OTP sent successfully',
                'status' => $smsResult['status'], 
                'units' => $smsResult['units'],   
                'smsid' => $smsResult['smsid'],   
                // 'verify_url' => route('verify', ['mobile_no' => $user->mobile_no]),
            ]);
        }
        catch (ValidationException $e) {
       
            return response()->json(['errors' => $e->errors()], 422);
        }
        }
    
        public function verify(Request $request)
        {
            try {
                $data = $request->validate([
                    'mobile_no' => 'required|numeric',
                    'otp' => 'required|numeric',
                ]);
        
                $user = User::where('mobile_no', $data['mobile_no'])
                    ->where('otp', $data['otp'])
                    ->first();
        
                if (!$user) {
                    return response(['message' => 'Invalid OTP'], 422);
                }
        
                // Update user verification status
                $user->update([
                    'is_verified' => 1,
                ]);
        
                // Retrieve user profile
                $profile = $user->id;
        
                // Create access token
                $token = $user->createToken('mobile_app_token')->plainTextToken;
        
                return response([
                    'message' => 'OTP verification successful',
                    'access_token' => $token,
                    'profile' => $profile,
                ]);
            } catch (ValidationException $e) {
                return response()->json(['errors' => $e->errors()], 422);
            }
        }

        public function post_inquery(Request $request)
        {
            try {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',      
                    'mobile_no' => 'required|numeric',         
                   
                ]);
                        
                $user = Contact::create([
                    'name' => $request->name,
                    'email' => $request->email,                  
                    'mobile_no'=> $request->mobile_no,
                    'city' => $request->city,
                    'c_name' => $request->c_name,                
                    'qualification' => $request->qualification,
                    'c_location' => $request->c_location,
                    'y_passing' => $request->y_passing,
                    'interested' => $request->interested,
                    'details'=>'',
                ]);            
                            
                return response()->json(['message' => 'Inquery Submit successful']);
                
            } catch (ValidationException $e) {
           
                return response()->json(['errors' => $e->errors()], 422);
            }
        }


        
}
