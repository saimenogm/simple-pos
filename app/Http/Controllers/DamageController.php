<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Damage as Damage;
use App\Item as Item;
use App\Expense as Expense;

use Illuminate\Support\Facades\DB;

use PdfReport;
use PDF;


class DamageController extends Controller
{

    public function __construct(Damage $damage, Item $item, Expense $expense)
    {
        $this->damage = $damage;
        $this->item = $item;
        $this->expense = $expense;

    }

    public function index()
    {
        $data = [];

        $data['damages'] = $this->damage->all ();

        $data['damages'] = DB::table ('items')
            ->join ('damages', 'items.id', '=', 'damages.item')
            ->get ();

        return view ('damages/index', $data);
    }

    public function createDamage(Request $request, Damage $damage)
    {

        $data = [];
//        $data['items'] = DB::table ('items')
//            ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
//            ->select ('items.*', 'item_variants.id as barcode_id', 'item_variants.color', 'item_variants.barcode',
//                'item_variants.size', 'item_variants.unit_price as unit_price_variant')
//            ->where ('item_variants.active', '<>', 0)
//            ->Orwhere ('item_variants.active', '=', null)
//            ->orderBy ('items.item_name')
//            ->get ();

        $data['items'] = DB::table ('items')
//            ->leftjoin ('item_categories', 'items.category', '=', 'item_categories.id')
            ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
            ->select ('items.*', 'item_variants.id as barcode_id', 'item_variants.color', 'item_variants.route',
                'item_variants.dosage','item_variants.uod', 'item_variants.barcode',
                'item_variants.barcode as variant_barcode',
                'item_variants.size', 'item_variants.unit_price as unit_price_variant',
                'item_variants.barcode as barcode', 'item_variants.variant_name')
            ->where ('item_variants.active', '<>', 0)
            ->Orwhere ('item_variants.active', '=', null)
            ->orderBy ('items.item_name')
            ->get ();

        $data['packages'] = DB::table ('item_package')
            ->get ();

        return view ('damages/form', $data);

    }

