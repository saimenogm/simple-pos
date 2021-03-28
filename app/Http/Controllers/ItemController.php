<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item as Item;
use App\ItemCategory as ItemCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use PdfReport;
use PDF;
use QrCode;


class ItemController extends Controller
{
    public function __construct(Item $item, ItemCategory $itemCategory )
    {
        $this->item = $item;
        $this->itemCategory = $itemCategory;
		
    }

    public function index()
    {
        $data = [];

                $data['items'] = DB::table('items')         
                ->select('items.*',DB::raw('items.unit_cost*items.current_amount as total_valuation'))         
                ->where('items.active','=','1')         
                ->orderBy('items.id')         
                ->get();

        $data['items'] = DB::table('items')
        ->select('items.*',DB::raw('items.unit_cost*items.current_amount as total_valuation'))
        ->where('items.active','=','1')
        ->orderBy('items.id')
        ->get();

        return view('items/index', $data);
    }

    public function createItem(Request $request, Item $item)
    {
        $data = [];
        $data['items'] = DB::table('items')
            ->select('items.*',DB::raw('items.unit_cost*items.current_amount as total_valuation'))
            ->where('items.active','=','1')
            ->orderBy('items.id')
            ->get();


        $data['companys']=DB::table('companys')->get();
        //dd($data);
        $data['itemsCategorys'] = $this->itemCategory->all();
        //return view('items/form', $data);
        return view('items/form', $data);
    }

    public function newItem(Request $request, Item $item)
    {
        $data = [];
        
        DB::beginTransaction();
    
        try
        {
            if( $request->isMethod('post') )
            {
    
                $item_barcodes = $request->input('barcode');
                    
                    $item = new Item();
    
                    $itemCategory_id = $request->input('category');
        
                    $itemCategory = $this->itemCategory->find($itemCategory_id);
        
                    $category = $itemCategory->category_name;
        
                    $item->item_name = $request->input('item_name');
                    $item->item_code = $request->input('item_code');
                    $item->variants = $request->input('variant');
                    $item->current_amount = 0.00;//$request->input('current_qty');
                    $item->barcode_generation = $request->input('barcode_generation');
                    $item->remark = $request->input('remark');         
                    $item->description = $request->input('description');                
                    $item->owner = $request->input('owner');
                    $item->company = $request->input('company');
                    $item->category = $itemCategory_id;
                    $item->save();

                    //dd($request->input('variant'));
    
                    $item->itemCategory()->associate($itemCategory); 
                    
                    if($item->variants==false)
                    {
                        // There are no variants
                        $item->barcode_main = "";
                        $item->qty_shop = $request->input('qty_at_shop');
                        $item->qty_store = $request->input('qty_at_store');
                        $item->unit_cost = $request->input('unit_cost');
                        $item->unit_price = $request->input('unit_price');    
                        $item->min_qty = $request->input('min_qty');
                        $item->current_amount = $request->input('qty_at_shop')+$request->input('qty_at_store');
                        $item->variants = 'false';

                        $item->barcode_main = "10".$itemCategory->id."-".$item->id;
                         
                    }else if($item->variants==true){
                        
                        // There are variants
                        
                        
                        $color_list = $request->input('color');
                        $size_list = $request->input('size');
                        $variant_name = $request->input('variant_name');
                        $unit_cost_variant_list = $request->input('unit_cost_variant');
                        $uod_list = $request->input('varity_uod');
                        $dosage_list = $request->input('other_attributes_variant_list');
                        $uom_list = $request->input('uom');

                        $unit_price_variant_list = $request->input('unit_price_variant');
                        $min_qty_variant_list = $request->input('min_qty_variant');
                        $qty_at_shop_variant_list = $request->input('qty_at_shop_variant');
                        $qty_at_store_variant_list = $request->input('qty_at_store_variant');
                        $item_unit_cost = $request->input('unit_cost_variant');
                        $item->unit_cost = 0.00;
                        $item->unit_price =0.00;    
                        $item->min_qty = 0.00;
                        $item->barcode_main = "10".$itemCategory->id."-".$item->id;

                    //dd( $item_unit_cost);
    
                       //dd($color_list);
                       $total=0;
                        $count=count($item_unit_cost);
                        for ($i=0; $i < $count; $i++){
                            $total=$total+$qty_at_shop_variant_list[$i]+$qty_at_store_variant_list[$i];
    
                        }
                        $item->current_amount =$total;
                        for ($i=0; $i < $count; $i++) 
                        {     
//                            $item_barcode_id = DB::table('item_barcodes')->insertGetId(
//                                ['item'=>$item->id,'color' => $color_list[$i] ,'size' => $size_list[$i], 'other_attrib'=>$other_attributes_variant_list[$i],
//                                'shop'=>$qty_at_shop_variant_list[$i],'store'=>$qty_at_store_variant_list[$i],
//                                'unit_cost'=>$unit_cost_variant_list[$i], 'unit_price'=>$unit_price_variant_list[$i],'min_qty'=>$min_qty_variant_list[$i]
//                                , 'barcode'=>'10','is_main'=>1,'location'=>1]
//                            );

                            $item_barcode_id = DB::table('item_variants')->insertGetId(
                                ['item'=>$item->id,'color' => "" ,'size' => "", 'variant_name'=>$variant_name[$i], 'other_attrib'=>"",
                                    'shop'=>$qty_at_shop_variant_list[$i],'store'=>$qty_at_store_variant_list[$i],
                                    'unit_cost'=>$unit_cost_variant_list[$i], 'unit_price'=>$unit_price_variant_list[$i],'min_qty'=>$min_qty_variant_list[$i]
                                    , 'barcode'=>'10','is_main'=>1,'location'=>1,
                                    'route' => '', 'dosage' => $dosage_list[$i], 'uom' => $uom_list[$i], 'uod' => $uod_list[$i],
                                    'min_qty_var' => $min_qty_variant_list[$i]]
//                                    'route' => $route[$i], 'dosage' => $dosage[$i], 'uom' => $uom[$i], 'uod' => $uod[$i],
//                                    'shop' => $shop[$i], 'min_qty_var' => $min_qty_var[$i]]
                            );

                            // Update the barcode
                            // $item_barcode_id

                            DB::table('item_barcodes')
                            ->where('id', $item_barcode_id)
                            ->update(['barcode' => "10".$itemCategory->id."-".$item->id."-".$item_barcode_id]);       
                        }
                    }
                    $item->save();
                    if($request->file('bookcover')){
                    
                    $cover = $request->file('bookcover');
                    $imageName= $cover->getClientOriginalName();
    
                    $extension = $cover->getClientOriginalExtension();
                    
                    $image_path = $category."/".$imageName;
                    $item->image = $image_path;
        
                    request()->file('bookcover')->move(public_path('images/products/'.$category), $imageName);
        
                    }
                    
                    $item->save();
    
                    //return redirect('items');
                    DB::commit();    
                    return redirect('/items/new');
                    
                }
               

          }
           //this is for catch
        catch(Exception $e){
            DB::rollBack();

        }
    }

