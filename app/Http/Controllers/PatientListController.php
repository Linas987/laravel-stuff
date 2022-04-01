<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PatientListController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('pages.PatientList',['users'=>$users]);
    }
    public function dt()
    {
        $users = User::all();
        return view('pages.users.dt', compact('users'));
    }
}
