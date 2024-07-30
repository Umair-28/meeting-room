<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{

    public function showLogin(){
        return view('login');
    }

    public function login(Request $request){

        $rules = [
            'email' => 'required|string',
            'password' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email',$request->email)->first();
        
        if($user){
            
            if($user->email == $request->email){
                if(Hash::check($request->password, $user->password)){
                    session()->put('admin', $user);
                    return redirect()->route('dashboard');
                }

            }

            // return redirect('/admin/login');
            return redirect('/admin/login')->withErrors(['error' => 'Invalid Credentials'])->withInput();

        }
        return redirect('/admin/login')->withErrors(['error' => 'Invalid Credentials, Try again'])->withInput();

    }

    public function dashboard(){
     
        $users = User::where('role','!=','admin')->get();
       
        return view('admin', compact('users'));
    }

    public function logout(Request $request)
    {
        // Clear the session data
        $request->session()->flush();

        // Redirect to login page
        return redirect('/admin/login')->with('success', 'You have been logged out successfully.');
    }
}
