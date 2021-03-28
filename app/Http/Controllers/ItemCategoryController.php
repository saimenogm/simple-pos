<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item as Item;
use App\ItemCategory as ItemCategory;

use Illuminate\Support\Facades\DB;


class ItemCategoryController extends Controller
{
    //

    public function __construct(ItemCategory $itemCategory )
    {
        $this->itemCategory = $itemCategory;
    }

    public function index()
    {
        $data = [];

        $data['itemCategorys'] = $this->itemCategory->all();
        return view('itemCategorys/index', $data);
    }

    public function newItemCategory(Request $request, ItemCategory $itemCategory)
    {
        $data = [];
        DB::beginTransaction();
    
        try
        {
            if( $request->isMethod('post') )
        {
            //$client_data = $this->client->find($client_id);

            $itemCategory = new ItemCategory();
            $itemCategory->category_name = $request->input('category_name');
            $itemCategory->itemCategory_code = $request->input('itemCategory_code');
            $itemCategory->description = $request->input('description');

            $itemCategory->save();
            DB::commit();        
        }
        return redirect('itemsCategory');
        
          }

   //this is for catch
   catch(Exception $e){
    DB::rollBack();


}    
      

    }

    public function createItemCategory(Request $request, ItemCategory $itemCategory)
    {
        $data = [];

        $data['itemCategorys'] = $this->itemCategory->all();
        //dd($data);
        return view('itemCategorys/form', $data);

    }

    public function show($itemCategory_id)
    {
        $data = []; 
        $data['itemCategory_id'] = $itemCategory_id;
        $data['modify'] = 1;
        $itemCategory_data = $this->itemCategory->find($itemCategory_id);
        $data['category_name'] = $itemCategory_data->category_name;
        $data['itemCategory_code'] = $itemCategory_data->itemCategory_code;
        $data['description'] = $itemCategory_data->description;
        return view('itemCategorys/detail', $data);
    }


    public function modify( Request $request, $itemCategory_id, ItemCategory $itemCategory )
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
                
    
                $itemCategory = $this->itemCategory->find($itemCategory_id);
    
                $itemCategory->category_name = $request->input('category_name');
                $itemCategory->description = $request->input('description');
                $itemCategory->itemCategory_code = $request->input('itemCategory_code');
                $itemCategory->save();
                DB::commit();       
                return redirect('itemsCategory/');
            }
            
            return view('customer/detail', $data);
        }
       
           
     //this is for catch
        
        catch(Exception $e){
            DB::rollBack();
            
        
        
        }    

       

}}
