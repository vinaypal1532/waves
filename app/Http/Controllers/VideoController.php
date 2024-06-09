<?php

namespace App\Http\Controllers;

use App\Models\Studymaterial;
use App\Models\Domain;
use App\Models\Topic;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Studymaterial::where('type', 'video')->get();
        return view('video.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $domain = Domain::all();        
        $topic = Topic::all();        
        return view('video.upload',['domains' => $domain,'topics' => $topic]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string',
        'description' => 'required',
        'type' => 'required|string|in:iframe,video',      
        'file_path' => 'required_if:type,video|mimes:mp4,mp3,avi,mov,wmv,doc,docx,pdf',
        'domain_id' => 'required|exists:domains,id',
        'topic_id' => 'required|exists:topics,id',
    ]);

    if ($request->type == 'video') {
        $file = $request->file('file_path');
        $fileName = $file->hashName();
        $file->move(public_path('files/video'), $fileName);
        $filePath = 'files/video/' . $fileName;
    } else {
        $filePath = $request->iframe;
    }

    $jobCreate = Studymaterial::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'file_path' => $filePath,     
        'domain_id' => $validatedData['domain_id'],
        'topic_id' => $validatedData['topic_id'],
    ]);

    return redirect()->route('video')->with('success', 'Video uploaded successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
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
    
        return view('video.edit', ['studymaterial' => $studymaterial, 'domains' => $domains, 'topics' => $topics]);
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
        ]);

        return redirect()->route('studymaterial', $studymaterial->id)->with('success', 'Study Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
    }
}
