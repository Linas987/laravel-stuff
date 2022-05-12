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

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        //if(User::where('email',$user->email)->first()){
        //    return back()->with('warning','Email address already exists in database: please create an account manually');
        //}
        //dd($user->getAvatar());
        $authUser =$this->findOrCreateUser($user,$provider);
        if(!$authUser){
            return back()->with('warning','Email address already exists in database: please create an account manually');
        }
        Auth::login($authUser,true);
        return redirect()->route('dashboard');
    }

    public function findOrCreateUser($user,$provider)
    {
        $authUser=User::where('provider_id',$user->id)->first();
        //dd($authUser);
        if($authUser){
            return $authUser;
        }
        if(User::where('email',$user->email)->first()){
            return false;
        }
        return User::create([
            'username'=>$user->name,
            'email'=>$user->email,
            'name'=>$user->user['given_name'],
            'surname'=>$user->user['family_name'],
            'password'=>Hash::make($user->name),
            'provider'=>strtoupper($provider),
            'provider_id'=>$user->id
        ]);
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
          return back()->with('warning','Invalid login deatails');
      }
      //dd(auth()->user()->getPermissionsViaRoles());

      return redirect()->route('dashboard');
  }
}
