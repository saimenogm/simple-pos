<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Data as Data;
use Illuminate\Support\Facades\DB;


class TestAjax extends Controller
{
    //

    public function addItem(Request $request) 
    {    
        $rules = array (            
            'name' => 'required'    );    
            $validator = Validator::make ( Input::all (), $rules );    
            if ($validator->fails ())        
            return Response::json ( array (                                    
                'errors' => $validator->getMessageBag ()->toArray ()        ) );        
            else {            
                $data = new Data ();            
                $data->name = $request->name;            
                $data->save ();            
                return response ()->json ( $data );        
            }
    }
        
    public function readItems(Request $req) 
    {    
        $data = [];

        $data['data'] = DB::table('data')
        ->get();
        //dd($data['items']);
        return view('test_ajax/index',$data);
}
}