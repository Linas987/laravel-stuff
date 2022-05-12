<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Doctor;
use App\Models\DoctorUser;
use App\Models\InvalidCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EditDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('pages.EditDoctor',['doctors'=>$doctors]);
    }
    public function destroy(Request $doctor)
    {
        //dd($doctorUser->drone);
        Card::where('doctor_id', $doctor->drone)->delete();
        DoctorUser::where('doctor_id', $doctor->drone)->delete();
        InvalidCard::where('doctor_id', $doctor->drone)->delete();
        Doctor::destroy($doctor->drone);
        return back();
    }
    public function edit($id)
    {
        $doctor=Doctor::find($id);
        //dd($doctor->name);
        return view('pages.edit.Edit',['doctor'=>$doctor,'id'=>$id]);
    }
    public function update(Request $request,$id)
    {
        //dd("bruh");
        $doctor=Doctor::find($id);
        if($request->get('username')!=$doctor->username){
            $this->validate($request,['username'=>'required|max:255|unique:users|unique:doctors']);
        }elseif($request->get('email')!=$doctor->email){
            $this->validate($request,['email'=>'required|email|max:255|unique:users|unique:doctors']);
        }
        $this->validate($request,[
            'occupation'=>'required',
            'name'=>'required|max:255',
            'surname'=>'required|max:255',
            'password'=>'required'
        ]);
        $doctor->username=$request->get('username');
        $doctor->email=$request->get('email');
        $doctor->occupation=$request->get('occupation');
        $doctor->name=$request->get('name');
        $doctor->surname=$request->get('surname');
        $doctor->password=Hash::make($request->get('password'));
        $doctor->save();
        return redirect()->route('EditDoctor')->with('success','Doctor of id: '.$doctor->id.' updated');
    }

}