    public function newDamage(Request $request, Damage $damage)
    {
        $data = [];

        DB::beginTransaction ();

        try {

            if ($request->isMethod ('post'))
                $hi_item = $request->input ('item');
            $item_array = explode ('-', $hi_item);

            $item = $item_array[0];

            $data['date'] = $request->input ('date');
            $data['amount'] = $request->input ('amount');
            $damaged_amount = $request->input ('amount');
            $data['location'] = $request->input ('location');
            $data['reason'] = $request->input ('reason');
            $data['remark'] = $request->input ('remark');
            $data['barcode'] = $request->input ('barcode');
            $data['package'] = $request->input ('package');
            $package_id = $request->input ('package');

            //dd($data['package']);

            // Package Manipulation
            if ($request->input ('package') != null) {
                // There is package

                $package_data = DB::table ('item_package')
                    ->where ('item_package.id', $request->input ('package'))
                    ->first ();

                if ($request->input ('location') == 1) {
                    $package_qty_store = $package_data->qty_store;
                    $package_qty_shop = $package_data->qty_shop - $request->input ('amount');
                    $total_qty = $package_qty_store + $package_qty_shop;

                    DB::table ('item_package')
                        ->where ('item_package.id', $package_id)
                        ->update (['qty_shop' => $package_qty_shop, 'qty_store' => $package_qty_store,
                            'qty_total' => $total_qty]);

                } else if ($request->input ('location') == 2) {

                    $package_qty_store = $package_data->qty_store - $request->input ('amount');
                    $package_qty_shop = $package_data->qty_shop;
                    $total_qty = $package_qty_store + $package_qty_shop;

                    DB::table ('item_package')
                        ->where ('item_package.id', $package_id)
                        ->update (['qty_shop' => $package_qty_shop, 'qty_store' => $package_qty_store,
                            'qty_total' => $total_qty]);

                }
            } else {
                // do nothing
            }


            if ($item_array[1] == null) {

                //dd($request->input ('location'));
                // Item only
                $item_data = $this->item->find ($item_array[0]);
                $data['item'] = $item_array[0];

                $damage->insert ($data);

                $new_amount = $item_data->current_amount - $request->input ('amount');
                $item_data->current_amount = $new_amount;
                $amount_damaged = $request->input ('amount');


                if($request->input ('location')==1){
                    $item_data->qty_shop -= $damaged_amount;
                }elseif ($request->input ('location')==2){
                    $item_data->qty_store -= $damaged_amount;
                }

                $item_data->save ();


                $expense = new Expense();
                $expense->date = $request->input ('date');
                $expense->amount = $request->input ('amount') * $item_data->unit_cost;
                $expense->expense_name = "Damage of " . $item_data->item_name;
                $expense->remark = $request->input ('reason');

                $expense->save ();


                    //$this->calculateTotalItem2 ($request->input ('item'));
                    //$this->calculateTotalItemOnly ($request->input ('item'));

            }
            else {
                // has variants
                $item_data = $this->item->find ($item_array[0]);
                $data['item'] = $item_array[0];

                $damage->date = $request->input ('date');
                $damage->item = $item_array[0];
                $damage->amount = $request->input ('amount');
                $damage->location = $request->input ('location');
                $damage->reason = $request->input ('reason');
                $damage->remark = $request->input ('remark');
                $damage->barcode = $request->input ('barcode');
                $damage->variant = $item_array[1];
                $damage->package = $request->input ('package');

                $damage->save ();


                $new_amount = $item_data->current_amount - $request->input ('amount');
                $item_data->current_amount = $new_amount;
                $amount_damaged = $request->input ('amount');
                $item_data->save ();


//                    $barcode_damaged = $request->input ('barcode');
//                    $barcode = DB::table ('item_variants')
//                        ->where ('item_variants.barcode', $barcode_damaged)
//                        ->first ();
//
//                    // Update that specific variant qty
//                    if ($request->input ('location') == 1) {
//                        $existing_qty = $barcode->shop;
//                        $new_qty = $existing_qty - $amount_damaged;
//
//                        DB::table ('item_variants')
//                            ->where ('id', $barcode->id)
//                            ->update (['shop' => $new_qty]);
//
//                    } else if ($request->input ('location') == 2) {
//                        $existing_qty = $barcode->store;
//                        $new_qty = $existing_qty - $amount_damaged;
//
//                        DB::table ('item_variants')
//                            ->where ('id', $barcode->id)
//                            ->update (['store' => $new_qty]);
//
//                }



                //$this->calculateItemVariantTotal($item_array[1]);

                $barcode_damaged = $item_array[1];
                $barcode = DB::table ('item_variants')
                    ->where ('item_variants.id', $barcode_damaged)
                    ->first ();

                 //Update that specific barcode qty
                if ($request->input ('location') == 1) {
                    $existing_qty = $barcode->shop;
                    $new_qty = $existing_qty - $amount_damaged;

                    DB::table ('item_variants')
                        ->where ('id', $barcode->id)
                        ->update (['shop' => $new_qty]);

                } else if ($request->input ('location') == 2) {
                    $existing_qty = $barcode->store;
                    $new_qty = $existing_qty - $amount_damaged;

                    DB::table ('item_variants')
                        ->where ('id', $barcode->id)
                        ->update (['store' => $new_qty]);

                }

                // Insert it to inventory record
                DB::table ('inventory_record')->insert (
                    ['item' => $item_array[0], 'activity' => 'Damage', 'previous_cost' => $barcode->unit_cost,
                        'units_received' => 0.00, 'units_sold' => $amount_damaged, 'date' => $request->input ('date'),
                        'qty_on_hand' => $new_amount, 'unit_cost' => $barcode->unit_cost, 'total_cost' => $barcode->unit_cost,
                        'vendor' => 0]
                );

                $expense = new Expense();
                $expense->date = $request->input ('date');
                $expense->amount = $request->input ('amount') * $item_data->unit_cost;
                $expense->expense_name = "Damage of " . $item_data->item_name;
                $expense->remark = $request->input ('reason');
                $expense->save ();
            }

            //$this->calculateItemTotal($item);

            DB::commit ();
            return redirect ('damages/');

        } //this is for catch
        catch (Exception $e) {
            DB::rollBack ();
        }
    }

