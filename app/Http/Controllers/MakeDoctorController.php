<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MakeDoctorController extends Controller
{
  public function index()
  {
      return view('pages.MakeDoctor');
  }
  public function store(Request $request)
  {
      $this->validate($request,
          [
              'username'=>'required|max:255|unique:users|unique:doctors',
              'email'=>'required|email|max:255|unique:users|unique:doctors',
              'occupation'=>'required',
              'name'=>'required|max:255',
              'surname'=>'required|max:255',
              'password'=>'required',
          ]
      );
      Doctor::create([
          'username'=>$request->username,
          'email'=>$request->email,
          'occupation'=>$request->occupation,
          'name'=>$request->name,
          'surname'=>$request->surname,
          'password'=>Hash::make($request->password),
      ]);
      return redirect()->route('DoctorList');
  }
}
