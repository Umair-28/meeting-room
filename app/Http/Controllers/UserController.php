<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request){

     

        $rules = [
            'name' => 'required|string',
            'department' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->with('message',$validator->errors()->first());
        }

        $user = User::create([
            'name' => $request->name,
            'department' => $request->department
        ]);

        return redirect()->back();
    }

    public function update(Request $request){

        $user = User::find($request->id);
        if($user){
            $user->update($request->all());
            return redirect()->back();
        }
    }

    public function delete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
        }

        return redirect()->back();
    }
}
