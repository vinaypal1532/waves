<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
               
            $serviceapi = Domain::all(); 
            
            return view('domain', ['service' => $serviceapi]);
          
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_domain');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'name' => 'required',   
            'status' => 'required',
            'image' => 'required',
        ]);

        $imageName = $request->file('image')->hashName(); 
       
        $request->file('image')->move(public_path('images'), $imageName);      
      
          $service = Domain::create([
               'name' => $validatedData['name'],
               'image' => $imageName,               
               'status' => $validatedData['status'],
              
           ]);
                     
        
        return redirect()->route('domain')->with('status', 'Domain Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serviceapi  $serviceapi
     * @return \Illuminate\Http\Response
     */
    public function show(Serviceapi $serviceapi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serviceapi  $serviceapi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Domain::find($id); 
    
        return view('edit_domain', compact('service')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serviceapi  $serviceapi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $serviceapi = Domain::find($id);

        $validatedData = $request->validate([
            'name' => 'required',   
            'status' => 'required',
       
            
        ]);

        $serviceapi->update([
            'name' => $validatedData['name'],                 
            'status' => $validatedData['status'],
            
        ]);
    
      
        if ($request->hasFile('image')) {
          
            if ($serviceapi->image && file_exists(public_path('images/' . $serviceapi->image))) {
                unlink(public_path('images/' . $serviceapi->image));
            }    
           
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images'), $imageName);    
           
            $serviceapi->update(['image' => $imageName]);
        }

        return redirect()->route('domain')->with('success', 'Domain updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serviceapi  $serviceapi
     * @return \Illuminate\Http\Response
     */
    public function destroy($serviceapi)
    {
     
        $service = Domain::find($serviceapi);
                    
        if (empty($service)) {
     
            return redirect()->back()->with('error', 'Event not found.');
        }    
      
        $imageName = $service->image;    
       
        $service->delete();    
       
        if (!empty($imageName) && file_exists(public_path('images/' . $imageName))) {
            unlink(public_path('images/' . $imageName));
        }    
       
        return redirect()->back()->with('status', 'Domain deleted successfully.');

    }

    
}
