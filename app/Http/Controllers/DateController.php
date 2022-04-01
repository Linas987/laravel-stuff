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
}
