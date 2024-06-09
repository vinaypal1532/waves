<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        return view('question.index', ['questions' => $questions]);
    }
    

    
    public function create()
    {
        $topics = Topic::all();
        return view('question.upload',['topics' => $topics]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'topic_id' => 'required|exists:topics,id',
            'type' => 'required|string|max:255',
            'result' => 'required',
            'options.*' => 'required|string|max:255',
        ]);
    
        $question = Question::create([
            'question' => $validatedData['question'],
            'topic_id' => $validatedData['topic_id'],
            'type' => $validatedData['type'],
            'result' => $validatedData['result'],
        ]);
    
        foreach ($validatedData['options'] as $optionText) {
            Option::create([
                'option' => $optionText,
                'question_id' => $question->id
            ]);
        }
    
        return redirect()->route('question')->with('success', 'Question uploaded successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($question)
    {
        $topics = Topic::all();
        $question = Question::find($question); 
        return view('question.edit',['topics' => $topics,'question'=>$question]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);

        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'topic_id' => 'required|exists:topics,id',
            'type' => 'required|string|max:255',
            'options.*' => 'required|string|max:255',
            'result' => 'required',
        ]);
    
        // Update the question
        $question->update([
            'question' => $validatedData['question'],
            'topic_id' => $validatedData['topic_id'],
            'type' => $validatedData['type'],
            'result' => $validatedData['result'],
        ]);
    
        // Update options
        foreach ($validatedData['options'] as $optionText) {
            // Find existing option or create new one
            Option::updateOrCreate(
                ['question_id' => $question->id, 'option' => $optionText],
                ['question_id' => $question->id, 'option' => $optionText]
            );
        }
    
        // Delete options that were removed
        Option::where('question_id', $question->id)
              ->whereNotIn('option', $validatedData['options'])
              ->delete();
    
        // Redirect the user with a success message
        return redirect()->route('question')->with('success', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('question')->with('success', 'Question deleted successfully.');
    }
}
