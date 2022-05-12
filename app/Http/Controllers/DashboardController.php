<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Doctor;
use App\Models\DoctorUser;
use App\Models\InvalidCard;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

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
    public function edit($id)
    {
        $user=User::find($id);
        //dd($user->name);
        return view('pages.edit.user',['user'=>$user,'id'=>$id]);
    }
    public function update(Request $request,$id)
    {
        //dd($request->get('avatar')!=NULL);
        if($request->hasFile('avatar')){
            $this->validate($request,['avatar'=>'file|mimes:jpeg,bmp,png|max:2000']);
            //dd($request->file('avatar')->getSize());
            $avatar =$request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/uploads/avatars/'.$filename) );
            $user=User::find($id);
            $user->avatar=$filename;
            $user->save();
        }
        $user=User::find($id);
        if($request->get('username')!=$user->username){
            $this->validate($request,['username'=>'required|max:255|unique:users|unique:doctors']);
        }elseif($request->get('email')!=$user->email){
            $this->validate($request,['email'=>'required|email|max:255|unique:users|unique:doctors']);
        }
        $this->validate($request,[
            'name'=>'required|max:255',
            'surname'=>'required|max:255',
            'password'=>'required'
        ]);
        $user->username=$request->get('username');
        $user->email=$request->get('email');
        $user->name=$request->get('name');
        $user->surname=$request->get('surname');
        $user->password=Hash::make($request->get('password'));
        $user->save();
        return redirect()->route('dashboard')->with('success','Your account was updated');
    }
    public function destroy(Request $User)
    {
        //dd(Carbon::now()->toDateString());
        $id=$User->drone;

        $cards=Card::where('user_id', $id)->get();
        foreach ($cards as $card) {
            InvalidCard::create([
                'doctor_id'=>$card->doctor_id,
                'session_name'=>$card->session_name,
                'Observations'=>$card->Observations,
                'name'=>auth()->user()->name,
                'surname'=>auth()->user()->surname,
                //'deletion_date'=>Carbon::now()->toDateString(),
            ]);
        }
        Card::where('user_id', $id)->delete();
        DoctorUser::where('user_id', $id)->delete();
        User::destroy($id);
        auth()->logout();
        return View::make('home');
    }
}
