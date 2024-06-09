<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Domain;
use Illuminate\Http\Request;
use Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
               
            $topic = Topic::all(); 
            
            return view('topic', ['service' => $topic]);
          
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $domain = Domain::all();

        return view('add_topic',['domains' => $domain]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $validatedData = $request->validate([

            'name' => 'required',   
            'status' => 'required',
            'image' => 'required',
            'domain_id' => 'required',
        ]);

        $imageName = $request->file('image')->hashName(); 
       
        $request->file('image')->move(public_path('images'), $imageName);      
      
          $service = Topic::create([
               'name' => $validatedData['name'],
               'image' => $imageName,               
               'status' => $validatedData['status'],
               'domain_id' => $validatedData['domain_id'],
           ]);
                     
        
        return redirect()->route('topic')->with('status', 'Topic Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $topic = Topic::find($id); 

        $domain = Domain::all();

        return view('edit_topic', compact('topic','domain')); 
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $serviceapi = Topic::find($id);

        $validatedData = $request->validate([
            'name' => 'required',   
            'status' => 'required',
            'domain_id' => 'required',
            
        ]);

        $serviceapi->update([
            'name' => $validatedData['name'],                 
            'status' => $validatedData['status'],
            'domain_id' => $validatedData['domain_id'],      
        ]);
    
      
        if ($request->hasFile('image')) {
          
            if ($serviceapi->image && file_exists(public_path('images/' . $serviceapi->image))) {
                unlink(public_path('images/' . $serviceapi->image));
            }    
           
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images'), $imageName);    
           
            $serviceapi->update(['image' => $imageName]);
        }

        return redirect()->route('topic')->with('success', 'Topic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Topic::find($id);
                    
        if (empty($service)) {
     
            return redirect()->back()->with('error', 'Event not found.');
        }    
      
        $imageName = $service->image;    
       
        $service->delete();    
       
        if (!empty($imageName) && file_exists(public_path('images/' . $imageName))) {
            unlink(public_path('images/' . $imageName));
        }    
       
        return redirect()->back()->with('status', 'Topic deleted successfully.');
    }
}
