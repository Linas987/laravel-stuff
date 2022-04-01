<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Models\Card;
use App\Models\User;
use Symfony\Component\Console\Input\Input;

class CardController extends Controller
{
  public function index()
  {
      $cards = Card::get();
      return view('pages.Card',['cards'=>$cards]);
  }

    public function index2(Request $request)
    {
        $cards = Card::all();
        //dd($request->userID);
        if($request->userID){
            $selectedUserId=$request->userID;
        }else{
            $selectedUserId=null;
        }

        return view('pages.WriteCard',['cards'=>$cards,'selectedUserId'=>$selectedUserId]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'required|exists:users,id|numeric',
            'session_name'=>'required',
            'body'=>'required'
        ]);

        /*Post::create([
            'user_id'=>$request->user_id,
            'doctor_id'=>auth('doctor')->id(),
            'session_name'=>$request->session_name,
            'Observations'=>$request->body,
            'date_written'=>date("Y-m-d")
        ]);*/

        auth('doctor')->user()->cards()->create([
            'user_id'=>$request->user_id,
            'session_name'=>$request->session_name,
            'Observations'=>$request->body,
        ]);
        $cards = Card::get();

        return view('pages.WriteCard',['cards'=>$cards]);
    }
    public function destroy(Request $request)
    {
        //dd($request->drone);
        Card::destroy($request->drone);
        return back();
    }
    public function edit($id)
    {
        $card=Card::find($id);
        //dd($card);
        return view('pages.edit.card',['card'=>$card,'id'=>$id]);
    }
    public function update(Request $request,$id)
    {
        //dd("bruh");
        $this->validate($request,[
            'user_id'=>'required|exists:users,id|numeric',
            'session_name'=>'required',
            'Observations'=>'required'
        ]);
        $card=Card::find($id);
        $card->user_id=$request->get('user_id');
        $card->session_name=$request->get('session_name');
        $card->Observations=$request->get('Observations');
        $card->save();
        return redirect()->route('WriteCard')->with('success','Card updated');
    }
}
