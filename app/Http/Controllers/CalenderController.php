<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;

class CalenderController extends Controller
{
    public function showCalender(Request $request){

        $meetings = Meeting::all();
        foreach($meetings as $meeting){
            $meeting->participants = explode(',',$meeting->participants);
        }
        // dd($meetings);
        return view('calender', compact('meetings'));
    }
}
