<?php

namespace App\Http\Controllers;
use App\Models\Usercontact;
use Illuminate\Http\Request;

class UsercontactController extends Controller
{
    public function index()
    {
        $usercontact = Usercontact::all();
        return view('user_contact', ['usercontact' => $usercontact]);
    }
    
}
