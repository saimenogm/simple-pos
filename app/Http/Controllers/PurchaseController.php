<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Purchase as Purchase;
use App\Item as Item;
use App\PurchaseItem as PurchaseItem;
use App\Journal as Journal;
use App\JournalItem as JournalItem;
use App\Supplier as Supplier;
use PdfReport;
use PDF;

class PurchaseController extends Controller
{

    public function __construct(Purchase $purchase, Customer $customer, Item $item, Supplier $supplier)
    {
        $this->purchase = $purchase;
        $this->customer = $customer;
        $this->item = $item;
        $this->supplier = $supplier;
    }

    public function index()
    {
        $data = [];

        $data['purchases'] = DB::table ('suppliers')
            ->join ('purchases', 'suppliers.id', '=', 'purchases.supplier')
            ->orderBy ('purchases.id', 'desc')
            ->get ();

        return view ('purchases/index', $data);
    }

    public function create()
    {
        $suppliers = DB::table ('suppliers')->get ();

        $items = DB::table ('items')
            ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
            ->select ('items.id', 'items.item_name', 'items.item_code', 'item_variants.id as barcode_id',
                'item_variants.color', 'item_variants.size','item_variants.route','item_variants.variant_name')
            ->where ('item_variants.active', 1)
            ->orwhere ('item_variants.active', null)
            ->orderBy ('items.item_name')
            ->get ();

        return view (
            'purchases/form',
            ['suppliers' => $suppliers, 'items' => $items, 'customers' => $suppliers]
        );
    }

