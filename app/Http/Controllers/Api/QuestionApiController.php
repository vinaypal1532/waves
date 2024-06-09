<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Topic;
use App\Models\Option;
use App\Models\Question;
use App\Models\Report;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class QuestionApiController extends Controller
{
    function get_domain()
    {
        $domains = Domain::where('status', 1)->get();
        
        if ($domains->isEmpty()) {
            return response()->json([
                'message' => 'Domain Not Found',
            ], 404);
        } else {
            return response()->json([
                'data' => $domains,
                'message' => 'Domain data retrieved successfully',
            ], 200);
        }
    }

    public function get_topic($id = null)
    {        
        if ($id) {
           
            $topic = Topic::where('domain_id', $id)->where('status', 1)->get();  

            if ($topic->isEmpty()) {
                return response()->json([
                    'message' => 'Topics Not Found',
                ], 404);
            } else {
            if ($topic) {
                return response()->json([
                    'data' => $topic,
                    'message' => 'Topic data retrieved successfully',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Topic Not Found',
                ], 404);
            }
        }
        } else {
        
            $topics = Topic::where('status', 1)->get();
    
            // Check if any topics were found
            if ($topics->isEmpty()) {
                return response()->json([
                    'message' => 'Topics Not Found',
                ], 404);
            } else {
                return response()->json([
                    'data' => $topics,
                    'message' => 'Topic data retrieved successfully',
                ], 200);
            }
        }
    }
    public function get_question($id)
    {
        
        $ques = Question::where('topic_id', $id)->with('options')->get();
      
        if ($ques->isEmpty()) {
            return response()->json([
                'message' => 'Questions Not Found',
            ], 404);
        } else {
            return response()->json([
                'data' => $ques,
                'total_question'=> $ques->count(),
                'total_marks'=> $ques->count() * 1,
                'message' => 'Questions data retrieved successfully',
            ], 200);
        }
    }

    public function ques_Data(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|integer',
                'max_mark' => 'required',
                'get_mark' => 'required',
                'percent' => 'required|numeric',
                'topic_id' => 'required|numeric',
                'taken_time' => 'required',
            ]);
    
            $report = Report::create([
                'user_id' => $validated['user_id'],
                'max_mark' => $validated['max_mark'],
                'get_mark' => $validated['get_mark'],
                'percent' => $validated['percent'],
                'topic_id' => $validated['topic_id'],
                'taken_time' => $validated['taken_time'],
            ]);
    
            return response()->json(['message' => 'Report Submit successful']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    function get_reports($id)
    {
        $reports = Report::where('user_id', $id)->with('topic')->get();
    
        if ($reports->isEmpty()) {
            return response()->json([
                'message' => 'Test Reports Not Found',
            ], 404);
        } else {
            $data = $reports->map(function ($report) {
                return [
                    'id' => $report->id,
                    'user_id' => $report->user_id,
                    'max_mark' => $report->max_mark,
                    'get_mark' => $report->get_mark,
                    'percent' => $report->percent,
                    'topic_name' => $report->topic ? $report->topic->name : 'No Topic',
                    'taken_time' => $report->taken_time,
                    'created_at' => $report->created_at,
                ];
            });
    
            return response()->json([
                'data' => $data,
                'message' => 'Test Reports retrieved successfully',
            ], 200);
        }
    }

    public function get_reports_home()
    {
      
        $reports = Report::with('topic')
                         ->orderBy('created_at', 'desc')
                         ->take(10)
                         ->get();
    
       
        if ($reports->isEmpty()) {
            return response()->json([
                'message' => 'Test Reports Not Found',
            ], 404);
        } else {
          
            $data = $reports->map(function ($report) {
                return [
                    'id' => $report->id,
                    'user_id' => $report->user_id,
                    'max_mark' => $report->max_mark,
                    'get_mark' => $report->get_mark,
                    'percent' => $report->percent,
                    'topic_name' => $report->topic ? $report->topic->name : 'No Topic',
                    'taken_time' => $report->taken_time,
                    'created_at' => $report->created_at,
                ];
            });
    
            return response()->json([
                'data' => $data,
                'message' => 'Test Reports retrieved successfully',
            ], 200);
        }
    }

    public function get_user_avgreport($id)
    {
        $reports = Report::where('user_id', $id)->get();
    
        if ($reports->isEmpty()) {
            return response()->json([
                'message' => 'Test Reports Not Found',
            ], 404);
        }
    
        // Calculate average score
        $totalScore = $reports->sum('get_mark');
        $averageScore = $totalScore / $reports->count();
    
        // Get maximum score
        $test_attempt = $reports->count();
    
        return response()->json([
            'average_score' => $averageScore,
            'test_attempt' => $test_attempt,
            'message' => 'Average score and test attempt retrieved successfully',
        ], 200);
    }

    
    
}
