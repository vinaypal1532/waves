<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class BannerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
               
            $banner = Banner::all(); 
            
            return view('banner.banner', ['banners' => $banner]);
          
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
        return view('banner.add_banner');
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

            'title' => 'required',
           
            'image_path'=> 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',

        ]);
        
        $imageName = $request->file('image_path')->hashName();
       
        $request->file('image_path')->move(public_path('images'), $imageName);
    
        $banner = Banner::create([
            'title' => $validatedData['title'],
            'image_path' => $imageName,
         
            'status' => $validatedData['status'],
           
        ]);
                
        return redirect()->route('banner')->with('success', 'Banner Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id); 
    
        return view('banner.edit_banner', compact('banner')); 
    }
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);

        $validatedData = $request->validate([
            'title' => 'required',
           
            'status' => 'required',
            
        ]);

        $banner->update([
            'title' => $validatedData['title'],
          
            'status' => $validatedData['status'],
            
        ]);
    
      
        if ($request->hasFile('image_path')) {
          
            if ($banner->image_path && file_exists(public_path('images/' . $banner->image_path))) {
                unlink(public_path('images/' . $banner->image_path));
            }    
           
            $imageName = time() . '.' . $request->file('image_path')->extension();
            $request->file('image_path')->move(public_path('images'), $imageName);    
           
            $banner->update(['image_path' => $imageName]);
        }

        return redirect()->route('banner')->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($banner)
    {
      
        $banner = Banner::find($banner);
                    
        if (empty($banner)) {
     
            return redirect()->back()->with('error', 'Event not found.');
        }    
      
        $imageName = $banner->image_path;    
       
        $banner->delete();    
       
        if (!empty($imageName) && file_exists(public_path('images/' . $imageName))) {
            unlink(public_path('images/' . $imageName));
        }    
       
        return redirect()->back()->with('status', 'Banner Image deleted successfully.');

    }
}
