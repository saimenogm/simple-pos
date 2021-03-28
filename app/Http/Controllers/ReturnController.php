<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    public function index()
    {
        $data = [];

        $data['returns'] = DB::table('returns');

        $data['returns'] = DB::table('items')
        ->join('returns', 'items.id', '=', 'returns.item')
        ->get();
        return view('returns/index', $data);
    }

    public function createReturn(Request $request)
    {
        $data = [];
        $data['items'] = DB::table('items')
        ->leftjoin('item_barcodes', 'items.id', '=', 'item_barcodes.item')
        ->select('items.id','items.item_name','items.item_code','item_barcodes.id as barcode_id','item_barcodes.color','item_barcodes.size')
        ->where('item_barcodes.active',1 )
        ->orwhere('item_barcodes.active',null)
        ->orderBy('items.name')
        ->get();

        $data['locations'] = DB::table('locations')->get();

        return view('returns/form',$data);
    }
    public function newReturn(Request $request)
    {
        $data = [];

        $data['date'] = $request->input('date');
        $data['amount'] = $request->input('real_amount');
        $data['reason'] = $request->input('reason');
        $hi_item = $request->input('item');
        $item_array = explode('-',$hi_item);
        $item_id=$item_array[0];
        $data['item'] =$item_id;
        if ($item_array[1]=="")
        {
               ///varities will be pass as null 
        }
        else{
        $data['varities']=$item_array[1];
        }
        //dd(   $hi_item );
        //dd($item_array[1]);
        $item= DB::table('items')
        ->where('id', $item_id)
        ->first();
        
                   
        if($item_array[1]==null){
          
        // Update the barcode qty
                  DB::table('items')
                               // ->where('barcode', $request->input('barcode'))
                                ->where('id', $item_id)
                                ->update(['qty_shop' => $item->qty_shop + $request->input('real_amount'),'current_amount'=> $item->current_amount+$request->input('real_amount')]);
                        
                                DB::table('inventory_record')->insert(
                                    ['item' => $item_array[0] ,'activity'=>'Return','previous_cost'=>$item->unit_cost, 'units_received' =>$request->input('real_amount'),'units_sold'=>0.00,'date'=>$request->input('date'),'qty_on_hand'=>$item->current_amount+$request->input('real_amount'),'unit_cost'=>$item->unit_cost,'total_cost'=>$item->unit_cost,'vendor'=>0]
                                );
                                
                        // $this->calculateTotalItem2($item_id);
                        // DB::table('inventory_record')->insert(
                        //     ['item' => $item->id ,'activity'=>'Returned','previous_cost'=>$item->unit_cost, 'units_received' => $item->current_amount+$request->input('real_amount'),'units_sold'=>0.00,'date'=>$item->current_amount+$request->input('real_amount'),'qty_on_hand'=>$barcode_item_store->store+$barcode_item_store->shop,'unit_cost'=>$current_cost,'total_cost'=>$qty_list[$i]*$new_cost,'location'=>$request->input('destination'),'ref_id'=>$transfer->id]
                        // ); 
                         if( $request->isMethod('post') )
                         {
                             //dd($data);
                             
                             $this->validate(
                                 $request,
                                 [
                                 ]
                             );
                             
                 
                             
                         }


                     }
                     else{
                        $item_barcode= DB::table('item_barcodes')
                        // ->where('barcode', $request->input('barcode'))
                         ->where('id', $item_array[1])
                         ->first();
          
                            DB::table('item_barcodes')
                                ->where('item', $item_id)
                                ->where('id', $item_array[1])
                                ->update(['shop' =>$item_barcode->shop + $request->input('real_amount')]);
                                
                                
                                //dd($item);
                                DB::table('items')
                                ->where('id', $item_id)
                                ->update(['current_amount'=> $item->current_amount + $request->input('real_amount')]);
                        // $this->calculateTotalItem2($item_id)
                        // DB::table('inventory_record')->insert(
                        //     ['item' => $item->id ,'activity'=>'Returned','previous_cost'=>$previous_cost, 'units_received' => $qty_list[$i],'units_sold'=>$sold_qty,'date'=>$date_formatted,'qty_on_hand'=>$barcode_item_store->store+$barcode_item_store->shop,'unit_cost'=>$current_cost,'total_cost'=>$qty_list[$i]*$new_cost,'location'=>$request->input('destination'),'ref_id'=>$transfer->id]
                        // ); 
                         

                        DB::table('inventory_record')->insert(
                            ['item' => $item_array[0] ,'activity'=>'Return','previous_cost'=>0.00, 'units_received' =>$request->input('real_amount'),'units_sold'=>0.00,'date'=>$request->input('date'),'qty_on_hand'=>$item->current_amount+$request->input('real_amount'),'unit_cost'=>$item_barcode->unit_cost,'total_cost'=>$item_barcode->unit_cost,'vendor'=>0]
                        );
                     }
                     
                     DB::table('returns')->insert($data); 
                       
                 
                             return redirect('returns/');
       
        return view('returns/form', $data);

    }

public function show($id){
    
    $data['returns'] = DB::table('items')
    ->join('returns','items.id','returns.item')
    ->where('returns.id',$id)
    ->first();
    // dd($data);
return view('returns.detail',$data);

}



}
