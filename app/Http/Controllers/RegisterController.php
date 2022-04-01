<?php

namespace App\Http\Controllers;

Use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
      return view('auth.register');
    }

      public function store(Request $request)
    {

          /*protected function validator(array $data)
          {
          return Validator::make($data, [
            'username'=>'required|max:255|unique:users',
            'name'=>'required|max:255',
            'surname'=>'required|max:255',
            'password'=>'required|unique:users',
          ]);
          }

          protected function create(array $data)
          {
          User::create([
          'username'     => $data['username'],
          'password' => Hash::make($data['password']),
          ]);
        }*/

            $this->validate($request,
              [
                'username'=>'required|max:255|unique:users|unique:doctors',
                'email'=>'required|email|max:255|unique:users|unique:doctors',
                'name'=>'required|max:255',
                'surname'=>'required|max:255',
                'password'=>'required',
              ]
            );
            //Hash fasadas pastoviai sukurdamas nauja passworda uzhashina unikaliai.
            //$users = User::where('password', '=', $request->input(Hash::make('password')))->first();
            //if($users ===null)
            //if(! User::where('password','=',Hash::make($request->password))->count() >= 1)
            //{
                User::create([
                  'username'=>$request->username,
                  'email'=>$request->email,
                  'name'=>$request->name,
                  'surname'=>$request->surname,
                  'password'=>Hash::make($request->password),
                ]);
            //}
            //else
            //{return back()->with('status','Password allready exists');}
            //sign in
            auth()->attempt($request->only('name','surname','password'));

            return redirect()->route('dashboard');

    }
}
