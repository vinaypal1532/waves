<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Auth;

class BatechController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
               
            $batch = Batch::all(); 
            
            return view('batch.index', ['service' => $batch]);
          
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $domain = Domain::all();   
        return view('batch.upload',['domains' => $domain]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'title' => 'required|string',
            'domain_id' => 'required|exists:domains,id',
            'duration' => 'required|string',
            'rate' => 'required|numeric',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp',
            'details' => 'nullable|string',
            'status' => 'required|in:1,0,2',
            'start_date' => 'required',
            
        ]);

        $imageName = $request->file('image')->hashName(); 
       
        $request->file('image')->move(public_path('images/batches'), $imageName);      
      
          $service =  Batch::create([
            'title' => $validatedData['title'],
            'domain_id' => $validatedData['domain_id'],
            'duration' => $validatedData['duration'],
            'rate' => $validatedData['rate'],
            'image' => $imageName,
            'details' => $validatedData['details'],
            'status' => $validatedData['status'],
            'start_date' => $validatedData['start_date'],
        ]);
                     
        
        return redirect()->route('batches')->with('success', 'Batch Created Successfully');
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
        $domains = Domain::all(); // Retrieve all domains
        $batch = Batch::findOrFail($id); // Find the batch by ID
    
        return view('batch.edit', compact('batch', 'domains')); // Pass both batch and domains to the view
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);
    
        $validatedData = $request->validate([
            'title' => 'required|string',
            'domain_id' => 'required|exists:domains,id',
            'duration' => 'required|string',
            'rate' => 'required|numeric',
            'image' => 'nullable|file|mimes:jpg,jpeg,png',
            'details' => 'nullable|string',
            'status' => 'required|in:1,0,2',
        ]);
    
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($batch->image && file_exists(public_path('images/batches/' . $batch->image))) {
                unlink(public_path('images/batches/' . $batch->image));
            }
    
            // Upload the new image
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/batches'), $imageName);
    
            // Update the image path in the validated data
            $validatedData['image'] = $imageName;
        }
    
        $batch->update($validatedData);
    
        return redirect()->route('batches')->with('success', 'Batch updated successfully.');
    }
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      
        $batch = Studymaterial::find($id);
        
      
        if (!$batch) {
            return redirect()->route('event')->with('error', 'Event Image not found.');
        }        
       
        if ($batch->file_path && File::exists(public_path('images/batches/' . $batch->file_path))) {
            File::delete(public_path('images/batches/' . $batch->file_path));
        }
            
        $batch->delete();   
       
        return redirect()->route('event')->with('success', 'Event Image deleted successfully.');
    }
    
    
}
