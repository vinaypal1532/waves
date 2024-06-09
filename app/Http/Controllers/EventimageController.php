<?php

namespace App\Http\Controllers;

use App\Models\Studymaterial;
use App\Models\Domain;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Auth;

class EventimageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
               
            $batch = Studymaterial::where('type', 'event')->get();
            
            return view('event.index', ['service' => $batch]);
          
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $domain = Domain::all();        
        $topic = Topic::all();        
        return view('event.upload',['domains' => $domain,'topics' => $topic]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'title' => 'required|string',          
            'description' => 'required',
            'file_path' => 'required|mimes:jpg,jpeg,png,webp',
            'domain_id' => 'required|exists:domains,id', 
            'topic_id' => 'required|exists:topics,id',          
            'status' => 'required|integer', 
        ]);

        $imageName = $request->file('file_path')->hashName(); 
       
        $request->file('file_path')->move(public_path('images/batches'), $imageName);      
      
          $service =  Studymaterial::create([
            'title' => $validatedData['title'],
            'domain_id' => $validatedData['domain_id'],
            'topic_id' => $validatedData['topic_id'],         
            'description' => $validatedData['description'],
            'file_path' => $imageName,
            'type' => 'event',
            'status' => $validatedData['status'],
        ]);
                     
        
        return redirect()->route('event')->with('success', 'Event Image Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $domains = Domain::all();
        $topics = Topic::all();
        $event = Studymaterial::findOrFail($id); // Find the batch by ID
        return view('event.edit', ['event' => $event, 'domains' => $domains, 'topics' => $topics]);
     
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $batch = Studymaterial::findOrFail($id);
    
        $validatedData = $request->validate([
            'title' => 'required|string',          
            'description' => 'required',
            'file_path' => 'nullable|mimes:jpg,jpeg,png,webp',
            'domain_id' => 'required|exists:domains,id', 
            'topic_id' => 'required|exists:topics,id',
            'status' => 'required|integer', 
        ]);
    
        if ($request->hasFile('file_path')) {
            // Delete the old image if it exists
            if ($batch->file_path && file_exists(public_path('images/batches/' . $batch->file_path))) {
                unlink(public_path('images/batches/' . $batch->file_path));
            }
    
            // Upload the new image
            $imageName = time() . '.' . $request->file('file_path')->extension();
            $request->file('file_path')->move(public_path('images/batches'), $imageName);
    
            // Update the image path in the validated data
            $validatedData['file_path'] = $imageName;
        }
    
        $batch->update($validatedData);
    
        return redirect()->route('event')->with('success', 'Batch updated successfully.');
    }
    
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      
        $batch = Studymaterial::find($id);
      
        if ($batch->file_path && File::exists(public_path('images/batches/' . $batch->file_path))) {
            File::delete(public_path('images/batches/' . $batch->file_path));
        }
    
        // Delete the batch record
        $batch->delete();
    
        return redirect()->route('event')->with('success', 'Event Image deleted successfully.');
    }
    
}