    public function store(Request $request)
    {

        $purchase = new Purchase();
        $purchase->supplier = $request->input ('supplier');
        $purchase->payment_mode = $request->input ('payment');

        $date_posted = $request->input ('date');
        $date_replaced = str_replace ('/', '-', $date_posted);

        $date_formatted = $date_replaced;

        $purchase->date = $date_formatted;
        $purchase->ref = $request->input ('ref');
        $purchase->total_amount = 0.00;
        $total_amount = 0.00;
        $user = auth ()->user ();
        $purchase->user = $user->id;
        $purchase->save ();


        $item_list = $request->input ('item');
        $unit_price_list = $request->input ('unit_price');
        $qty_list = $request->input ('qty');
        $subtotal_list = $request->input ('sub_total_h');
        $shop_list = $request->input ('shop');
        $store_list = $request->input ('store');
        $batch_list = $request->input ('batch_name');
        $expire_date_list = $request->input ('expire_date');
        $shop = $request->input ('shop');
        $store = $request->input ('store');


        $items_list = $request->input ('item');
        $date_input = $date_formatted;
        $count = count ($qty_list);
        $items_number = count ($items_list);


        for ($i = 0; $i < $count; $i++)
        {
            $hi_item = $item_list[$i];
            $item_array = explode ('-', $hi_item);

            if ($item_array[1] == null)
            {
                // No variant (Item Only)
                $purchaseItem = new PurchaseItem();
                $purchaseItem->item = $item_array[0];
                $purchaseItem->qty = $qty_list[$i];
                $purchaseItem->unit_price = $unit_price_list[$i];
                $purchaseItem->shop = $shop[$i];
                $purchaseItem->store = $store[$i];
                $purchaseItem->sub_total = $unit_price_list[$i] * $qty_list[$i];

                $total_amount += ($unit_price_list[$i] * $qty_list[$i]);
                $purchase->total_amount = $total_amount;

                if ($expire_date_list[$i] == null || $expire_date_list[$i] == "")
                {
                    $date_requested = null;
                } else {
                    $date_requested = $expire_date_list[$i];
                }

                $purchaseItem->expire_date = $expire_date_list[$i];
                $purchaseItem->purchase ()->associate ($purchase);
                $purchaseItem->save ();

                // insert into the packages list
                $package_id = DB::table ('item_package')->insertGetId (
                    ['item' => $purchaseItem->item, 'package_name' => $batch_list[$i], 'variant' => 0,
                        'expire_date' => $expire_date_list[$i], 'unit_cost' => $unit_price_list[$i],
                        'qty_store' => $store[$i], 'qty_shop' => $shop[$i], 'qty_total' => $shop[$i] + $store[$i],
                        'purchase_id'=>$purchase->id
                    ]
                );

                // item package transactions
                DB::table ('item_package_transactions')->insert (
                    ['item' => $purchaseItem->item,
                        'package_id' => $package_id,
                        'variant' => 0,
                        'transaction_type' => 'Purchase',
                        'qty_store' => $store[$i],
                        'qty_shop' => $shop[$i],
                        'qty_total' => $shop[$i] + $store[$i],
                        'amount_change' => $shop[$i] + $store[$i],
                        'balance' => $shop[$i] + $store[$i],
                    ]
                );

                $item = $this->item->find ($purchaseItem->item);

                $current_cost = $item->unit_cost;
                $previous_cost = $item->unit_cost;
                $current_amount = $item->current_amount;

                $purchased_cost = $unit_price_list[$i];
                $purchased_qty = $qty_list[$i];

                $new_cost = (($current_cost * $current_amount) + ($purchased_cost * $purchased_qty)) / ($current_amount + $purchased_qty);
                $new_amount = $current_amount + $purchased_qty;

                $previous_qty = $item->current_amount;

                $item->unit_cost = $new_cost;
                $item->current_amount = $new_amount;
                $item->qty_shop += $shop_list[$i];
                $item->qty_store += $store_list[$i];

                //$this->calculateTotalItemOnly($purchaseItem->item);

                $item->save ();

                // Insert it to inventory record
                DB::table ('inventory_record')->insert (
                    ['item' => $item->id, 'activity' => 'Purchase', 'qty_previous' => $previous_qty,
                        'previous_cost' => $previous_cost, 'units_received' => $purchaseItem->qty, 'units_sold' => 0.00,
                        'date' => $purchase->date, 'qty_on_hand' => $item->current_amount, 'unit_cost' => $item->unit_cost,
                        'total_cost' => $item->unit_cost * $purchaseItem->qty, 'vendor' => $purchase->supplier, 'ref_id' => $purchase->id]
                );
            }
            else {
                // There is a variant
                // Add to the shop of the variant of the item expire_date

                $purchaseItem = new PurchaseItem();
                $purchaseItem->item = $item_array[0];
                $purchaseItem->qty = $qty_list[$i];
                $purchaseItem->expire_date = $expire_date_list[$i];
                $purchaseItem->unit_price = $unit_price_list[$i];
                $purchaseItem->shop = $shop[$i];
                $purchaseItem->store = $store[$i];
                $purchaseItem->variant = $item_array[1];
                $purchaseItem->sub_total = $unit_price_list[$i] * $qty_list[$i];

                $total_amount += ($unit_price_list[$i] * $qty_list[$i]);
                $purchase->total_amount = $total_amount;

                $purchaseItem->purchase ()->associate ($purchase);
                $purchaseItem->save ();

                // Check for package existence

                // insert into the packages list
                $package_id = DB::table ('item_package')->insertGetId (
                        ['item' => $purchaseItem->item, 'package_name' => $batch_list[$i], 'variant' => $purchaseItem->variant,
                            'expire_date' => $expire_date_list[$i], 'unit_cost' => $unit_price_list[$i],
                            'qty_store' => $store[$i], 'qty_shop' => $shop[$i], 'qty_total' => $shop[$i] + $store[$i],
                            'purchase_id'=>$purchase->id
                        ]
                    );

                $item = $this->item->find ($purchaseItem->item);

                DB::table ('item_package')
                        ->where ('id', $package_id)
                        ->update (['barcode' => $item->barcode_main . "-" . $purchaseItem->variant . "-" . $package_id,]);

                    // item package transactions
                    DB::table ('item_package_transactions')->insert (
                        ['item' => $purchaseItem->item,
                            'package_id' => $package_id,
                            'variant' => $purchaseItem->variant,
                            'transaction_type' => 'Purchase',
                            'qty_store' => $store[$i],
                            'qty_shop' => $shop[$i],
                            'qty_total' => $shop[$i] + $store[$i],
                            'amount_change' => $shop[$i] + $store[$i],
                            'balance' => $shop[$i] + $store[$i],
                        ]
                    );

                $purchase->total_amount = $total_amount;


                $barcode_item_store = DB::table ('item_variants')
                    ->where ('item_variants.id', $item_array[1])
                    ->first ();

                $barcode_item_shop = $barcode_item_store;

                $previous_qty = $barcode_item_shop->shop + $barcode_item_store->store;

                $new_cost = (($barcode_item_store->unit_cost * ($barcode_item_store->store + $barcode_item_store->shop)) + ($purchaseItem->unit_price * ($purchaseItem->store + $purchaseItem->shop))) / (($purchaseItem->store + $purchaseItem->shop) + ($barcode_item_store->store + $barcode_item_store->shop));

                $existing_qty_shop = $barcode_item_shop->shop;
                $existing_qty_store = $barcode_item_store->store;

                $new_qty_shop = $existing_qty_shop + $shop[$i];
                $new_qty_store = $existing_qty_store + $store[$i];

                $current_amount = $new_qty_store + $new_qty_shop;

                DB::table ('item_variants')
                    ->where ('item_variants.id', $item_array[1])
                    ->update (['shop' => $new_qty_shop, 'store' => $new_qty_store,
                        'unit_cost' => $new_cost, 'current_qty' => $new_qty_store + $new_qty_shop]);

                DB::table ('purchases_items_barcode')->insert (
                    ['item' => $item->id, 'purchase_id' => $purchase->id, 'purchases_items_barcode_id' => $item_array[1], 'shop' => $shop[$i], 'store' => $store[$i]]
                );

                DB::table ('inventory_record')->insert (
                    ['item' => $item->id,
                        'activity' => 'Purchase',
                        'qty_previous' => $previous_qty,
                        'previous_cost' => $barcode_item_store->unit_cost,
                        'units_received' => $purchaseItem->qty,
                        'units_sold' => 0.00, 'date' => $purchase->date,
                        'qty_on_hand' => $current_amount, 'unit_cost' => $new_cost,
                        'total_cost' => $new_cost * $purchaseItem->qty, 'vendor' => $purchase->supplier,
                        'ref_id' => $purchase->id, 'item_variant' => $item_array[1]]
                );

                $item_variants = DB::table ('item_variants')
                    ->where ('item_variants.item', $item_array[0])
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
                    ->where ('items.id', $item_array[0])
                    ->update (['qty_shop' => $total_shop, 'qty_store' => $total_store,
                        'unit_cost' => $costing_sum/$total_item_qty,
                        'current_amount' => $total_item_qty]);
                //$this->calculateTotalItemOnly($purchaseItem->item);
            }
        }

        if ($request->input ('payment') == 'Cash')
        {
            $purchase->status = 'Paid';
            $purchase->payment_status = 'Paid';
            $purchase->amount_paid=$purchase->total_amount;
        }
        if ($purchase->payment_mode == "Credit")
        {
            $supplier = $this->supplier->find ($request->input ('supplier'));
            $supplier->balance += $purchase->total_amount;
            $supplier->save ();
        }

        $purchase->save ();

        return redirect ('purchases');
    }