    public function calculateItemVariantTotal($variant_id)
    {

        $total_qty_shop = DB::table ('item_package')
            ->where ('item_package.variant', $variant_id)
            ->sum('qty_shop');

        $total_qty_store = DB::table ('item_package')
            ->where ('item_package.variant', $variant_id)
            ->sum('qty_store');

        DB::table('item_variants')
            ->where('id', $variant_id)
            ->update (['shop' => $total_qty_shop, 'store' => $total_qty_store,
                'current_qty' => $total_qty_shop+$total_qty_store]);

    }

    public function calculateItemTotal($item_id)
    {

        $total_qty_shop = DB::table ('item_package')
            ->where ('item_package.item', $item_id)
            ->sum('qty_shop');

        $total_qty_store = DB::table ('item_package')
            ->where ('item_package.item', $item_id)
            ->sum('qty_store');

        DB::table('items')
            ->where('id', $item_id)
            ->update (['qty_shop' => $total_qty_shop, 'qty_store' => $total_qty_store,
                'current_amount' => $total_qty_shop+$total_qty_store]);

    }

    public function cancelDamage(Request $request, Damage $damage)
    {
        $data = [];

        DB::beginTransaction ();

        try {

            if ($request->isMethod ('post')) {
                $damage_id = $request->input ('damage_id');

                $damage = $this->damage->find ($damage_id);
                $damage->status = "void";
                $damage->save ();


                $barcode_damaged = $damage->variant;
                $barcode = DB::table ('item_variants')
                    ->where ('item_variants.id', $barcode_damaged)
                    ->first ();

                $amount_damaged = $damage->amount;

                // Update that specific barcode qty
                if ($damage->location == 1) {
                    $existing_qty = $barcode->shop;
                    $new_qty = $existing_qty + $amount_damaged;

                    DB::table ('item_variants')
                        ->where ('id', $barcode->id)
                        ->update (['shop' => $new_qty,'current_qty'=>$new_qty+$barcode->store]);
                }
                else if ($damage->location == 2) {
                    $existing_qty = $barcode->store;
                    $new_qty = $existing_qty + $amount_damaged;

                    DB::table ('item_variants')
                        ->where ('id', $barcode->id)
                        ->update (['store' => $new_qty,'current_qty'=>$new_qty+$barcode->shop]);
                }

                $item_data = $this->item->find ($barcode->item);
                $item_data->current_amount += $damage->amount;
                $item_data->save ();

                // Insert it to inventory record
                DB::table ('inventory_record')->insert (
                    ['item' => $barcode->item, 'activity' => 'Damage', 'previous_cost' => 0.00, 'units_received' => $damage->amount, 'units_sold' => 0.00, 'date' => $damage->date, 'qty_on_hand' => $item_data->current_amount, 'unit_cost' => $barcode->unit_cost, 'total_cost' => $barcode->unit_cost, 'vendor' => 0]
                );


                // get item package
                $item_package = DB::table('item_package')
                    ->where('id', $damage->package)
                    ->first();

                if($damage->location==1){
                    //shop
                    DB::table('item_package')
                        ->where('id', $damage->package)
                        ->update(['shop' => $item_package->shop+$damage->amount,
                            'store'=>$item_package->store,
                            'qty_total'=>$item_package->shop+$damage->amount+$item_package->store]);
                }else if($damage->location==2){
                    //store
                    DB::table('item_package')
                        ->where('id', $damage->package)
                        ->update(['qty_shop' => $item_package->qty_shop,
                            'qty_store'=>$item_package->qty_store+$damage->amount,
                            'qty_total'=>$item_package->qty_shop+$damage->amount+$item_package->qty_store]);
                }

                DB::commit ();
                return redirect ('damages/');
            }

            return view ('damages/form', $data);


        } //this is for catch
        catch (Exception $e) {
            DB::rollBack ();


        }

    }