    public function show($item_id)
    {

        $data = [];
        $data['itemsCategorys'] = $this->itemCategory->all();
        $data['item_id'] = $item_id;

        $data['drug_id'] = $item_id;

        $data['modify'] = 1;
        $item_data = $this->item->find($item_id);
        $data['item_name'] = $item_data->item_name;
        $data['drug_name'] = $item_data->item_name;
        $data['national_drug_code'] = $item_data->national_drug_code;
        $data['drugCategorys'] = $this->itemCategory->all();
        $data['item_code'] = $item_data->item_code;
        $data['min_qty'] = $item_data->min_qty;
        $data['unit_price'] = $item_data->unit_price;
        $data['unit_cost'] = $item_data->unit_cost;
        $data['description'] = $item_data->description;
        $data['image']= $item_data->image;
        $data['qty_store'] = $item_data->qty_store;
        $data['qty_shop']= $item_data->qty_shop;
        $data['category']= $item_data->category;
        $data['current_qty']= $item_data->current_amount;
        $data['barcode_generation']= $item_data->barcode_generation;
        $data['variant']=$item_data->variants;
        $data['current_amount']= $item_data->current_amount;
        $data['company']=$item_data->company;
        $data['owner']= $item_data->owner;
        $data['remark']= $item_data->remark;
        $data['item_order'] = $item_data->item_order;

        $data['companys']=DB::table('companys')->get();

        $barcode_list = DB::table('item_barcodes')
            ->where('item_barcodes.item','=',$item_id )
            ->where('item_barcodes.active','=',1)
            ->get();

        $data['packages'] = DB::table('item_package')
            ->join ('items','items.id','=','item_package.item')
            ->where('item_package.item','=',$item_id )
            ->select('items.*','item_package.*')
            ->get();

        $data['batchs'] = DB::table('item_package')
            ->join ('items','items.id','=','item_package.item')
            ->where('item_package.item','=',$item_id )
            ->select('items.*','item_package.*')
            ->get();


        $data['varities']=DB::table('item_variants')
            ->where('item',$item_id)
            ->get();

        $data['warnings']=DB::table('drug_warnings')
            ->where('drug_warnings.drug',$item_id)
            ->get();

        $data['side_effects']=DB::table('drug_side_effects')
            ->where('drug_side_effects.drug',$item_id)
            ->get();


        $data['drug_interactions']=DB::table('interactions')
            ->join ('items','items.id','=','interactions.drug_id')
            ->join ('items as interacting_items','interacting_items.id','=','interactions.drug')
            ->where('interactions.drug_id',$item_id)
            ->select ('items.item_name','interacting_items.item_name as interacting_name','interactions.*')
            ->get();


        return view('items/detail', $data)->with('barcode_list',$barcode_list);
    }

