<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\QuestionApiController;
use App\Http\Controllers\Api\JobApiController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\BatchapiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test_balance',[UserAuthController::class,'test_balance']);
Route::post('api_register', [UserAuthController::class, 'register']);
Route::post('api_login', [UserAuthController::class, 'login']);
Route::post('verify', [UserAuthController::class,'verify']);
Route::post('api_inquery', [UserAuthController::class,'post_inquery']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('api_profile', [ProfileController::class, 'index']);
    Route::get('api_logout', [UserAuthController::class,'logout']);
});

Route::get('api_domain', [QuestionApiController::class,'get_domain']);
Route::get('api_topic/{id}', [QuestionApiController::class,'get_topic']);
Route::get('api_question/{id}', [QuestionApiController::class,'get_question']);
Route::get('api_jobs', [JobApiController::class,'get_jobs']);
Route::get('api_job_detail/{id}', [JobApiController::class,'get_jobdetails']);
Route::post('api_job_data', [JobApiController::class, 'post_job_data']);

Route::post('get_report_home', [QuestionApiController::class, 'get_reports_home']);
Route::post('api_report_submit', [QuestionApiController::class, 'ques_Data']);
Route::get('get_avgreport/{id}', [QuestionApiController::class,'get_user_avgreport']);

Route::get('api_report/{id}', [QuestionApiController::class,'get_reports']);
Route::get('api_batches', [BatchapiController::class,'index']);
Route::get('api_banner', [BatchapiController::class,'get_banner']);
Route::get('api_my_jobally/{id}', [JobApiController::class,'get_my_jobapply']);
Route::post('api_usercontact', [JobApiController::class,'user_contact']);
