<?php

namespace App\Http\Controllers;

use App\Models\Jobcreate; 
use App\Models\Domain;
use App\Models\Jobapply;
use Illuminate\Http\Request;

class JobcreateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Jobcreate::all();
        return view('job.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $domain = Domain::all();
        return view('job.upload',['domains' => $domain]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'c_name' => 'required',
            'exp' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'contact_person' => 'required',
            'details' => 'required',
            'domain' => 'required',
            'location' => 'nullable|string',
            'is_c_name' => 'nullable',
            'is_email' => 'nullable',
            'is_mobile' => 'nullable',
            'is_contact_person' => 'nullable',
            
        ]);

      
        $randomNumber = mt_rand(1000, 9999); 
        $unique_id = 'WAVES-' . $randomNumber;
    
        $jobCreate = Jobcreate::create([
            'domain' => $validatedData['domain'],
            'title' => $validatedData['title'],
            'c_name' => $validatedData['c_name'],
            'exp' => $validatedData['exp'],
            'mobile_no' => $validatedData['mobile_no'],
            'email' => $validatedData['email'],
            'contact_person' => $validatedData['contact_person'],
            'details' => $validatedData['details'],
            'location' => $validatedData['location'] ?? null,
            'is_c_name' => $request->input('is_c_name', false),
            'is_email' => $request->input('is_email', false),
            'is_mobile' => $request->input('is_mobile', false),
            'is_contact_person' => $request->input('is_contact_person', false),
            'status' => $request->input('status'),
            'no_position' => $request->input('no_position'),
            'end_data' => $request->input('end_data'),
            'job_id' => $unique_id
        ]);
    
        return redirect()->route('job')->with('success', 'Job uploaded successfully.');
    }
    

    /**
     * 
     * 
     * Display the specified resource.
     */
    public function show(Jobcreate $jobcreate)
    {
        $jobs = Jobapply::all();
        return view('job.show', ['jobs' => $jobs]);
    }

   
    public function edit($id)
    {
        $domains = Domain::all();
        $jobs = Jobcreate::find($id); 
        return view('job.edit',['domains' => $domains,'job'=>$jobs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->merge([
        'is_c_name' => $request->has('is_c_name'),
        'is_email' => $request->has('is_email'),
        'is_mobile' => $request->has('is_mobile'),
        'is_contact_person' => $request->has('is_contact_person'),
    ]);

    $validatedData = $request->validate([
        'title' => 'required',
        'c_name' => 'required',
        'exp' => 'required',
        'mobile_no' => 'required',
        'email' => 'required|email',
        'contact_person' => 'required|string',
        'details' => 'required',
        'domain' => 'required|integer',
        'location' => 'nullable|string',
        'is_c_name' => 'required|boolean',
        'is_email' => 'required|boolean',
        'is_mobile' => 'required|boolean',
        'is_contact_person' => 'required|boolean',
        'job_id' => 'required',
       
    ]);

    $job = Jobcreate::findOrFail($id);
    $job->update([
        'domain' => $validatedData['domain'],
        'title' => $validatedData['title'],
        'c_name' => $validatedData['c_name'],
        'exp' => $validatedData['exp'],
        'mobile_no' => $validatedData['mobile_no'],
        'email' => $validatedData['email'],
        'contact_person' => $validatedData['contact_person'],
        'details' => $validatedData['details'],
        'location' => $validatedData['location'] ?? null,
        'is_c_name' => $validatedData['is_c_name'],
        'is_email' => $validatedData['is_email'],
        'is_mobile' => $validatedData['is_mobile'],
        'is_contact_person' => $validatedData['is_contact_person'],
        'status' =>  $request->input('status'),
        'no_position' => $request->input('no_position'),
        'end_data' => $request->input('end_data'),
        'job_id' => $validatedData['job_id']
    ]);

    return redirect()->route('job')->with('success', 'Job updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jobcreate $jobcreate)
    {
        $jobcreate->delete();

        return redirect()->route('job')->with('success', 'Job deleted successfully.');
    }
}