    public function calculateTotalItem2($item_id)
    {
        $barcode_item_shop = DB::table ('item_variants')
            ->where ('item_variants.item', $item_id)
            ->first ();

        DB::table ('items')
            ->where ('id', $item_id)
            ->update (['current_amount' => $barcode_item_shop->shop + $barcode_item_shop->store]);

    }

    public function modify(Request $request, $damage_id, Damage $damage)
    {
        $data = [];

        if ($request->isMethod ('post')) {
            //dd($data);
            $this->validate (
                $request,
                [

                ]
            );


            $damage_data = $this->damage->find ($damage_id);

            $damage_data->item = $request->input ('item');
            $damage_data->amount = $request->input ('amount');
            $damage_data->date = $request->input ('date');
            $damage_data->reason = $request->input ('reason');

            $damage_data->save ();

            return redirect ('damages');
        }

        return view ('damage/detail', $data);
    }

    public function show($damage_id)
    {
        $data = [];

        $data['items'] = DB::table ('items')->get ();
        $data['damage_id'] = $damage_id;
        $data['modify'] = 1;
        $damage_data = $this->damage->find ($damage_id);

        $data['item_id'] = $damage_data->item;
        $data['amount'] = $damage_data->amount;
        $data['date'] = $damage_data->date;
        $data['reason'] = $damage_data->reason;
        $data['status'] = $damage_data->status;

        $data['packages'] = DB::table ('item_package')
            ->get ();

        return view ('damages/detail', $data);
    }

    public function calculateTotalItemOnly($item_id)
    {

        $qty_shop = 0;
        $qty_store = 0;
        $qty_total = 0;

        $item_packages = DB::table ('item_package')
            ->where ('item_package.item', $item_id)
            ->get ();

        foreach ($item_packages as $item_package) {
            $qty_shop += $item_package->qty_shop;
            $qty_store += $item_package->qty_store;
            $qty_total += $item_package->qty_total;
        }

        DB::table ('items')
            ->where ('id', $item_id)
            ->update (['qty_shop' => $qty_shop,
                'qty_store' => $qty_store,
                'current_amount' => $qty_total,
            ]);


    }

    public function getItemPackages(Request $request)
    {
        $input = $request->all();
        $item = $request->item_id;


        try{

            $hi_item = $request->item_id;
            $item_array = explode ('-', $hi_item);
            $item_id = $item_array[0];
            $data['item'] = $item_id;

            if ($item_array[1] == null) {
                // No variant
                $package_data = DB::table ('items')
                    ->leftjoin ('item_package', 'items.id', '=', 'item_package.item')
                    ->where ('items.id', $item_array[0])
                    ->select ('items.id', 'items.item_name', 'items.item_code',
                        'item_package.package_name','item_package.variant',
                        'item_package.qty_shop','item_package.qty_store','item_package.purchase_date','item_package.id')
                    ->orderBy ('items.id')
                    ->get ();
            }else{
                // There is variant
                $package_data = DB::table ('items')
                    ->join ('item_variants', 'items.id', '=', 'item_variants.item')
                    ->join ('item_package', 'items.id', '=', 'item_package.item')
                    ->where ('items.id', $item_array[0])
//                ->where ('item_variants.active', 1)
                    ->where ('item_package.variant', $item_array[1])
//                ->orwhere ('item_variants.active', null)
                    ->select ('items.id', 'items.item_name', 'items.item_code', 'item_variants.id as barcode_id',
                        'item_variants.color', 'item_variants.size','item_package.package_name','item_package.variant',
                        'item_package.qty_shop','item_package.qty_store','item_package.purchase_date','item_package.id')
                    ->orderBy ('items.id')
                    ->get ();

                $package_data = DB::table ('item_package')
//                ->join ('item_variants', 'items.id', '=', 'item_variants.item')
//                ->join ('item_package', 'items.id', '=', 'item_package.item')
                    ->where ('item_package.item', $item_array[0])
//                ->where ('item_variants.active', 1)
                    ->where ('item_package.variant', $item_array[1])
//                ->orwhere ('item_variants.active', null)
                    ->select ('item_package.package_name','item_package.variant',
                        'item_package.qty_shop','item_package.qty_store','item_package.purchase_date','item_package.id')
                    //->orderBy ('items.id')
                    ->get ();

            }

            $output = "<option></option>";


            foreach ($package_data as $package){
                $output.="<option value='".$package->id."'>".$package->package_name."</option>";

//                $output.='<tr>'.
//                         '<td>'.$package->package_name.'<input type="hidden" name="packages_list[]" value="'.$package->id.'"></td>'.
//                         //                     '<td>'.$package->color.'<input type="hidden" name="variant_id[]" value="'.$package->variant.'"></td>'.
//                         '<td>'.$package->purchase_date.'</td>'.
//                         '<td>'.$package->qty_shop.'</td>'.
//                         "<td><input name='qty_shop[]' type='text' value='".$package->qty_shop."'/></td>".
//                         '<td>'.$package->qty_store.'</td>'.
//                         "<td><input name='qty_store[]' type='text' value='".$package->qty_store."'/></td>".
//                         '</tr>';
            }
            return response()->json(['success'=>'success','data'=>$output]);
        }catch(\Exception $e){

//    DB::rollBack();
//    throw $e;
            return response()->json(['success'=>'success','data'=>'error'.$e]);
//$output = $e;
        }
    }

