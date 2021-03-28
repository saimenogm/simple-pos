<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location as Location;
use App\Item as Item;
use Illuminate\Support\Facades\DB;


class LocationController extends Controller
{
    //

    public function __construct(Location $location)
    {
        $this->location = $location;
        
    }

    public function index()
    {
        $data = [];

        $data['locations'] = $this->location->all();
        //dd($data['locations']);

        $data['locations'] = DB::table('locations')
        ->get();

        return view('locations/index', $data);
    }


    
    public function newLocation(Request $request, Location $location)
    {
        $data = [];
        DB::beginTransaction();
    
        try
        {
        
       
            $data['location_name'] = $request->input('location_name');
            $data['address'] = $request->input('address');
            $data['description'] = $request->input('description');
            
            if( $request->isMethod('post') )
            {
                //dd($data);
                
                $this->validate(
                    $request,
                    [
                    ]
                );
                
    
                $location->insert($data);
                DB::commit();          
                return redirect('locations/');
            }
            
            return view('locations/form', $data);
       
       
          }
 //this is for catch
 catch(Exception $e){
    DB::rollBack();
    


}    

    }


    public function createLocation(Request $request, Location $location)
    {

        $data = [];
        $data['items'] = DB::table('items')->get();

        return view('locations/form',$data);

    }


    public function modify( Request $request, $location_id, Location $location )
    {
        $data = [];
        DB::beginTransaction();
    
        try
        {
        

            if( $request->isMethod('post') )
            {
                //dd($data);
                $this->validate(
                    $request,
                    [
                        
                    ]
                );
                
    
                $location_data = $this->location->find($location_id);
    
                $location_data->location_name = $request->input('location_name');
                $location_data->address = $request->input('address');
                $location_data->description = $request->input('description');
    
                $location_data->save();
                DB::commit();       
                return redirect('locations');
            }
            
            return view('location/detail', $data);       
       
            

          }
          
          //this is for catch
          catch(Exception $e){
            DB::rollBack();
                
        }   

    }


    public function show($location_id)
    {
        $data = []; 

        $data['items'] = DB::table('items')->get();
        $data['location_id'] = $location_id;
        $data['modify'] = 1;
        $location_data = $this->location->find($location_id);

        $data['location_name'] = $location_data->location_name;
        $data['address'] = $location_data->address;
        $data['description'] = $location_data->description;
        
        return view('locations/detail', $data);
    }

}