    public function modify( Request $request, $item_id, Item $item )
    {
        $data = [];

        DB::beginTransaction();

        try
        {
            if( $request->isMethod('post') )
            {
                $item = $this->item->find($item_id);
                //dd($item_id);


                $previous_barcode = $item->barcode_generation;

                $initial_variant_status = $item->variants;

                $item->item_name = $request->input('item_name');
                $item->item_code = $request->input('item_code');
                $item->description = $request->input('description');
                //$item->variants = $request->input('variant');
                $item->unit_cost = $request->input('unit_cost');
                $item->unit_price = $request->input('unit_price');
                $item->min_qty = $request->input('min_qty');
                $item->current_amount =  $item->current_amount;
                $item->category = $request->input('category');
                $item->barcode_generation = $request->input('barcode_generation');
                $item->remark = $request->input('remark');
                $item->owner = $request->input('owner');
                $item->company = $request->input('company');
                $item->item_order = $request->input('item_order');

                //dd($request->input('has_variants'));

                if($request->input('has_variants')==null || $request->input('has_variants')=='null'){
                    $item->variants = 'false';
                    //dd("its null");
                }elseif($request->input('has_variants')==1 || $request->input('has_variants')=='1'){
                    $item->variants = 'true';
                    //dd("its one");
                }


                $itemCategory = $this->itemCategory->find($request->input('category'));

                $category_name = $itemCategory->category_name;

                $item->save();

                if($initial_variant_status==false || $initial_variant_status=='false'){

                    //dd($item->variants);
                    // There are no variants
                    //                $item->barcode_main = "";
                    $item->qty_shop = $request->input('qty_shop');
                    $item->qty_store = $request->input('qty_store');
                    $item->current_amount = $request->input('qty_shop')+$request->input('qty_store');

                    if($item->barcode_main=""){
                        $item->barcode_main = "10".$request->input('category')."-".$item->id;
                    }
                    $item->save();

                }
                else if($initial_variant_status==true || $initial_variant_status=='true') {

                    // There are variants

                    $variant_id = $request->input ('variant_id');

                    $route = 0;
                    $dosage = 0;
                    $uom = 0;
                    $uod = 0;
                    $variant_name = $request->input ('variant_name');
                    $unit_price = $request->input ('varity_unit_price');
                    $unit_cost = $request->input ('varity_unit_cost');
                    $shop = $request->input ('shop');
                    $store = $request->input ('store');
                    $min_qty_var = $request->input ('min_qty_var');
                    $view_pkg = $request->input ('pkg');
                    $varitiy_count = count ($unit_price);
                    // dd($route);

                    for ($i = 0; $i < $varitiy_count; $i++) {

                        if ($variant_id[$i] == 'new') {

                            $item_barcode_id = DB::table('item_variants')->insertGetId(
                                ['item'=>$item->id,'variant_name'=>$variant_name[$i],'color' => "" ,'size' => "", 'other_attrib'=>"",
                                    'shop'=>$shop[$i],'store'=>$store[$i],
                                    'unit_cost'=>$unit_cost[$i], 'unit_price'=>$unit_price[$i],'min_qty'=>$min_qty_var[$i]
                                    , 'barcode'=>'10','is_main'=>1,'location'=>1,
                                    'route' => 0, 'dosage' => 0, 'uom' => $uom[$i], 'uod' =>0,
                                    'shop' => $shop[$i], 'min_qty_var' => $min_qty_var[$i]]
                            );

                            // Update the barcode
                            // $item_barcode_id

                            DB::table('item_variants')
                                ->where('id', $item_barcode_id)
                                ->update(['barcode' => "1011"."-".$item->id."-".$item_barcode_id]);
                            //                          ->update(['barcode' => "10".$itemCategory->id."-".$item->id."-".$item_barcode_id]);

                        } else {
                            DB::table ('item_variants')
                                ->where ('id', $variant_id[$i])
                                ->update (
                                    ['item' => $item->id,'variant_name'=>$variant_name[$i], 'route' => $route[$i], 'dosage' => $dosage[$i],
                                        'uom' => $uom[$i], 'uod' => $uod[$i], 'unit_cost' => $unit_cost[$i], 'unit_price' => $unit_price[$i],
                                        'shop' => $shop[$i],'store' => $store[$i], 'min_qty_var' => $min_qty_var[$i]]
                                );

                        }
                    }

                    $item_variants = DB::table ('item_variants')
                        ->where ('item_variants.item', $item->id)
                        ->get ();

                    $total_shop =0;
                    $total_store =0;
                    $total_item_qty = 0;
                    $costing_sum= 0;

                    foreach ($item_variants as $item_variant){
                        $total_shop += $item_variant->shop;
                        $total_store+= $item_variant->store;
                        $costing_sum+= ($item_variant->current_qty)*$item_variant->unit_cost;

                    }
                    $total_item_qty = $total_shop+$total_store;

                    DB::table ('items')
                        ->where ('items.id', $item->id)
                        ->update (['qty_shop' => $total_shop, 'qty_store' => $total_store,
                            'unit_cost' => $costing_sum/$total_item_qty,
                            'current_amount' => $total_item_qty]);
                $item->save();
                }

                $item->save();
                DB::commit();
                return redirect('items');
            }


        }
        catch(Exception $e){
            DB::rollBack();



        }

    }

