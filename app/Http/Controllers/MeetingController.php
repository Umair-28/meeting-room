<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Meeting;
use App\Models\User;

use Carbon\Carbon;
class MeetingController extends Controller
{
    public function showForm(){

        $users = User::where('role', '!=', 'admin')->get();

 
        return view('meetingForm', compact('users'));
    }

    public function submitForm(Request $request)
    {
        // Validation rules
        $rules = [
            'title' => 'required|string',
            'organizer' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'participants' => 'required|array'
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $meetingParticipants = implode(',', $request->participants);
    
        $meetingDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->date . ' ' . $request->time);
    
        // Check for existing meeting at the same time
        $existingMeeting = Meeting::where('date_time', $meetingDateTime)
            ->when($request->id, function ($query, $id) {
                return $query->where('id', '!=', $id);
            })
            ->first();
    
        if ($existingMeeting) {
            return redirect()->back()->withErrors(['date_time' => 'A meeting is already scheduled at this time. Please choose a different time.'])->withInput();
        }
    
        // Check if updating or creating a new meeting
        $meetingFound = Meeting::find($request->id);
    
        if ($meetingFound) {
            $meetingFound->update([
                'title' => $request->title,
                'organizer' => $request->organizer,
                'date_time' => $meetingDateTime,
                'participants' => $meetingParticipants
            ]);
            return redirect()->back()->with('success', 'Meeting updated successfully');
        }
    
        // Create the new meeting
        Meeting::create([
            'title' => $request->title,
            'organizer' => $request->organizer,
            'date_time' => $meetingDateTime,
            'participants' => $meetingParticipants
        ]);
    
        return redirect()->back()->with('success', 'Meeting scheduled successfully');
    }
    

    public function delete($id){
        $meeting = Meeting::find($id);
        if($meeting){
            $meeting->delete();
            return redirect()->back();
        }
    }

    public function updateSchedule($id){
        $meeting = Meeting::find($id);
        if ($meeting) {
            $meeting->participants = explode(',', $meeting->participants); // Convert to array
            $users = User::where('role', '!=', 'admin')->get();
            return view('meetingFormUpdate', compact('meeting', 'users'));
        }
    }
    
}
