<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\JobcreateController;
use App\Http\Controllers\StudymaterialController;
use App\Http\Controllers\BatechController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\EventimageController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\UsercontactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['web', 'user-access:admin'])->group(function () {
    
    Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
 
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('user-list', [UserController::class, 'get_user'])->name('user-list');
Route::get('test-report', [UserController::class, 'get_report'])->name('test-report');
Route::delete('/reports/{report}', [UserController::class, 'softDelete'])->name('delete_report');
Route::get('contact-list', [UserController::class, 'get_contact'])->name('contact-list');

Route::get('domain', [DomainController::class, 'index'])->name('domain');
Route::get('add_domain', [DomainController::class, 'create'])->name('add_domain');
Route::post('add_domainData', [DomainController::class, 'store'])->name('add_domainData'); 
Route::get('domain_edit/{id}', [DomainController::class, 'edit'])->name('domain_edit');
Route::put('updateDomain/{id}', [DomainController::class, 'update'])->name('updateDomain');
Route::get('domain_delete/{id}', [DomainController::class, 'destroy'])->name('domain_delete');

Route::get('topic', [TopicController::class, 'index'])->name('topic');
Route::get('add_topic', [TopicController::class, 'create'])->name('add_topic');
Route::post('add_topicData', [TopicController::class, 'store'])->name('add_topicData'); 
Route::get('topic_edit/{id}', [TopicController::class, 'edit'])->name('topic_edit');
Route::put('updateTopic/{id}', [TopicController::class, 'update'])->name('updateTopic');
Route::get('topic_delete/{id}', [TopicController::class, 'destroy'])->name('topic_delete');

Route::get('question', [QuestionController::class, 'index'])->name('question');
Route::get('/add_question', [QuestionController::class, 'create'])->name('add_question');
Route::post('/upload', [QuestionController::class, 'store'])->name('upload');
Route::get('question_edit/{question}', [QuestionController::class, 'edit'])->name('question_edit');
Route::put('updateQuestion/{id}', [QuestionController::class, 'update'])->name('updateQuestion');
Route::get('question_delete/{question}', [QuestionController::class, 'destroy'])->name('question_delete');

Route::get('/add_job', [JobcreateController::class, 'create'])->name('add_job');
Route::get('job', [JobcreateController::class, 'index'])->name('job');
Route::post('/job_upload', [JobcreateController::class, 'store'])->name('job_upload');
Route::get('job_edit/{job}', [JobcreateController::class, 'edit'])->name('job_edit');
Route::get('job_delete/{jobcreate}', [JobcreateController::class, 'destroy'])->name('job_delete');

Route::post('/updateJob/{id}', [JobcreateController::class, 'update'])->name('updateJob');
Route::get('job-applied-list', [JobcreateController::class, 'show'])->name('job-applied-list');

Route::get('/add_studymaterial', [StudymaterialController::class, 'create'])->name('add_studymaterial');
Route::get('studymaterial', [StudymaterialController::class, 'index'])->name('studymaterial');
Route::post('/submit_material', [StudymaterialController::class, 'store'])->name('submit_material');
Route::get('study_delete/{studymaterial}', [StudymaterialController::class, 'destroy'])->name('study_delete');
Route::get('study_edit/{studymaterial}', [StudymaterialController::class, 'edit'])->name('study_edit');
Route::post('studymaterials_update/{studymaterial}', [StudymaterialController::class, 'update'])->name('studymaterials_update');

Route::get('/add_batch', [BatechController::class, 'create'])->name('add_batch');
Route::get('batches', [BatechController::class, 'index'])->name('batches');
Route::post('/batch_upload', [BatechController::class, 'store'])->name('batch_upload');
Route::get('batch_edit/{id}', [BatechController::class, 'edit'])->name('batch_edit');
Route::put('/batches/{id}', [BatechController::class, 'update'])->name('update_batch');
Route::get('batch_delete/{batch}', [BatechController::class, 'destroy'])->name('batch_delete');


Route::get('video', [VideoController::class, 'index'])->name('video');
Route::get('/add_video', [VideoController::class, 'create'])->name('add_video');
Route::post('/submit_video', [VideoController::class, 'store'])->name('submit_video');

Route::get('event', [EventimageController::class, 'index'])->name('event');
Route::get('/add_event', [EventimageController::class, 'create'])->name('add_event');
Route::post('/submit_event', [EventimageController::class, 'store'])->name('submit_event');
 
Route::get('event_edit/{id}', [EventimageController::class, 'edit'])->name('event_edit');
Route::get('event_delete/{id}', [EventimageController::class, 'destroy'])->name('event_delete');
 Route::post('event_update/{event}', [EventimageController::class, 'update'])->name('event_update');


 Route::get('banner', [BannerController::class, 'index'])->name('banner');
 Route::get('add_banner', [BannerController::class, 'create'])->name('add_banner');
 Route::post('add_bannerData', [BannerController::class, 'store'])->name('add_bannerData');
 Route::get('banner_edit/{id}', [BannerController::class, 'edit'])->name('banner_edit');
 Route::put('updateBanner/{id}', [BannerController::class, 'update'])->name('updateBanner');
 Route::get('banner_delete/{id}', [BannerController::class, 'destroy'])->name('banner_delete');

 Route::get('user-contact', [UsercontactController::class, 'index'])->name('user-contact');
});

Auth::routes();