    public function show($purchases_id)
    {
        $data = [];

        $data['suppliers'] = $this->supplier->all ();
        $data['purchase_id'] = $purchases_id;
        $data['modify'] = 1;

        $data['purchases'] = DB::table ('suppliers')
            ->join ('purchases', 'suppliers.id', '=', 'purchases.supplier')
            ->where ('purchases.id', $purchases_id)
            ->first ();

        $data['purchases_item'] = DB::table ('purchases')
            ->join ('purchase_items', 'purchase_items.purchase_id', '=', 'purchases.id')
            ->join ('items', 'items.id', '=', 'purchase_items.item')
            ->leftjoin ('item_variants', 'purchase_items.variant', '=', 'item_variants.id')
            ->select ('items.item_name', 'purchase_items.qty', 'item_variants.*', 'purchase_items.unit_price',
                'purchase_items.sub_total',
                'purchase_items.expire_date', 'purchase_items.barcode', 'purchase_items.shop', 'purchase_items.store')
            ->where ('purchases.id', $purchases_id)
            ->get ();

        $data['purchase_date'] = $this->change_date_to_readable ($data['purchases']->date);
        return view ('purchases/detail', $data);
    }

    public function cancelPurchase(Request $request)
    {
        //~ cancel purchase
        //~ cancel purchase items
        //~ cancel inventory records
        //~ reverse the additions
        //~ reverse the cost

        DB::beginTransaction ();

        try {
            // cancel purchase
            $purchase_id = $request->input ('purchase_id');
            $purchases_id = $purchase_id;
            $purchase = $this->purchase->find ($purchase_id);
            $purchase->status = 'void';
            $purchase->save ();


            // cancel purchase items
            // Update items to void
            DB::table ('purchase_items')
                ->where ('purchase_id', $purchases_id)
                ->update (['status' => 'void']);


            DB::table ('item_package')
                ->where ('purchase_id', $purchases_id)
                ->update (['status' => 'void']);

            // Update inventory_record to void
            DB::table ('inventory_record')
                ->where ('ref_id', $purchases_id)
                ->where ('activity', 'Purchase')
                ->update (['status' => 'void']);


            $purchase_items_barcode = DB::table ('purchase_items')
                ->where ('purchase_id', $purchases_id)
                ->get ();


            $barcode_counts = count ($purchase_items_barcode);

            if ($barcode_counts > 0)
            {
                for ($i = 0; $i < $barcode_counts; $i++) {

                    if ($purchase_items_barcode[$i]->variant == 0) {

                        // If it is an item

                        $item = $this->item->find ($purchase_items_barcode[$i]->item);
                        $current_amount = $item->current_amount;

                        $item->qty_shop = $item->qty_shop - $purchase_items_barcode[$i]->shop;
                        $item->qty_store = $item->qty_store - $purchase_items_barcode[$i]->store;
                        $item->current_amount = $item->qty_shop + $item->qty_store;

                        $amount_to_reduce = $purchase_items_barcode[$i]->shop + $purchase_items_barcode[$i]->store;
                        // result = total_qty*current_cost - qty_to_reduce*cost_purchased
                        // cost = above_result/current_qty
                        $result = $current_amount*$item->unit_cost - $amount_to_reduce*$purchase_items_barcode[$i]->unit_price;
                        if($item->current_amount==0){
                            $new_cost=0.00;
                        }else{
                            $new_cost = $result/$item->current_amount;
                        }

//                        $new_cost = (($item->unit_cost * $current_amount) + ($purchased_cost * $purchased_qty)) / ($current_amount + $purchased_qty);
                        $item->unit_cost = $new_cost;
                        $item->save ();

                    }
                    else {

                        // If it is a variant

                        $barcode = DB::table ('item_variants')
                            ->where ('item_variants.id', $purchase_items_barcode[$i]->variant)->first ();

                        // dd($barcode);

                        // Update that specific barcode qty
                        $existing_qty_shop = $barcode->shop;
                        $existing_qty_store = $barcode->store;
                        $new_qty_shop = $existing_qty_shop - $purchase_items_barcode[$i]->shop;
                        $new_qty_store = $existing_qty_store - $purchase_items_barcode[$i]->store;

                        // result = total_qty*current_cost - qty_to_reduce*cost_purchased
                        // cost = above_result/current_qty
                        $current_amount = $existing_qty_shop + $existing_qty_store;
                        $amount_to_reduce = $purchase_items_barcode[$i]->shop + $purchase_items_barcode[$i]->store;
                        $result = $current_amount*$barcode->unit_cost - $amount_to_reduce*$purchase_items_barcode[$i]->unit_price;
                        $new_cost = $result/($new_qty_shop + $new_qty_store);
                        //dd($new_cost);

                        DB::table ('item_variants')
                            ->where ('id', $barcode->id)
                            ->update (['shop' => $new_qty_shop, 'unit_cost'=>$new_cost,'store' => $new_qty_store, 'current_qty' => $new_qty_shop + $new_qty_store]);
                    }
                }
            }

            DB::commit ();

            $data = [];

            $data['purchases'] = $this->purchase->all ();

            return redirect ('purchases');

        } catch (\Exception $e) {

            DB::rollBack ();
            throw $e;
            //return response()->json(['failure'=>'success','item'=>$sub_total[1],'barcode'=>$items_qty[0]]);

        }

        $data = [];

        $data['purchases'] = $this->purchase->all ();

        return redirect ('purchases');
    }