    public function item_report(Request $request)
    {
                $data['items'] = DB::table('items')         
                ->select('items.*',DB::raw('items.unit_cost*items.current_amount as total_valuation'))         
                ->where('items.active','=','1')         
                ->orderBy('items.id')         
                ->get();

        //dd($data);
        $pdf = PDF::loadView('reports/item_report', $data);

        $pdf->save(storage_path().'_filename.pdf');

        // Finally, you can download the file using download function
        return $pdf->stream('customers.pdf');
    }

    public function delete_drug_varity(Request $request)
    {

        try{

            $id=$request->id;
            $drug=$request->drug;

            DB::table('item_variants')->where('id', '=', $id)->delete();
            DB::table('variant_default')->where('variant_id',$id)->delete();
            $varities = DB::table('item_variants')
                ->where('item', '=', $drug)
                ->get();

            $return_data = "";

            foreach($varities as $varity){

                $return_data .= "<tr><td hidden><input name='variant_id[]' value='".$varity->id."'/>/</td>";
                $return_data .= "<td><select class='form-control' id='route' name='varity_route[]'><option value='".$varity->route."'>".$varity->route."</option><option value='Tablet'>Tablet</option><option value='Injectable'>Injectable</option><option value='Wrap'>Wrap</option><option value='Syrup'>Syrup</option></select></td>";
                $return_data .= "<td><INPUT type='text' class='form-control' value='".$varity->variant_name."' name ='variant_name[]' id='variant_name'  placeholder='variant_name'/></td>";
                $return_data .= "<td><select class='form-control' id='uom' name='varity_uom[]'><option value='".$varity->uom."'>".$varity->uom."</option><option value='mg'>mg</option><option value='ml'>ml</option></select></td>";
                $return_data .= "<td><select class='form-control' id='uod' name='varity_uod[]'><option value='".$varity->uod."'>".$varity->uod."</option><option value='Box'>Box</option><option value='Strip'>Strip</option><option value='Bottle'>Bottle</option><option value='PCs'>PCs</option></select></td>";
                $return_data .= "<td><INPUT type='text' class='form-control' name='varity_unit_cost[]' id='lngbox' placeholder='Cost' value='".$varity->unit_cost."' required/></td>";
                $return_data .="<td><INPUT type='text' class='form-control' name='varity_unit_price[]'   id='unit_price' placeholder='price' value='".$varity->unit_price."'  required/></td>";
                $return_data .="<td><INPUT type='text' class='form-control' name='shop[]' id='lngbox' placeholder='Current Qty'  value='".$varity->shop."'  required/></td>";
                $return_data .="<td><INPUT type='text' class='form-control' name='min_qty_var[]' id='lngbox' placeholder='Min Qty' value='".$varity->min_qty_var."'  required/></td>";
                $return_data .="<TD><a role='button' onclick='getDrug(".$varity->id.");' class='btn btn-warning'>Default Values</a></TD>";
                $return_data .="<td><a role='button' value='Delete' class='btn btn-danger' onclick='del_varity(".$varity->id.");'>Delete</a></td</tr>";





            }


            return response()->json(['edited_varities'=>$return_data,'id'=>$id]);

        }
        catch(\Exception $e){

            DB::rollBack();
            //throw $e;
            return response()->json(['edited_varities'=>$e,'item'=>'error'.$e]);
        }
        return response()->json(['edited_varities'=>'generic','item'=>'item_success']);


    }