    public function damages_report(Request $request)
    {
        $data = [];

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $print = $request->input('print');



        if(isset($start_date) && isset($end_date) ){

            //dd($start_date);

            // $start_date = str_replace('/','-',$start_date);
            // $array = explode('-',$start_date);
            // $year=$array[2];
            // $month=$array[1];
            // $day=$array[0];
            // $start_date=join('-',[$year,$month,$day]);

            // $end_date = str_replace('/','-',$end_date);
            // $array = explode('-',$end_date);
            // $year=$array[2];
            // $month=$array[1];
            // $day=$array[0];
            // $end_date=join('-',[$year,$month,$day]);

            //$d1=new date_format($start_date,"d/m/Y");


            $data['d1']=date("d/m/Y",strtotime($start_date));
            $data['d2']=date("d/m/Y",strtotime($end_date));
            //dd($d2);


            $data['damages'] = DB::table('damages')
                ->join('items', 'items.id', '=', 'damages.item')
                ->whereBetween('damages.date', [$start_date, $end_date])
                ->get();

            //dd($data['damages']);

            $data['start_date']=$start_date;
            $data['end_date']=$end_date;


            if(isset($print))
            {
                //dd($request->input('start_date'));

                $start_date = $this->change_date_to_standard( $request->input('start_date')) ;
                $end_date = $this->change_date_to_standard( $request->input('end_date')) ;

                $data['start_date']= $this->change_date_to_standard( $request->input('start_date')) ;
                $data['end_date']=$this->change_date_to_standard( $request->input('end_date'));
                $data['damages'] = DB::table('damages')
                    ->join('items', 'items.id', '=', 'damages.item')
                    ->whereBetween('damages.date', [$start_date, $end_date])
                    ->get();

                $pdf = PDF::loadView('reports/damages_report', $data);
                $pdf->save(storage_path().'_filename.pdf');
                return $pdf->stream('damages.pdf');

            }else{
                return view('reports/damages_index', $data);
            }

        }
        return view('payments/report_index', $data);
    }

    public function change_date_to_standard($date)
    {
        $date = str_replace('/','-',$date);
        $array = explode('-',$date);
        $year=$array[2];
        $month=$array[1];
        $day=$array[0];
        $date_new=join('-',[$year,$month,$day]);

        $date_new=date("Y-m-d",strtotime($date_new));

        return $date_new;

    }


}
