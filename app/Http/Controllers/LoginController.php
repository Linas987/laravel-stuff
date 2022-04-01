<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Intervention\Image\Facades\Image;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

  public function index()
  {
      return view('auth.login');
  }
  public function store(Request $request)
  {
      auth()->logout();
      auth('doctor')->logout();
      $this->validate($request,
        [
          'username'=>'required',
          'password'=>'required',
        ]
      );
      if(auth('doctor')->attempt($request->only('username','password')))
      {
          return redirect()->route('doctordashboard');
      }
      //atmesti vartotoja jeigu username ir password kombinacijos nera
      elseif (!auth()->attempt($request->only('username','password')))
      {
          return back()->with('status','Invalid login deatails');
      }
      //dd(auth()->user()->getPermissionsViaRoles());

      return redirect()->route('dashboard');
  }
}