    public function show_item_history($item_id)
    {
        $data = []; 

        $item_data = $this->item->find($item_id);
        $data['item_name'] = $item_data->item_name;
        $data['item_code'] = $item_data->item_code;
        $data['min_qty'] = $item_data->min_qty;
        $data['current_qty'] = $item_data->current_amount;
        $data['unit_price'] = $item_data->unit_price;
        $data['unit_cost'] = $item_data->unit_cost;
        $data['previous_cost'] = $item_data->previous_cost;
        $data['description'] = $item_data->description;
               

        $data['items'] = DB::table('inventory_record')
        ->join('items', 'items.id', '=', 'inventory_record.item')
        ->where("item", "=",$item_id)
        ->get();
 
        //$data['sales'] = $this->sale->all();
        return view('inventory/inventory_record_item', $data);

    }

    public function show_barcode_history($item_id)
    {
        $data = []; 

        $item_data = $this->item->find($item_id);

        $data['items'] = DB::table('items')
        ->join('item_barcodes', 'items.id', '=', 'item_barcodes.item')
        ->where("item", "=",$item_id)
        ->get();
 
        //$data['sales'] = $this->sale->all();
        return view('inventory/inventory_barcode_item', $data);


    }

    public function item_threshold()
    {
        $data=[];

        $data['under_min_items']=DB::table('items')
            ->whereColumn('current_amount','<=','min_qty')
            ->get();
        return view('items/under_min', $data);
    }

    public function delete_item(Request $request,$item_id)
    {
        DB::beginTransaction();
    
        try
        {      
            $item = $this->item->find($item_id);
            $item->active = 0;
            $item->save();
            
            $data = [];
    
                    $data['items'] = DB::table('items')     
                    ->select('items.*',DB::raw('items.unit_cost*items.current_amount as total_valuation'))      
                    ->where('items.active','=','1')
                    ->orderBy('items.id')
                    ->get();
                    DB::commit();          
            return view('items/index', $data);

          }
           //this is for catch
        catch(Exception $e){
            DB::rollBack();
            
        
        
        }    
        
        
    }



    public function expiration_date_month()
    { 
        $current_date=date('Y-m-d');
        $current_month=date('m');
        $current_year=date('Y');
        $current_day=date('d');
        //dd($current_date);
        if($current_month >11)
        { 
            $expire_month=1;
            $expire_year=$current_year+1;
        
        }
        else{

            $expire_month=$current_month+1;
            $expire_year=$current_year;

        }
        $expire_date=join('-',[$expire_year,$expire_month,$current_day]);
        
        //dd($expire_date);
      $data=[];
      $data['items'] = DB::table('purchase_items')
	            ->join('items', 'items.id', '=', 'purchase_items.item')
                ->whereBetween('expire_date', [$current_date, $expire_date])
                ->get();
          
                return view('items/items_expiring_in_one_month', $data);
    }

