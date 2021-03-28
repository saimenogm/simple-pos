<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    //
public function index(){

  $data=[];
   $data['sessions']=DB::table('users')
   ->join('sessions','users.id','sessions.user')
   ->get();
  return view('sessions/index',$data);

}
    public function session(Request $request){

        $check=$request->session()->has('session_id')?'true':'false';
       
        
        return view('sessions/session_form')->with('check',$check);
    }
    public function create_session(Request $request){
    
        //$request->session->put('session')
        //$session_table=DB::table('sessions')
    return view('sessions/new_session');
    
    }
    public function newsession(Request $request){

        $beginning_bal= $request->input('beginning_bal');
        //dd($beginning_bal);
        
        $user = auth()->user();
        $current_time=date('Y-m-d');
        $session_id = DB::table('sessions')->insertGetId(
          ['beginning_bal' => $beginning_bal,'starting_time'=>$current_time,'user'=>$user->id]
    );
    $request->session()->put('session_id',$session_id);
  
    return redirect('sales/create_new');
   

    }
    public  function closesession(Request $request)
    
    
    {
        $data=[];
$session_id=$request->session()->get('session_id');
$data['session_sales']=DB::table('sales')
->where('sales.session_id',$session_id)
->get();
//dd($session_id);
$data['session']=DB::table('sessions')
->join('users','users.id','sessions.user')
->where('sessions.id','=',$session_id)
->first();
$data['users']=DB::table('users')
->get();

//dd($data);
return view('/sessions/close_session',$data);

    }
    public function close_session_destroy(Request $request)
    
    {
        $session_id=$request->session()->pull('session_id');
      $beginning_bal=$request->input('beginning_bal');
      $ending_bal=$request->input('ending_bal');
      $total_amount=$request->input('total_amount');
      $user=$request->input('user');
      $recived_by=$request->input('reciver');
      $current_time=date('Y-m-d');

      //dd($total_amount);
      DB::table('sessions')
      ->where('id', $session_id)
      ->update(['ending_bal'=>$ending_bal,'sales_total'=> $total_amount,'ending_time'=>$current_time,'accepted_by'=>$recived_by]);
return view('/layouts/home');
   


    }
    public function showSession(Request $request,$session_id){


        $data=[];
        $data['session']=DB::table('sessions')
        ->join('users','users.id','sessions.user')
        ->where('sessions.id','=',$session_id)
        ->first();
        
        
        //dd($data);
        return view('/sessions/detail',$data);
    }

}
