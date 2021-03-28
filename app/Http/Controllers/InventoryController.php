<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Purchase as Purchase;
use App\Item as Item;
use App\PurchaseItem as PurchaseItem;

use PdfReport;
use PDF;


class InventoryController extends Controller
{
    //

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function change_date_to_standard($date)
    {
        $date = str_replace('/','-',$date);
        $array = explode('-',$date);
        $year=$array[2];
        $month=$array[1];
        $day=$array[0];
        $date=join('-',[$year,$month,$day]);
        $date=date("Y-m-d",strtotime($date));
        return $date;

    }

    public function index(Request $request)
    {
        $data = [];


        $items = DB::table('inventory_record')
        ->join('items', 'items.id', '=', 'inventory_record.item')
        ->select('items.*', 'inventory_record.*')
        ->get();
        if( $request->isMethod('post') )
        {
        $start_date = $this->change_date_to_standard($request->input('start_date'));
        $end_date =  $this->change_date_to_standard($request->input('end_date'));
        $owner=$request->input('owner');
        if ($owner == null){
        $items = DB::table('inventory_record')

            ->join('items', 'items.id', '=', 'inventory_record.item')
            ->select('items.*', 'inventory_record.*')
            ->whereBetween('inventory_record.date', [$start_date, $end_date])
            ->get();
            // dd($items);

     
        }
        else{
            $items = DB::table('inventory_record')

            ->join('items', 'items.id', '=', 'inventory_record.item')
            ->select('items.*', 'inventory_record.*')
            ->where('items.owner',$owner)
            ->whereBetween('inventory_record.date', [$start_date, $end_date])
            ->get();
            // dd($items);


        }
        
        $data['start_date']= $this->change_date_to_standard( $request->input('start_date')) ;
        $data['end_date']=$this->change_date_to_standard( $request->input('end_date'));

    }
        $print = $request->input('print');

        if(isset($print))
        {
           $start_date = $this->change_date_to_standard( $request->input('start_date')) ;
           $end_date = $this->change_date_to_standard( $request->input('end_date')) ;

           //dd($request->input('start_date'));

           $data['start_date']= $this->change_date_to_standard( $request->input('start_date')) ;
           $data['end_date']=$this->change_date_to_standard( $request->input('end_date'));
           $owner=$request->input('owner');
           
           //dd($owner);
           if ($owner == null){
           $items = DB::table('inventory_record')
   
               ->join('items', 'items.id', '=', 'inventory_record.item')
               ->select('items.*', 'inventory_record.*')
               ->whereBetween('inventory_record.date', [$start_date, $end_date])
               ->get();
            //    dd($items);
   
        
           }
           else{
               $items = DB::table('inventory_record')
   
               ->join('items', 'items.id', '=', 'inventory_record.item')
               ->select('items.*', 'inventory_record.*')
               ->where('items.owner',$owner)
               ->whereBetween('inventory_record.date', [$start_date, $end_date])
               ->get();
            //    dd($items);
   
   
           }
       
           $data['items'] = $items;
           $data['start_date']= $this->change_date_to_standard( $request->input('start_date')) ;
           $data['end_date']=$this->change_date_to_standard( $request->input('end_date'));
  //dd($start_date);
           
           $pdf = PDF::loadView('reports/inventory_report', $data);
           $pdf->save(storage_path().'_filename.pdf');
           return $pdf->stream('sales.pdf');
        }else{
           $data['items'] = $items;
           return view('inventory/inventory_record', $data);
        }

        
        
        $data['items'] = $items;
        //return view('inventory/inventory_record', $data);
    }


    


}
