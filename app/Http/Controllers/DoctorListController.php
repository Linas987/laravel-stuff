<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Doctor;
use App\Models\Card;
use App\Models\User;
class DoctorListController extends Controller
{
  public function index()
  {
    $doc_id=NULL;
      /*$arrnum=NULL;*/
    $_SESSION['select_month']=0;
    //return view('pages.DoctorList');
    $doctors = Doctor::all();
    $doctorsP =DB::table('doctors')->paginate(2);
    //dd($doctors[0]->users[0]->pivot->Times);
      //$numofrows=$doctors[$doc_id-1]->users->count();
    $data=array('doc_id'=>$doc_id,'doctors'=>$doctors,'doctorsPage'=>$doctorsP,'sort'=>'name');
    //DB::table('doctors')->where('doctor_id', Auth('doctor')->id())->where('date_register','>=',date('Y-m-d'))->orderBy('date_register','asc')->orderBy('Times','asc')->paginate(5);
    return View::make('pages.DoctorList')->with($data);
  }
    public function store(Request $request)
    {
        if (isset($_POST['previous']))
        {$doc_id=$request->previous;
            /*$arrnum=$request->arrnum;*/
            $doctors = Doctor::all();
            $doctorsP =DB::table('doctors')->paginate(2);
            //$numofrows=$doctors[$doc_id-1]->users->count();
            $data=array('doc_id'=>$doc_id,'doctors'=>$doctors,'doctorsPage'=>$doctorsP,'sort'=>'name');
            $_SESSION['select_month']=(-1);
            return View::make('pages.DoctorList')->with($data);
        }
        if (isset($_POST['next']))
        {$doc_id=$request->next;
            /*$arrnum=$request->arrnum;*/
            $doctors = Doctor::all();
            $doctorsP =DB::table('doctors')->paginate(2);
            //$numofrows=$doctors[$doc_id-1]->users->count();
            $data=array('doc_id'=>$doc_id,'doctors'=>$doctors,'doctorsPage'=>$doctorsP,'sort'=>'name');
            $_SESSION['select_month']=1;
            return View::make('pages.DoctorList')->with($data);
        }
        if (isset($_POST['current']))
        {$doc_id=$request->current;
            /*$arrnum=$request->arrnum;*/
            $doctors = Doctor::all();
            $doctorsP =DB::table('doctors')->paginate(2);
            //$numofrows=$doctors[$doc_id-1]->users->count();
            $data=array('doc_id'=>$doc_id,'doctors'=>$doctors,'doctorsPage'=>$doctorsP,'sort'=>'name');
            $_SESSION['select_month']=0;
            return View::make('pages.DoctorList')->with($data);
        }
        $_SESSION['select_month']=0;
        //dd($request->drone);
        $doc_id=$request->drone;
        /*$arrnum=$request->arrnum;*/
        //$compactData=array('doc_id');

        $doctors = Doctor::all();
        $doctorsP =DB::table('doctors')->paginate(2);
        //$numofrows=$doctors[$doc_id-1]->users->count();
        $data=array('doc_id'=>$doc_id,'doctors'=>$doctors,'doctorsPage'=>$doctorsP,'sort'=>'name');
        //return redirect()->route('pages.DoctorList');
        //return View::make('pages.DoctorList', compact($compactData));
        return View::make('pages.DoctorList')->with($data);
    }
    public function sort(Request $request): \Illuminate\Contracts\View\View
    {
        $sortBy=$request->sort;
        $doc_id=NULL;
        $_SESSION['select_month']=0;
        /*$arrnum=$request->arrnum;*/
        //$compactData=array('doc_id');
        if(isset($_POST['bysurname'])) {
            $sortBy = 'surname';
        }
        if(isset($_POST['byname'])) {
            $sortBy = 'name';
        }
        if(isset($_POST['byoccupation'])) {
            $sortBy = 'occupation';
        }
        //$doctors = Doctor::all()->sortBy($sortBy);
        if(!$sortBy)
        $sortBy='name';
        $doctors =DB::table('doctors')->orderBy($sortBy)->paginate(2)/*->appends([['sort' => $sortBy]])*/;
        //$numofrows=$doctors[$doc_id-1]->users->count();
        $data=array('doc_id'=>$doc_id,'doctorsPage'=>$doctors,'sort'=>$sortBy);
        //return redirect()->route('pages.DoctorList');
        //return View::make('pages.DoctorList', compact($compactData));
        return View::make('pages.DoctorList')->with($data);
    }
}
