<?php

namespace App\Http\Controllers;

use Validator;
use App\Mail\SuccessEmail;
use App\Mail\UnsuccessEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Application;
use App\Models\Qualification;
use App\Models\Gradelist;
use App\Models\University;
use App\Models\User;
use App\Models\Programme;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  /* Verify Quals */
  public function verifyQuals(){
    return view('admin.verify-quals');
  }

  public function getVerifyquals(){
    $data = Qualification::where('status',0)->with('gradelist')->get();
    return response()->json($data);
  }

  public function updateVerifyquals($id){
    $quals = Qualification::where('id',$id)->first();
    $quals->update(['status' => 1]);
    return response()->json(['success' => true]);
  }
  /* Setup Qualification */
  public function setup_qualification(){
    return view('admin.setup-qualification');
  }

  public function dataQuals(){
    $data = Qualification::where('status',1)->get();
    return response()->json($data);
  }

  public function dataGradelist($id){
    $data = Gradelist::where('qualification_id',$id)->get();
    return response()->json($data);
  }

  public function getGrade($id){
    $data = Gradelist::where('id',$id)->first();
    return response()->json($data);
  }

  public function updateQuals(Request $request,$id){
    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'minimum' => 'required|numeric',
      'maximum' => 'required|numeric',
      'calculation' => 'required|numeric',
    ]);
    
    if($validator->fails())
      return response()->json($validator->errors(),422);

    $quals = Qualification::where('id',$id)->first();

    $quals->update([
      'name' => $request->name,
      'minimumScore' => $request->minimum,
      'maximumScore' => $request->maximum,
      'resultCalcDescription' => $request->calculation
    ]);

    return response()->json(['success' => true]);
  }

  public function updateGrade(Request $request,$id){
    $validator = Validator::make($request->all(), [
      'grade' => 'required'
    ]);
    
    if($validator->fails())
      return response()->json($validator->errors(),422);

    $grade = Gradelist::where('id',$id)->first();
    $grade->update(['grade' => $request->grade]);

    return response()->json(['success' => true]);
  }

  public function saveQuals(Request $request){
    $validator = Validator::make($request->all(), [
      'name' => 'required|string',
      'minimum' => 'required|numeric',
      'maximum' => 'required|numeric',
      'calculation' => 'required|numeric',
      'list_grade' => 'required'
    ]);

    if($validator->fails())
      return response()->json($validator->errors(),422);

    $quals = Qualification::create([
      'name' => $request->name,
      'minimumScore' => $request->minimum,
      'maximumScore' => $request->maximum,
      'resultCalcDescription' => $request->calculation
    ]);

    foreach($request->list_grade as $grade){
      $gradelist = new Gradelist;
      $gradelist->grade = $grade;
      $gradelist->qualification_id = $quals->id;
      $gradelist->save();
    }
    return response()->json(['success' => true]);
  }

  /* Register Univ */
  public function register_univ(){
    return view('admin.register-university');
  }

  public function getUniv(){
    $data = University::all();
    return response()->json($data);
  }

  public function showAdmin($id){
    $data = User::where('university_id',$id)->get();
    return response()->json($data);
  }

  public function addAdmin(Request $request){
    $validator = Validator::make($request->all(), [
      'username' => 'required|string',
      'password' => 'required|string|min:6',
      'name' => 'required|string',
      'email' => 'required|string|email|max:255|unique:users'
    ]);

    if($validator->fails())
      return response()->json($validator->errors(),422);

    User::create([
      'name' => $request->name,
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => 'uniAdmin',
      'university_id' => $request->univ_id
    ]);

    return response()->json(['success' => true]);
  }

  public function saveUniv(Request $request){
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:6'
    ]);

    if($validator->fails())
      return response()->json($validator->errors(),422);

    University::create([
      'name' => $request->name
    ]);

    return response()->json(['success' => true]);
  }

  /* Record Programme */
  public function record_programme(){
    return view('admin.record-programme');
  }

  public function getProgramme($id){
    $data = Programme::where('university_id',$id)->with('application')->get();
    return response()->json($data);
  }

  public function save_programme(Request $request){
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:6',
      'description' => 'required|string'
    ]);

    if($validator->fails())
      return response()->json($validator->errors(),422);

    if($request->closingDate === "Invalid date")
      return response()->json(['date' => ['The closing date field is required.']],422);

    Programme::create([
      'name' => $request->name,
      'description' => $request->description,
      'closingDate' => $request->closingDate,
      'university_id' => $request->univ_id
    ]);

    return response()->json(['success' => true]);
  }

  /* Review Applications */
  public function review_applications($id = null){
    return view('admin.review-applications',compact('id'));
  }

  public function getApplication($id){
    $data = Application::where('programme_id',$id)->with('applicant.user','qual_obtained.qualification','qual_obtained.result')
      ->get();
    return response()->json($data);
  }

  public function emailSuccess($id){
    $data = Application::where('id',$id)->first();
    $data->update(['status' => 'Success']);
    Mail::to($data->applicant->user->email)->send(new SuccessEmail($data));
  }

  public function emailUnsuccess($id){
    $data = Application::where('id',$id)->first();
    $data->update(['status' => 'Unsuccess']);
    Mail::to($data->applicant->user->email)->send(new UnsuccessEmail($data));
  }

}
