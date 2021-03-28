<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Adjustment as Adjustment;
use Illuminate\Support\Facades\DB;


class AdjustmentController extends Controller
{
    //

    public function __construct(Adjustment $adjustment)
    {
        $this->adjustment = $adjustment;

    }

    public function index()
    {
        $data = [];

        $data['adjustments'] = $this->adjustment->all ();
        //dd($data['adjustments']);

        $data['adjustments'] = DB::table ('items')
            ->join ('adjustments', 'items.id', '=', 'adjustments.item')
            ->get ();
        //dd($data['adjustments']);
        return view ('adjustments/index', $data);
    }

    public function newAdjustment(Request $request, Adjustment $adjustment)
    {

        DB::beginTransaction ();

        try {

            $data = [];
            $data['date'] = $request->input ('date');
            $data['location'] = $request->input ('location');
            $data['barcode'] = $request->input ('barcode');
            $data['real_amount'] = $request->input ('real_amount');
            $data['reason'] = $request->input ('reason');
            $hi_item = $request->input ('item');
            $item_array = explode ('-', $hi_item);
            $item_id = $item_array[0];
            $data['item'] = $item_id;

            $data['package_id'] = $request->input ('package');
            $package_id = $request->input ('package');

            if ($request->input ('package') != null) {
                // There is package

                $package_data = DB::table ('item_package')
                    ->where ('item_package.id', $request->input ('package'))
                    ->first ();

                if ($request->input ('location') == 1)
                {
                    $package_qty_store = $package_data->qty_store;
                    $package_qty_shop = $request->input ('real_amount');
                    $total_qty = $package_qty_store + $package_qty_shop;

                    DB::table ('item_package')
                        ->where ('item_package.id', $package_id)
                        ->update (['qty_shop' => $package_qty_shop, 'qty_store' => $package_qty_store,
                            'qty_total' => $total_qty]);

                } else if ($request->input ('location') == 2) {

                    $package_qty_store = $request->input ('real_amount');
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

            if ($item_array[1] == "") {
                ///varities will be pass as null
            } else {
                $data['varities'] = $item_array[1];
            }

            if ($item_array[1] == null) {
                $item = DB::table ('items')
                    ->where ('id', $item_id)
                    ->first ();
                // Update the barcode qty
                if ($request->input ('location') == 1) {

                    DB::table ('items')
                        // ->where('barcode', $request->input('barcode'))
                        ->where ('id', $item_id)
                        ->update (['qty_shop' => $request->input ('real_amount'), 'current_amount' => $request->input ('real_amount') + $item->qty_store]);
                } else if ($request->input ('location') == 2) {
                    DB::table ('items')
                        //->where('barcode', $request->input('barcode'))
                        ->where ('id', $item_id)
                        ->update (['qty_store' => $request->input ('real_amount'), 'current_amount' => $request->input ('real_amount') + $item->qty_shop]);
                }

                $this->calculateTotalItem2 ($item_id);

            } else {

                // There are variants
                $item = DB::table ('item_variants')
                    // ->where('barcode', $request->input('barcode'))
                    ->where ('item', $item_array[0])
                    ->first ();

                if ($request->input ('location') == 1) {

                    DB::table ('item_variants')
                        ->where ('id', $item_array[1])
                        ->where ('item', $item_array[0])
                        ->update (['shop' => $request->input ('real_amount')]);


                } else if ($request->input ('location') == 2) {
                    DB::table ('item_variants')
                        ->where ('id', $item_array[1])
                        ->where ('item', $item_array[0])
                        ->update (['store' => $request->input ('real_amount')]);
                }
                $items_with_variant = DB::table ('item_variants')
                    ->where ('item', $item_array[0])
                    ->where ('active', 1)
                    ->get ();

                // dd($items_with_variant);
                $total = 0;
                $count = count ($items_with_variant);
                for ($i = 0; $i < $count; $i++) {
                    $total = $total + $items_with_variant[$i]->shop + $items_with_variant[$i]->store;
                }

                DB::table ('items')
                    //->where('barcode', $request->input('barcode'))
                    ->where ('id', $item_array[0])
                    ->update (['current_amount' => $total]);

            }

            $adjustment->insert ($data);

            // Insert it to inventory record
//            DB::table('inventory_record')->insert(
//                ['item' => $item_id ,'activity'=>'Adjustment','previous_cost'=>0.00, 'units_received' =>0.00,'units_sold'=>0.00,'date'=>$request->input('date'),'qty_on_hand'=>$request->input('real_amount'),'unit_cost'=>0.00,'total_cost'=>0.00,'vendor'=>0]
//           );


            DB::commit ();
            return redirect ('adjustments/');

        } catch (Exception $e)
        {
            return view ('adjustments/form');
        }
    }

    public function newAdjustment2(Request $request, Adjustment $adjustment)
    {

        DB::beginTransaction ();

        try {

            $data = [];
            $data['date'] = $request->input ('date');
            $hi_item = $request->input ('item');
            $item_array = explode ('-', $hi_item);
            $item_id = $item_array[0];
            $data['item'] = $item_id;

//            $data['package_id'] = $request->input ('package');
            $package_id = $request->input ('package');

            $packages_list = $request->input ('packages_list');
            $shop_qty_list = $request->input ('qty_shop');
            $store_qty_list = $request->input ('qty_store');
            $variant_list = $request->input ('variant_id');

            $counter =0;

            //dd($packages_list);

            foreach ($packages_list as $package){
                $package_id = $package;
                    DB::table ('item_package')
                        ->where ('item_package.id', $package_id)
                        ->update (['qty_shop' => $shop_qty_list[$counter], 'qty_store' => $store_qty_list[$counter],
                            'qty_total' => $shop_qty_list[$counter]+$store_qty_list[$counter]]);

                    $counter++;
            }

            if($item_array[1]!=null && $item_array[1]!=""){
                $this->calculateItemVariantTotal($item_array[1]);
            }

            $this->calculateItemTotal ($item_id);

            DB::commit ();
            return redirect ('adjustments/');

        } catch (Exception $e)
        {

dd($e);
//            return view ('adjustments/form');
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

    public function getItemPackages(Request $request)
    {
        $input = $request->all();
        $item = $request->item_id;


        try{

        $hi_item = $request->item_id;
        $item_array = explode ('-', $hi_item);
        $item_id = $item_array[0];
        $data['item'] = $item_id;
//
//
        if ($item_array[1] == null) {
        // No variant
            $package_data = DB::table ('items')
                ->leftjoin ('item_package', 'items.id', '=', 'item_package.item')
                ->where ('items.id', $item_array[0])
//                ->where ('item_package.variant', $item_array[1])
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

        $output = "";

        foreach ($package_data as $package){
            $output.='<tr>'.
                     '<td>'.$package->package_name.'<input type="hidden" name="packages_list[]" value="'.$package->id.'"></td>'.
//                     '<td>'.$package->color.'<input type="hidden" name="variant_id[]" value="'.$package->variant.'"></td>'.
                     '<td>'.$package->purchase_date.'</td>'.
                     '<td>'.$package->qty_shop.'</td>'.
                     "<td><input name='qty_shop[]' type='text' value='".$package->qty_shop."'/></td>".
                     '<td>'.$package->qty_store.'</td>'.
                     "<td><input name='qty_store[]' type='text' value='".$package->qty_store."'/></td>".
                     '</tr>';
        }
        return response()->json(['success'=>'success','data'=>$output]);
        }catch(\Exception $e){

//    DB::rollBack();
//    throw $e;
                return response()->json(['success'=>'success','data'=>'error'.$e]);
//$output = $e;
            }
    }

    public function createAdjustment(Request $request, Adjustment $adjustment)
    {
        $data = [];
        $data['items'] = DB::table ('items')
            ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
            ->where ('item_variants.active', 1)
            ->orwhere ('item_variants.active', null)
            ->select ('items.id', 'items.item_name', 'items.item_code', 'item_variants.id as barcode_id',
                'item_variants.color', 'item_variants.size')
            ->orderBy ('items.id')
            ->get ();


        $data['locations'] = DB::table ('locations')->get ();
        $data['packages'] = DB::table ('item_package')
            ->get ();

        return view ('adjustments/form', $data);
    }

    public function createAdjustment2(Request $request, Adjustment $adjustment)
    {
        $data = [];
        $data['items'] = DB::table ('items')
            ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
            ->where ('item_variants.active', 1)
            ->orwhere ('item_variants.active', null)
            ->select ('items.id', 'items.item_name', 'items.item_code', 'item_variants.id as barcode_id',
                'item_variants.color', 'item_variants.size')
            ->orderBy ('items.id')
            ->get ();


        $data['locations'] = DB::table ('locations')->get ();
        $data['packages'] = DB::table ('item_package')
            ->get ();

        return view ('adjustments/form', $data);
    }

//    public function calculateTotalItem($item_id)
//    {
//        //dd($item_id);
//        $barcode_item_shop = DB::table ('item_variants')
//            ->where ('item_variants.item', $item_id)
//            ->where ('item_variants.location', 1)
//            ->first ();
//
//        //dd($barcode_item_shop);
//        //dd($barcode_item_shop);
//        $barcode_item_store = DB::table ('item_variants')
//            ->where ('item_variants.item', $item_id)
//            ->where ('item_variants.location', 2)
//            ->first ();
//
//        DB::table ('items')
//            ->where ('id', $item_id)
//            ->update (['current_amount' => $barcode_item_shop->current_qty + $barcode_item_store->current_qty]);
//
//    }
//
//    public function calculateTotalItem2($item_id)
//    {
//        $barcode_item_shop = DB::table ('items')
//            ->where ('id', $item_id)
//            ->first ();
//
//        DB::table ('items')
//            ->where ('id', $item_id)
//            ->update (['current_amount' => $barcode_item_shop->qty_shop + $barcode_item_shop->qty_store]);
//
//    }
//
//    public function modify(Request $request, $adjustment_id, Adjustment $adjustment)
//    {
//        $data = [];
//        DB::beginTransaction ();
//
//        try {
//            if ($request->isMethod ('post')) {
//                //dd($data);
//                $this->validate (
//                    $request,
//                    [
//
//                    ]
//                );
//
//
//                $adjustment_data = $this->adjustment->find ($adjustment_id);
//                // dd($adjustment_data);
//
//                $adjustment_data->real_amount = $request->input ('real_amount');
//                $adjustment_data->date = $request->input ('date');
//                $adjustment_data->reason = $request->input ('reason');
//                $adjustment_data->location = $request->input ('item_location');
//                $adjustment_data->barcode = $request->input ('barcode');
//                $item_id = $request->input ('item_selected_name');
//
//                $adjustment_data->save ();
//
//
//                if ($adjustment_data->varities == null) {
//                    $item = DB::table ('items')
//                        // ->where('barcode', $request->input('barcode'))
//                        ->where ('id', $item_id)
//                        ->first ();
//
//                    // Update the barcode qty
//                    if ($request->input ('item_location') == 1) {
//
//                        DB::table ('items')
//                            // ->where('barcode', $request->input('barcode'))
//                            ->where ('id', $request->input ('item_selected_name'))
//                            ->update (['qty_shop' => $request->input ('real_amount'), 'current_amount' => $request->input ('real_amount') + $item->qty_store]);
//                    } else if ($request->input ('item_location') == 2) {
//                        DB::table ('items')
//                            //->where('barcode', $request->input('barcode'))
//                            ->where ('id', $request->input ('item_selected_name'))
//                            ->update (['qty_store' => $request->input ('real_amount'), 'current_amount' => $request->input ('real_amount') + $item->qty_shop]);
//                    }
//
//                    $this->calculateTotalItem2 ($request->input ('item'));
//
//
//                } else {
//                    $item = DB::table ('item_variants')
//                        // ->where('barcode', $request->input('barcode'))
//                        ->where ('id', $adjustment_data->varities)
//                        ->where ('item', $request->input ('item_selected_name'))
//                        ->first ();
//                    // dd($item);
//
//
//                    if ($request->input ('item_location') == 1) {
//
//
//                        DB::table ('item_variants')
//                            ->where ('item', $request->input ('item_selected_name'))
//                            ->where ('id', $adjustment_data->varities)
//                            ->update (['shop' => $request->input ('real_amount')]);
//                    } else if ($request->input ('item_location') == 2) {
//                        DB::table ('item_variants')
//                            ->where ('id', $adjustment_data->varities)
//                            ->where ('item', $request->input ('item_selected_name'))
//                            ->update (['store' => $request->input ('real_amount')]);
//                    }
//
//                    $items_with_variant = DB::table ('item_variants')
//                        ->where ('item', $request->input ('item_selected_name'))
//                        ->where ('active', 1)
//                        ->get ();
//                    // dd($items_with_variant);
//                    $total = 0;
//                    $count = count ($items_with_variant);
//                    for ($i = 0; $i < $count; $i++) {
//                        $total = $total + $items_with_variant[$i]->shop + $items_with_variant[$i]->store;
//
//                    }
//                    DB::table ('items')
//                        //->where('barcode', $request->input('barcode'))
//                        ->where ('id', $request->input ('item_selected_name'))
//                        ->update (['current_amount' => $total]);
//
//
//                }
//
//                return redirect ('adjustments');
//            }
//
//            return view ('adjustments/detail', $data);
//
//
//            DB::commit ();
//        } catch (\Exception $e) {
//
//            DB::rollBack ();
//            return view ('adjustments/form');
//        }
//
//
//    }

    public function show($adjustment_id)
    {
        $data = [];

        $data['adjustment_id'] = $adjustment_id;
        $data['modify'] = 1;
        $adjustment_data = $this->adjustment->find ($adjustment_id);
        $data['items'] = DB::table ('items')
            ->where ('id', $adjustment_data->item)
            ->first ();
        $data['item_id'] = $adjustment_data->item;
        $data['real_amount'] = $adjustment_data->real_amount;
        $data['date'] = $adjustment_data->date;
        $data['location'] = $adjustment_data->location;
        $data['barcode'] = $adjustment_data->barcode;
        $data['reason'] = $adjustment_data->reason;
        //dd($data);
        $data['loc'] = DB::table ('locations')
            ->where ('id', $data['location'])
            ->select ('locations.location_name')
            ->first ();
        // dd($data['loc']->location_name);


        return view ('adjustments/detail', $data)->with ('loc', $data['loc']->location_name);
    }


}