    public function expiration_date_three()
    { 
        $current_date=date('Y-m-d');
        $current_month=date('m');
        $current_year=date('Y');
        $current_day=date('d');
        //dd($current_date);
        if($current_month >9)
        { 
            $expire_month=($current_month+3)-12;
            $expire_year=$current_year+1;
        
        }
        else{

            $expire_month=$current_month+3;
            $expire_year=$current_year;

        }
        $expire_date=join('-',[$expire_year,$expire_month,$current_day]);
        
        //dd($expire_date);
      $data=[];
      $data['items'] = DB::table('purchase_items')
	            ->join('items', 'items.id', '=', 'purchase_items.item')
                ->whereBetween('expire_date', [$current_date, $expire_date])
                ->get();
          
                return view('items/items_expiring_in_three_month', $data);
    

    }  
    
    public function expiration_date_six()
    { 
        $current_date=date('Y-m-d');
        $current_month=date('m');
        $current_year=date('Y');
        $current_day=date('d');
        //dd($current_date);
        if($current_month >6)
        { 
            $expire_month=($current_month+3)-12;
            $expire_year=$current_year+1;
        
        }
        else{

            $expire_month=$current_month+6;
            $expire_year=$current_year;

        }
        $expire_date=join('-',[$expire_year,$expire_month,$current_day]);
        
        //dd($expire_date);
      $data=[];
      $data['items'] = DB::table('purchase_items')
	            ->join('items', 'items.id', '=', 'purchase_items.item')
                ->whereBetween('expire_date', [$current_date, $expire_date])
                ->get();
          
                return view('items/items_expiring_in_six_month', $data);

    }  

    public function expiration_date_year()
    { 
        $current_date=date('Y-m-d');
        $current_month=date('m');
        $current_year=date('Y');
        $current_day=date('d');
        //dd($current_date);
       
            $expire_year=$current_year+1;
            $expire_month=$current_month;

            $expire_date=join('-',[$expire_year,$expire_month,$current_day]);
        
        //dd($expire_date);
        $data=[];
        $data['items'] = DB::table('purchase_items')
	            ->join('items', 'items.id', '=', 'purchase_items.item')
                ->whereBetween('expire_date', [$current_date, $expire_date])
                ->get();
          
                return view('items/items_expiring_in_one_year', $data);
    

    }
    
    public function expiration_date_user(Request $request)
    { 
        $data=[];
        $start_date = $request->input('start_date');
       

        if(isset($start_date) ){

            $start_date = str_replace('/','-',$start_date);
            $array = explode('-',$start_date);
            $year=$array[2];
            $month=$array[1];
            $day=$array[0];
            $expire_date=join('-',[$year,$month,$day]);
        
            $current_date=date('Y-m-d');
        
              $data['items'] = DB::table('purchase_items')
	            ->join('items', 'items.id', '=', 'purchase_items.item')
                ->whereBetween('expire_date', [$current_date, $expire_date])
                ->get();
                return view('items/items_expiration', $data);
    
        }else{
            return view('items/items_expiration');
        }
    }

    public function generate_qr(Request $request)
    {

        $code = $request->input('code');

        $data['qr'] = QrCode::size(200)->generate($code);
        return view('test/qr',$data);

    }

    public function default_varity(Request $request){

        try{

            $id=$request->id;
            $freq=$request->freq;
            $default_dosage=$request->default_dosage;
            $default_uom=$request->default_uom;
            $defualt_duration_day=$request->defualt_duration_day;
            $default_duration=$request->default_duration;
            $default_route=$request->default_route;
            DB::table('variant_default')->where('variant_id',$id)->delete();
            DB::table('variant_default')->insert(
                ['variant_id' => $id,
                    'freq'=>$freq,
                    'dosage'=>$default_dosage,
                    'duration_time'=>$default_duration,
                    'duration_day'=>$defualt_duration_day,
                    'uom'=>$default_uom,
                    'route'=>$default_route,
                ]
            );
            return response()->json(['edited_varities'=>"success",'id'=>$id]);

        }
        catch(\Exception $e){

            DB::rollBack();
            //throw $e;
            return response()->json(['edited_varities'=>$e,'item'=>'error'.$e]);
        }
        return response()->json(['edited_varities'=>'generic','item'=>'item_success']);
    }

