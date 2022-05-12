<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorUser;
use App\Models\InvalidCard;
use Illuminate\Auth\Access\Response;
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
        $invalidCards=InvalidCard::all();
        //dd($request->userID);
        if($request->userID){
            $selectedUserId=$request->userID;
        }else{
            $selectedUserId=null;
        }

        return view('pages.WriteCard',['cards'=>$cards,'selectedUserId'=>$selectedUserId,'invalidCards'=>$invalidCards]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'required|exists:users,id|numeric',
            'session_name'=>'required',
            'body'=>'required'
        ]);
        if($request->hasFile('file')){
            $this->validate($request,['file'=>'file|mimes:pdf']);
            //dd($request->file('file')->getSize());
            $document =$request->file('file');
            $filename = time() . '.' . $document->getClientOriginalExtension();
            $document->move( public_path('/uploads/documents/'),$filename );
            $uploadedfile=$filename;
        }
        if( isset($uploadedfile)) {
            auth('doctor')->user()->cards()->create([
                'user_id' => $request->user_id,
                'session_name' => $request->session_name,
                'Observations' => $request->body,
                'file' => $uploadedfile
            ]);
        }else{
            auth('doctor')->user()->cards()->create([
                'user_id' => $request->user_id,
                'session_name' => $request->session_name,
                'Observations' => $request->body
            ]);
        }

        $cards = Card::get();
        $invalidCards=InvalidCard::all();

        return view('pages.WriteCard',['cards'=>$cards,'invalidCards'=>$invalidCards]);
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
        if($request->hasFile('file')){
            $this->validate($request,['file'=>'file|mimes:pdf']);
            //dd($request->file('avatar')->getSize());
            $document =$request->file('file');
            $filename = time() . '.' . $document->getClientOriginalExtension();
            $document->move( public_path('/uploads/documents/'),$filename );
            $card=Card::find($id);
            $card->file=$filename;
            $card->save();
        }
        $card=Card::find($id);
        $card->user_id=$request->get('user_id');
        $card->session_name=$request->get('session_name');
        $card->Observations=$request->get('Observations');
        $card->save();
        return redirect()->route('WriteCard')->with('success','Card updated');
    }
    public function download(Request $request,$filename)
    {
        $file = public_path('/uploads/documents/').$filename;

        $headers = ['Content-Type: pdf'];

        if (file_exists($file)) {
            return response()->download($file, 'Card.pdf', $headers);
        } else {
            echo('File not found.');
        }
    }
}
