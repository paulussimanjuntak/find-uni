<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\Result;
use App\Models\Application;
use App\Models\QualObtained;
use App\Models\Gradelist;
use App\Models\Applicant;
use App\Models\Qualification;
use App\Models\University;
use App\Models\Programme;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) $check = Auth::user()->applicant->count();
        return view('welcome',compact('check'));
    }

    public function university(){

      $univs = University::all();
      return view('university',compact('univs'));
    }

    public function programme($id){
      $univs = University::findOrFail($id);
      return view('programme',compact('univs'));
    }

    public function getQuals(){
      $data = Qualification::where('status',1)->get();
      return response()->json($data);
    }

    public function getGradelist($id){
      $data = Qualification::where('id',$id)->with('gradelist')->first();
      return response()->json($data);
    }

    public function getProgramme(Request $request){
      if($request->get('s')){
        $s = urldecode($request->get('s'));
        $data = Programme::with('university')->where('name','LIKE', "%{$s}%")->get();
      }else $data = Programme::with('university')->get();
      return response()->json($data);
    }

    public function saveApplicant(Request $request){
      $validator = Validator::make($request->all(), [
        'idtype' => 'required|string',
        'idnumber' => 'required|numeric',
        'mobile' => 'required|numeric',
      ]);
      
      if($validator->fails())
        return response()->json($validator->errors(),422);
      
      if($request->date === "Invalid date")
        return response()->json(['date' => ['The date of birth field is required.']],422);

      Applicant::create([
        'IDtype' => $request->idtype,
        'IDnumber' => $request->idnumber,
        'mobileNo' => $request->mobile,
        'dateOfBirth' => $request->date,
        'user_id' => Auth::user()->id
      ]);

      return response()->json(['success' => true]);
    }

    public function applyApplication(Request $request){
      foreach(Auth::user()->applicant as $applicant)
        $applicant_id = $applicant->id;

      $application = Application::create([
        'status' => 'New',
        'applicant_id' => $applicant_id,
        'programme_id' => $request->programme_id
      ]);

      $qual = QualObtained::create([
        'overallScore' => $request->overall_score,
        'application_id' => $application->id,
        'qualification_id' => $request->qualification_id
      ]);
      
      foreach($request->result as $result){
        Result::create([
          'subjectName' => $result['subject'],
          'grade' => $result['grade'],
          'qual_obtained_id' => $qual->id
        ]);
      }

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
      'resultCalcDescription' => $request->calculation,
      'status' => 0
    ]);

    foreach($request->list_grade as $grade){
      $gradelist = new Gradelist;
      $gradelist->grade = $grade;
      $gradelist->qualification_id = $quals->id;
      $gradelist->save();
    }
    return response()->json(['success' => true]);
  }

}