    public function get_drug_varity_default(Request $request){


        try{

            $id=$request->id;
            $data=DB::table('variant_default')->where('variant_id',$id)->first();

            return response()->json(['edited_varities'=>$data,'id'=>$id]);

        }
        catch(\Exception $e){

            DB::rollBack();
            //throw $e;
            return response()->json(['edited_varities'=>$e,'item'=>'error'.$e]);
        }
        return response()->json(['edited_varities'=>'generic','item'=>'item_success']);

    }

    public function getItemPackages(Request $request)
    {
        DB::beginTransaction();

        try{

            $input = $request->all();

            $item_id = $request->item_id;
            $variant_id = $request->variant_id;
            $package_tracking = $request->package_tracking;
            $index = $request->index;

            // return response()->json(['success'=>'May be SUCCESSFUL'.$item_id.' '.$variant_id.' '.$package_tracking.' '.$index.'kkkk','item'=>'error','barcode'=>'hiiiii']);

            $item_data = "";

            $count = 0;

            //$sale->save();

            //DB::commit();
            // @click='update_package(index)'

            $select_options = "<select id='pkg_".$index."'  name=$index onclick='update_package_js(this)'>
        ";

            if($package_tracking==1)
            {

                $item_data = DB::table ('current_transactions')
                    ->join ('item_package','item_package.id','=','current_transactions.package')
                    ->where ('current_transactions.user_id', '=', 1)
                    ->where("current_transactions.item_id", "=",$item_id)
                    ->where("current_transactions.barcode_id", "=",$variant_id)
                    ->select ('current_transactions.package','item_package.package_name')
                    ->first ();

                $item_count = DB::table ('current_transactions')
                    ->join ('item_package','item_package.id','=','current_transactions.package')
                    ->where ('current_transactions.user_id', '=', 1)
                    ->where("current_transactions.item_id", "=",$item_id)
                    ->where("current_transactions.barcode_id", "=",$variant_id)
                    ->select ('current_transactions.package','item_package.package_name')
                    ->count ();

                if($item_count==1)
                {
                    $item_packages = DB::table('item_package')
                        ->where("item", "=",$item_id)
                        ->where("variant", "=",$variant_id)
                        ->where("qty_shop", ">",0)
                        ->where("status", "=",'active')
                        ->get();

                }else{
                    $item_packages = DB::table('item_package')
                        ->where("item", "=",$item_id)
                        ->where("variant", "=",$variant_id)
                        ->where("qty_shop", ">",0)
                        ->where("status", "=",'active')
                        ->get();
                }

                if($item_data!=null)
                {
                    foreach($item_packages as $package)
                    {
                        if($item_data->package==$package->id){
                            $select_options .= "<option selected value=".$item_data->package.">".$item_data->package_name."</option>";
                        }else{
                            $select_options .= "<option value=".$package->id.">".$package->package_name."</option>";
                        }
                        $count++;
                    }
                }else{
                    foreach($item_packages as $package)
                    {
                        $select_options .= "<option value=".$package->id.">".$package->package_name."</option>";
                        $count++;
                    }
                }

            }

            $select_options .= "</select>";

            return response()->json(['success'=>'DONE'.$item_id,'item'=>$item_id,'variant_id'=>$variant_id,'package_tracking'=>$package_tracking
                ,'select_options'=>$select_options,'item_data'=>$item_data,'select_count'=>$count]);

        }catch(\Exception $e){

            DB::rollBack();
            //throw $e;
            return response()->json(['success'=>'UN SUCCESSFUL'.$e,'item'=>'error'.$e,'barcode'=>$e]);
        }
    }

