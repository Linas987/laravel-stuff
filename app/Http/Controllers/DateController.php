<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DoctorUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class DateController extends Controller
{
    //public function index()
    //{
     //   return view('pages.DoctorList');
    //}
    public function store(Request $request)
    {
        /*dd($request->dateselected,
        $request->doc_id,
            auth()->id()
        );*/
        DoctorUser::create([
        'user_id'=>auth()->id(),
        'doctor_id'=>$request->doc_id,
        'date_register'=>$request->dateselected,
        'Times'=>$request->timereg
        ]);
        $_SESSION['select_month']=0;
        $doctors = Doctor::all();
        $data=array('doc_id'=>$request->doc_id,'doctors'=>$doctors);
        //return View::make('dashboard')->with($data);
        return redirect()->route('dashboard')->with($data);
        //return view('pages.DoctorList');
    }
    public function destroy(Request $doctorUser)
    {
        //dd($doctorUser->drone);
        DoctorUser::destroy($doctorUser->drone);

        return back();
    }
    public function edit($id)
    {
        $DoctorUser=DoctorUser::find($id);
        //dd($user->name);
        $_SESSION['select_month']=0;
        $doc_id=$DoctorUser->doctor_id;
        $doctors = Doctor::all();
        return view('pages.edit.appointment',['DoctorUser'=>$DoctorUser,'id'=>$id,'doc_id'=>$doc_id,'doctors'=>$doctors]);
    }
    public function update(Request $request,$id)
    {
        //dd("bruh");

        $DoctorUser=DoctorUser::find($id);

        //dd($DoctorUser->Times);
        //dd($request->timereg);
        $DoctorUser->date_register=$request->dateselected;
        $DoctorUser->Times=$request->timereg;

        $DoctorUser->save();
        return redirect()->route('dashboard');
    }
}
