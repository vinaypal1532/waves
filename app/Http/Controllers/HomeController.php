<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Domain;
use App\Models\User;
use App\Models\Contact;
use App\Services\SmsService;
use App\Models\Jobcreate;
use App\Models\Question;

use App\Models\Report;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $smsService;
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $smsResult = $this->smsService->checkBalance();     
    
        if ($smsResult['status'] != 1) {
            return response([
                'message' => 'Failed to check balance',
                'error_details' => $smsResult['error_message'] ?? 'Unknown error',
            ]);
        }
    
        $balance = $smsResult['balance'];
        $balance = str_replace('trans1:', '', $balance);

        $topic = Topic::count();
        $domain = Domain::count();
        $user = User::count();
        $contact = Contact::count();
        $job = Jobcreate::count();
        $ques = Question::count();
        $report = Report::count();
        return view('home',  
        ['topic' => $topic,     
        'domain' => $domain,
        'contact' => $contact,
        'user' => $user,
        'smscount' => $balance,
        'jobs' => $job,
        'ques' => $ques,
        'report' => $report,
    ]);
    }


    function test_balance()
    {
        
        $smsResult = $this->smsService->checkBalance();     
    
        if ($smsResult['status'] != 1) {
            return response([
                'message' => 'Failed to check balance',
                'error_details' => $smsResult['error_message'] ?? 'Unknown error',
            ]);
        }
    
        $balance = $smsResult['balance'];
    
        return response([
            'message' => 'Balance checked successfully',
            'status' => $smsResult['status'],
            'balance' => $balance,
        ]);
    }
    
}