    public function getItemInteractions(Request $request)
    {
        DB::beginTransaction();

        try{

            $input = $request->all();

            $items_list = DB::table ('current_transactions')
                ->where ('user_id', '=', 1)
                ->get ();

//            $items_list = $request->items_list;

            $items_list_count = count($items_list);

            $all_interactions = "";
            $all_interactions_contradicting = "";

            $count_records=0;

            // return response()->json(['success'=>'DONE'.$items_list]);

            for ($x=0;$x<$items_list_count;$x++) {

                for ($y=$x;$y<$items_list_count;$y++) {

//                    $interaction = DB::select('select interactions.* from interactions where drug_id='.$items_list[$x]['item_id'].' and drug='.$items_list[$y]['item_id']);


                    $count_records = DB::table ('interactions')
                        ->join('items','items.id','=','interactions.drug_id')
                        ->join('items as item_interacting','item_interacting.id','=','interactions.drug')
                        ->select ('interactions.*','items.item_name','item_interacting.item_name as interacting_item_name')
                        ->where ('interactions.drug_id', '=', $items_list[$y]->item_id)
                        ->where ('interactions.drug', '=', $items_list[$x]->item_id)->count();

                    if($count_records>0){

                        $interactions = DB::table ('interactions')
                            ->join('items','items.id','=','interactions.drug_id')
                            ->join('items as item_interacting','item_interacting.id','=','interactions.drug')
                            ->select ('interactions.*','items.item_name','item_interacting.item_name as interacting_item_name')
                            ->where ('interactions.drug_id', '=', $items_list[$y]->item_id)
                            ->where ('interactions.drug', '=', $items_list[$x]->item_id)
                            ->first ();


                        //$interactions = $x.'-'.$y;
                        if($interactions->status=='Contraindicated'){

                            $all_interactions_contradicting .='<span style="color:red;"><B> * '.$interactions->item_name.'-'.$interactions->interacting_item_name.':<U>'.$interactions->status.'- </U></B> '.$interactions->description.'</span><br/>';

                        }elseif ($interactions->status=='Serious - Use Alternative'){

//                            $all_interactions_contradicting .='<span style="color:darkorange;"><B> * '.$interactions->item_name.'-'.$interactions->interacting_item_name.':<U>'.$interactions->status.'- </U></B>'.$interactions->description.'</span><br/>';
                            $all_interactions_contradicting .='<span style="color:red;"><B>* '.$interactions->item_name.'-'.$interactions->interacting_item_name.':<U>'.$interactions->status.'- </U></B>'.$interactions->description.'</span><br/>';

                        }else{
                            $all_interactions .='<span style="color:darkviolet;"><B> * '.$interactions->item_name.'-'.$interactions->interacting_item_name.':<U>'.$interactions->status.'- </U></B>'.$interactions->description.'</span><br/>';

                        }

                    }


                    if($count_records<=0){
                        $count_records = DB::table ('interactions')
                            ->select ('interactions.*')
                            ->where ('interactions.drug_id', '=', $items_list[$x]->item_id)
                            ->where ('interactions.drug', '=', $items_list[$y]->item_id)->count();

                        if($count_records>0){

                            $interactions = DB::table ('interactions')
                                ->join('items','items.id','=','interactions.drug_id')
                                ->join('items as item_interacting','item_interacting.id','=','interactions.drug')
                                ->select ('interactions.*','items.item_name','item_interacting.item_name as interacting_item_name')
                                ->where ('interactions.drug_id', '=', $items_list[$x]->item_id)
                                ->where ('interactions.drug', '=', $items_list[$y]->item_id)
                                ->first ();

                            if($interactions->status=='Contraindicated'){

                                $all_interactions_contradicting .='<span style="color:red;"><B> *'.$interactions->item_name.'-'.$interactions->interacting_item_name.':<U>'.$interactions->status.' </U></B> -'.$interactions->description.'</span><br/>';

                            }elseif ($interactions->status=='Serious - Use Alternative'){

                                $all_interactions_contradicting .='<span style="color:red;"><B> *'.$interactions->item_name.'-'.$interactions->interacting_item_name.':<U>'.$interactions->status.'</U></B>- '.$interactions->description.'</span><br/>';

                            }else{
                                $all_interactions .='<span style="color:darkviolet;"><B> *'.$interactions->item_name.'-'.$interactions->interacting_item_name.':<U>'.$interactions->status.'</U></B>- '.$interactions->description.'</span><br/>';

                            }

                        }

                    }

                }

            }



            return response()->json(['success'=>'DONE','datas'=>$all_interactions_contradicting.$all_interactions]);

        }catch(\Exception $e){

            DB::rollBack();
            //throw $e;
            return response()->json(['success'=>'UN SUCCESSFUL'.$e,'item'=>'error'.$e,'barcode'=>$e]);
        }
    }

}
