<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Transfer as Transfer;
use App\Product as Product;
use App\TransferItem as TransferItem;
use App\Item as Item;
use App\Customer as Customer;
use App\Location as Location;

use Illuminate\Support\Facades\DB;


class TransferController extends Controller
{

    public function __construct(Transfer $transfer, Customer $customer, Item $item, Location $location)
    {

        $this->transfer = $transfer;
        $this->customer = $customer;
        $this->item = $item;
        $this->location = $location;

    }

    public function index()
    {
        $data = [];

        $data['transfers'] = DB::table ('transfers')
            ->join ('locations', 'transfers.source', '=', 'locations.id')
            ->join ('locations as destination', 'transfers.destination', '=', 'destination.id')
            ->select ('transfers.*', 'transfers.id as transfer_id', 'locations.location_name as source_location',
                'destination.location_name as destination_location')
            ->get ();

        return view ('transfers/index', $data);
    }

    public function createTransfer(Request $request, Transfer $transfer)
    {
        $data = [];

        $data['customers'] = $this->customer->all ();

        $data['items'] = DB::table ('items')
            ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
            ->where ('item_variants.active', 1)
            ->orwhere ('item_variants.active', null)
            ->select ('items.*', 'item_variants.id as barcode_id', 'item_variants.color', 'item_variants.barcode',
                'item_variants.size', 'item_variants.variant_name')
            ->orderBy ('items.id')
            ->get ();

        $data['checker'] = 'false';

        $data['locations'] = DB::table ('locations')
            ->get ();

        $data['packages'] = DB::table ('item_package')
            ->get ();

        return view ('transfers/form1', $data);

    }