    public function purchase_report(Request $request)
    {
        $data = [];

        $data['users'] = DB::table ('users')
            ->get ();

        $start_date = $request->input ('start_date');
        $end_date = $request->input ('end_date');
        $print = $request->input ('print');


        if (isset($start_date) && isset($end_date)) {

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


            $data['d1'] = date ("d/m/Y", strtotime ($start_date));
            $data['d2'] = date ("d/m/Y", strtotime ($end_date));
            //dd($end_date);
            $user = $request->input ('user');
            $sales = [];

            if ($request->input ('user') != null) {
                //dd($request->input('user'));
                $data['purchases'] = DB::table ('purchases')
                    ->Where ('user', $user)
                    ->join ('suppliers', 'suppliers.id', '=', 'purchases.supplier')
                    ->whereBetween ('date', [$start_date, $end_date])
                    ->get ();
                $sales['purchases'] = $data['purchases'];

            } else {
                $data['purchases'] = DB::table ('purchases')
                    ->join ('suppliers', 'suppliers.id', '=', 'purchases.supplier')
                    ->join ('users', 'users.id', '=', 'purchases.user')
                    ->whereBetween ('date', [$start_date, $end_date])
                    ->get ();
                $sales['purchases'] = $data['purchases'];


            }
            //$data['sales'] = $this->sale->all();

            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $sales['start_date'] = $start_date;
            $sales['end_date'] = $end_date;

        if (isset($print)) {


                $start_date = $request->input ('start_date');
                $end_date = $request->input ('end_date');

                //dd($request->input('start_date'));
                $data['purchases'] = DB::table ('purchases')
                    ->join ('users', 'users.id', '=', 'purchases.user')
                    ->join ('suppliers', 'suppliers.id', '=', 'purchases.supplier')
                    ->whereBetween ('date', [$start_date, $end_date])
                    ->where ('status', '<>', 'void')
                    ->get ();

                $pdf = PDF::loadView ('reports/purchase_report', $data);
                $pdf->save (storage_path () . '_filename.pdf');
                return $pdf->stream ('purchases.pdf');

            } else {
                return view ('purchases/report_purchases', $data);
            }

        }
        return view ('purchases/report_purchases', $data);
    }


    // Other Functions
    public function change_date_to_readable($date)
    {
        $date = date ("d/m/Y", strtotime ($date));
        return $date;

    }

    public function calculateTotalItemOnly($item_id)
    {

        $qty_shop = 0;
        $qty_store = 0;
        $qty_total = 0;

        $item_packages = DB::table ('item_package')
            ->where ('item_package.item', $item_id)
            ->get ();

        foreach ($item_packages as $item_package)
        {
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

    public function change_date_to_standard($date)
    {
        $date = str_replace ('/', '-', $date);
        $array = explode ('-', $date);
        $year = $array[2];
        $month = $array[1];
        $day = $array[0];
        $date = join ('-', [$year, $month, $day]);
        $date = date ("Y-m-d", strtotime ($date));
        return $date;
    }

}
