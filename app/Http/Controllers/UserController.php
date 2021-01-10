<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Lead;
use App\Status;
use App\Http\Traits\NotificationTrait;

class UserController extends Controller
{
  use NotificationTrait;

  public function __construct()
  {
 		$this->middleware('auth');
  }

  public function index()
  {
 		$role = User::find(Auth::id())->roles;
 		$role =  $role[0]->name;
 		return $this->checkPolicy($role);
  }

  public function checkPolicy($role)
  {
 		if($role == 'Admin'){
 			return $this->adminAccess();
 		}elseif ($role == 'Team Leader') {
 			return $this->teamLeaderAccess();
 		}else {
 			return $this->agentAccess();
 		}
  }

  public function adminAccess()
  {
 		$teamleaders = User::where('parent_id', '=', Auth::id())->get();
 		return view('admin',compact('teamleaders'));
  }

  public function teamLeaderAccess()
  {
 		$agents = User::where('parent_id', '=', Auth::id())->get();
 		$requests = Lead::where('user_id', '=', Auth::id())->get();
 		return view('teamleader', compact('agents','requests'));
  }

  public function agentAccess()
  {
 		$requests = Lead::where('user_id', '=', Auth::id())->get();
 		$statuses = Status::all();
 		return view('agent',compact('requests','statuses'));
  }

  public function addLead(Request $request)
  {
      
    $this->validate($request, [
        'request' => 'required|mimes:csv,txt,xlsx,xls',
    ]);
    $lead = new Lead($request->input()) ;
 
    if($file = $request->hasFile('request')) {          
        $file = $request->file('request') ;           
        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/leads/' ;
        $file->move($destinationPath,$fileName);
        $lead->request = $fileName ;
    }

    $lead->save();

    //Notification sent to TeamLeader
    $toUser = User::find($request->user_id);
    $this->notify($toUser);

    return redirect()->back()->with('success','Your Request have been successfully set');
  }

  public function assignAgent(Request $request)
  {
  	$this->validate($request, [
  		'id' => 'required',
      'user_id' => 'required',
      ]);
  	$lead = Lead::where('id', $request->id)
          ->update(['user_id' => $request->user_id]);
  	return redirect()->back()->with('success','Your Request have been assigned successfully');
  }

  public function addActivity(Request $request)
  {
  	$this->validate($request, [
  		'id' => 'required',
      'status_id' => 'required',
      ]);
  	$lead = Lead::where('id', $request->id)
          ->update(['status_id' => $request->status_id]);
  	return redirect()->back()->with('success','Action has been set successfully');
  }
}
