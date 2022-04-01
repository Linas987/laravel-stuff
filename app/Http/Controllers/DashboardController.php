<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Doctor;
use App\Models\DoctorUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function index()
    {
      //dd(auth()->user());
        //$doc_use= DoctorUser::orderBy('date_register', 'asc')->get();
        $doctors = Doctor::with(['users' => function ($q) {
            $q->orderBy('date_register', 'asc');
        }])->get();
        //dd($doc_use[0]->date_register);
        return view('dashboard',['doctors'=>$doctors/*,'doc_use'=>$doc_use*/]);
    }
    public function index2()
    {
        $appointment = DB::table('doctor_user')->where('doctor_id', Auth('doctor')->id())->where('date_register','>=',date('Y-m-d'))->orderBy('date_register','asc')->orderBy('Times','asc')->paginate(5);
//        $doctors = Doctor::with(['users' => function ($q) {
//            $q->orderBy('date_register', 'asc');
//        }])->get();
        //dd(auth ('doctor')->user()->cards);
        return view('doctordashboard',[/*'doctors'=>$doctors,*/'appointment'=>$appointment]);
    }

}