    public function newTransfer(Request $request, Transfer $transfer)
    {
        $data = [];

        if ($request->isMethod ('post')) {

            DB::beginTransaction ();

            try {

                $transfer = new Transfer();
                $transfer->source = $request->input ('source');
                $transfer->destination = $request->input ('destination');
                $date_posted = $request->input ('date');
                //$packages_list = $request->input ('package');
                //dd($request->input('package'));
                $date_replaced = str_replace ('/', '-', $date_posted);

                $array = explode ('-', $date_replaced);

                $year = $array[2];
                $month = $array[1];
                $day = $array[0];
                $date_formatted = join ('-', [$year, $month, $day]);
                $transfer->date = $date_posted;
                $transfer->transfered_by = 1;//$request->input('transfered_by');


                $transferItem = new TransferItem();

                $itemamount_list = $request->input ('amount');


                $itemid_list = $request->input ('item');
                $item_list = $request->input ('item');
                $qty_list = $request->input ('amount');
                //$barcode_list = $request->input ('barcode');


                $transfer->save ();

                $count = count ($itemid_list);
                $total_amount = 0.00;

                for ($i = 0; $i < $count; $i++) {

                    $item_array = explode ('-', $itemid_list[$i]);

                    if ($item_array[1] == null) {
                        // No variants

                        $transferItem = new TransferItem();
                        $transferItem->item = $item_array[0];
                        $transferItem->amount = $itemamount_list[$i];

                        $transferItem->transfer ()->associate ($transfer);
                        $transferItem->save ();

                        $item = $this->item->find ($item_array[0]);
                        $current_cost = $item->unit_cost;
                        $previous_cost = $item->unit_cost;
                        $current_amount = $item->current_amount;

                        $sold_qty = $qty_list[$i];

                        $new_cost = $current_cost;
                        $new_amount = $current_amount - $sold_qty;
                        //$item->current_amount = $new_amount;
// dd($transfer->source);

                        if ($transfer->source == 1) {
                            $item->qty_shop -= $qty_list[$i];
                            $item->qty_store += $qty_list[$i];
                            DB::table ('inventory_record')->insert (
                                ['item' => $item->id, 'activity' => 'Transfer out', 'previous_cost' => $previous_cost, 'units_received' => 0.00,
                                    'units_sold' => $qty_list[$i], 'date' => $transfer->date, 'qty_on_hand' => $item->qty_shop + $item->qty_store, 'unit_cost' => $current_cost,
                                    'total_cost' => $qty_list[$i] * $new_cost, 'location' => $request->input ('source'), 'ref_id' => $transfer->id]
                            );
                        } else {
                            $item->qty_shop += $qty_list[$i];
                            $item->qty_store -= $qty_list[$i];
                            DB::table ('inventory_record')->insert (
                                ['item' => $item->id, 'activity' => 'Transfer in', 'previous_cost' => $previous_cost, 'units_received' => $qty_list[$i],
                                    'units_sold' => $sold_qty, 'date' => $transfer->date, 'qty_on_hand' => $item->qty_shop + $item->qty_store, 'unit_cost' => $new_cost,
                                    'total_cost' => $qty_list[$i] * $new_cost, 'location' => $request->input ('destination'), 'ref_id' => $transfer->id]
                            );
                        }


                        $item->save ();
                    } else {

                        $transferItem = new TransferItem();
                        $transferItem->item = $item_array[0];
                        $transferItem->amount = $itemamount_list[$i];
                        $transferItem->variant = $item_array[1];

                        $transferItem->transfer ()->associate ($transfer);
                        $transferItem->save ();

                        $item = $this->item->find ($item_array[0]);
                        $current_cost = $item->unit_cost;
                        $previous_cost = $item->unit_cost;
                        $current_amount = $item->current_amount;

                        $sold_qty = $qty_list[$i];

                        $new_cost = $current_cost;
                        // $new_amount = $current_amount-$sold_qty;
                        // $item->current_amount = $new_amount;
                        $item->save ();

                        $barcode_item_store = DB::table ('item_variants')
                            ->where ('item_variants.id', $item_array[1])
                            ->first ();


                        $barcode_item_store = DB::table ('item_variants')
                            ->where ('item_variants.id', $item_array[1])
                            ->first ();


                        $current_cost = $barcode_item_store->unit_cost;
                        $previous_cost = $barcode_item_store->unit_cost;


                        if ($transfer->source == 1) {
                            // Source is shop
                            DB::table ('item_variants')
                                ->where ('item_variants.id', $item_array[1])
                                ->update (['shop' => $barcode_item_store->shop - $qty_list[$i], 'store' => $barcode_item_store->store + $qty_list[$i]]);

                            DB::table ('inventory_record')->insert (
                                ['item' => $item->id, 'activity' => 'Transfer out', 'previous_cost' => $previous_cost, 'units_received' => 0.00,
                                    'units_sold' => $qty_list[$i], 'date' => $transfer->date, 'qty_on_hand' => $barcode_item_store->store + $barcode_item_store->shop, 'unit_cost' => $current_cost, 'total_cost' => $qty_list[$i] * $new_cost, 'location' => $request->input ('source'), 'ref_id' => $transfer->id]
                            );

                        } else {
                            // Source is store
                            DB::table ('item_variants')
                                ->where ('item_variants.id', $item_array[1])
                                ->update (['shop' => $barcode_item_store->shop + $qty_list[$i], 'store' => $barcode_item_store->store - $qty_list[$i]]);

                            DB::table ('inventory_record')->insert (
                                ['item' => $item->id, 'activity' => 'Transfer in', 'previous_cost' => $previous_cost,
                                    'units_received' => $qty_list[$i], 'units_sold' => $sold_qty, 'date' => $transfer->date, 'qty_on_hand' => $barcode_item_store->store + $barcode_item_store->shop, 'unit_cost' => $current_cost, 'total_cost' => $qty_list[$i] * $new_cost, 'location' => $request->input ('destination'), 'ref_id' => $transfer->id]
                            );

                        }

                    }

                    //$this->calculateItemTotal ($item_array[0]);
                    //dd($item_array[1]);
//                    if($item_array[1]!=null){
//                        $this->calculateItemVariantTotal($item_array[1]);
//                    }

                }

                DB::commit ();

                return redirect ('transfers/');

            } catch (\Exception $e) {

                DB::rollBack ();
                throw $e;
                //return response()->json(['failure'=>'success','item'=>'error'.$e,'barcode'=>$e]);

            }
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

    public function cancelTransfer(Request $request, Transfer $transfer)
    {
        $data = [];

        if ($request->isMethod ('post')) {
            // get transfer
            $transfer_id = $request->input ('transfer_id');
            $transfer = $this->transfer->find ($transfer_id);

            $transfer_items = DB::table ('transfers')
                ->join ('transfer_items', 'transfer_items.transfer_id', '=', 'transfers.id')
                ->where ('transfers.id', $transfer_id)
                ->get ();

            $transfer->status = 'void';

            $transfer->save ();

            $count = count ($transfer_items);
            $total_amount = 0.00;

            DB::table ('transfer_items')
                ->where ('transfer_id', $transfer_id)
                ->update (['status' => 'void']);


            if ($transfer->source == 1) {
                // Source is Shop
                foreach ($transfer_items as $transferItem) {
                    //$item_array = explode('-', $transferItem->item);

                    if ($transferItem->variant == null) {

                        $item_data = $this->item->find ($item_array[0]);
                        $item_data->shop += $transferItem->amount;
                        $item_data->store -= $transferItem->amount;
                        $item_data->save ();

                    } else {
                        $barcode_item_source = DB::table ('item_variants')
                            ->where ('item_variants.item', $transferItem->item)
                            ->where ('item_variants.id', $transferItem->variant)
                            ->first ();

                        // From shop to store
                        DB::table ('item_variants')
                            ->where ('item_variants.item', $transferItem->item)
                            ->update (['item_variants.shop' => $barcode_item_source->shop + $transferItem->amount, 'item_variants.store' => $barcode_item_source->store - $transferItem->amount]);
                    }

                }
            }
        } else {
            // Source is in store
            foreach ($transfer_items as $transferItem) {
                $item_array = explode ('-', $transferItem->item);

                if ($item_array[1] == null) {

                    $item_data = $this->item->find ($item_array[0]);
                    $item_data->shop += $transferItem->amount;
                    $item_data->store -= $transferItem->amount;
                    $item_data->save ();

                } else {
                    $barcode_item_source = DB::table ('item_variants')
                        ->where ('item_variants.item', $transferItem->item)
                        ->where ('item_variants.id', $transferItem->variant)
                        ->first ();

                    // From shop to store
                    DB::table ('item_variants')
                        ->where ('item_variants.item', $transferItem->item)
                        ->update (['item_variants.shop' => $barcode_item_source->shop + $transferItem->amount, 'item_variants.store' => $barcode_item_source->store - $transferItem->amount]);
                }
            }
        }
        return redirect ('transfers/');
    }

    public function change_date_to_readable($date)
    {
        $date = date ("d/m/Y", strtotime ($date));
        return $date;

    }

    public function show($transfer_id)
    {
        $data = [];
        //dd($transfer_id);
        $data['modify'] = 1;
        $data['transfer_id'] = $transfer_id;
        //$supplier_data = $this->transfers->find($transfers_id);

        $data['transfers'] = DB::table ('transfers')
            ->join ('locations', 'transfers.source', '=', 'locations.id')
            ->join ('locations as destination', 'transfers.destination', '=', 'destination.id')
            ->select ('transfers.*', 'transfers.id as transfer_id', 'locations.location_name as source_location',
                'destination.location_name as destination_location')
            ->where ('transfers.id', $transfer_id)->first ();

        //dd($transfer_id);
        //dd($data['transfers']);

        $data['transfer_items'] = DB::table ('transfer_items')
            ->join ('items', 'items.id', '=', 'transfer_items.item')
            ->where ('transfer_id', $transfer_id)
            ->get ();

        // dd($data['transfer_items']);
        //$data['supplier_name'] = $supplier_data->supplier_name;
//       $data['transfer_date']= $this->change_date_to_readable($data['transfers']->date);
        return view ('transfers/detail', $data);

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

        //dd("shlkdfjsdklf");
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



}
