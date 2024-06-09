<?php

namespace App\Http\Controllers;

use App\Models\Studymaterial;
use App\Models\Domain;
use App\Models\Topic;
use Illuminate\Http\Request;

class StudymaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Studymaterial::where('type', 'pdf')->get();
        return view('studymaterial.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $domain = Domain::all();        
        $topic = Topic::all();        
        return view('studymaterial.upload',['domains' => $domain,'topics' => $topic]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $validatedData = $request->validate([
            'title' => 'required|string',          
            'description' => 'required',
            'file_path' => 'required|mimes:doc,docx,pdf',
            'domain_id' => 'required|exists:domains,id', 
            'topic_id' => 'required|exists:topics,id', 
            'status' => 'required|integer', 
            
        ]);     
      
        $file = $request->file('file_path');
        $fileName = $file->hashName();
        $file->move(public_path('images/studymaterials'), $fileName);

        $jobCreate = Studymaterial::create([
          
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'file_path' => 'images/studymaterials/' . $fileName,
            'domain_id' => $validatedData['domain_id'],
            'topic_id' => $validatedData['topic_id'],
            'type' => 'pdf',
            'status' => $validatedData['status'],
        ]);
    
        return redirect()->route('studymaterial')->with('success', 'Study Material uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Studymaterial $studymaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Studymaterial $studymaterial)
    {
        $domains = Domain::all();
        $topics = Topic::all();
    
        return view('studymaterial.edit', ['studymaterial' => $studymaterial, 'domains' => $domains, 'topics' => $topics]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Studymaterial $studymaterial)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'file_path' => 'nullable|mimes:doc,docx,pdf',
            'domain_id' => 'required|exists:domains,id',
            'topic_id' => 'required|exists:topics,id',
            'status' => 'required|integer', 
        ]);

        // Check if a new file is uploaded
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = $file->hashName();
            $file->move(public_path('images/studymaterials'), $fileName);
            // Delete the old file
            if (file_exists(public_path($studymaterial->file_path))) {
                unlink(public_path($studymaterial->file_path));
            }
            $studymaterial->update([
                'file_path' => 'images/studymaterials/' . $fileName,
            ]);
        }

       
        $studymaterial->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'domain_id' => $validatedData['domain_id'],
            'topic_id' => $validatedData['topic_id'],
            'type' => 'pdf',
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('studymaterial', $studymaterial->id)->with('success', 'Study Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Studymaterial $studymaterial)
    {
        $studymaterial->delete();

        return redirect()->route('studymaterial')->with('success', 'studymaterial deleted successfully.');
    }
}
