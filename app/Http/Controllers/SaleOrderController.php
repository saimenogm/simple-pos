<?php

namespace App\Http\Controllers;

use App\SaleOrder as SaleOrder;
use App\SaleOrderItem as SaleOrderItem;
use Illuminate\Http\Request;

use App\Sale as Sale;
use App\Product as Product;
use App\SaleItem as SaleItem;
use App\Item as Item;
use App\Customer as Customer;
use App\Payment as Payment;
use App\Receipt as Receipt;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use PdfReport;
use PDF;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Sale $sale, SaleOrder $sale_order, Customer $customer, Item $item)
    {
        $this->sale_order = $sale_order;
        $this->sale = $sale;
        $this->customer = $customer;
        $this->item = $item;
    }



    public function index()
    {
        //
        $data = [];
        $data['sales'] = DB::table ('customers')
            ->join ('sale_orders', 'customers.id', '=', 'sale_orders.customer')
            ->get ();
        return view ('sale_orders/index', $data);

    }


    public function createSaleOrder(){

        $data = [];

        $data['customers'] = $this->customer->all ();

        $data['items'] = DB::table ('items')
            ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
            ->select ('items.id', 'items.item_name', 'items.item_code', 'item_variants.id as barcode_id',
                'item_variants.color', 'item_variants.size')
            ->where ('item_variants.active', 1)
            ->orwhere ('item_variants.active', null)
            ->orderBy ('items.item_name')
            ->get ();

        return view ('sale_orders/normal_pos', $data);

    }


    public function newSale(Request $request, Sale $sale)
    {
        $date_posted = $request->input ('date');
        $date_sale = $request->input ('date');

        DB::beginTransaction ();

        try {

            if ($request->isMethod ('post')) {

                $sale = new SaleOrder();
                $sale->customer = $request->input ('customer');
                $customer_id = $sale->customer;
                $sale->ref = $request->input ('ref');
                $sale_date = $request->input ('date');
                $sale->date = $sale_date;
                $sale->payment_mode = $request->input ('payment');

                $saleItem = new SaleOrderItem();

                $itemid_list = $request->input ('itemid');
                $item_list = $request->input ('tokens');
                $unit_price_list = $request->input ('unit_price');
                $qty_list = $request->input ('qty');
                $discount_list = $request->input ('discount');

                $sale->save ();

                $count = count ($item_list);
                $total_amount = 0.00;

                for ($i = 0; $i < $count; $i++) {

                    $hi_item = $item_list[$i];
                    $item_array = explode ('-', $hi_item);

                    if ($item_array[1] == null) {

                        // Find the item and get its data
                        $item = $this->item->find ($item_array[0]);
                        $current_qty = $item->current_amount;
                        $current_cost = $item->unit_cost;
                        $previous_cost = $item->unit_cost;
                        $current_amount = $item->qty_shop;

                        // Save the Sale item
                        $saleItem = new SaleOrderItem();
                        $saleItem->item = $item_array[0];
                        $saleItem->qty = $qty_list[$i];
                        $saleItem->date = $sale_date;
                        $saleItem->unit_price = $unit_price_list[$i];
                        $saleItem->discount = $discount_list[$i];
                        $saleItem->sub_total = ($saleItem->qty * $saleItem->unit_price) - $saleItem->discount;
                        $saleItem->unit_cost = $item->unit_cost;
                        $saleItem->variant = 0;
                        $total_amount += $saleItem->sub_total;
                        $saleItem->sale ()->associate ($sale);
                        $saleItem->save ();

                        // Update the item detail

//                        $sold_qty = $qty_list[$i];
//                        $new_cost = $current_cost;
//                        $new_amount = $current_amount - $sold_qty;
//                        $total_cost = $new_cost * $sold_qty;
//                        $item->unit_cost = $new_cost;
//                        $item->qty_shop = $new_amount;
//                        $total_new_item = $item->current_amount - $sold_qty;
//                        $item->current_amount = $total_new_item;
//                        $item->save ();


//                        // Insert it to inventory record
//                        DB::table ('inventory_record')->insert (
//                            ['item' => $item->id, 'activity' => 'Sale', 'qty_previous' => $current_qty, 'previous_cost' => $item->unit_cost, 'units_received' => 0.00, 'units_sold' => $saleItem->qty, 'date' => $date_sale, 'qty_on_hand' => $item->current_amount, 'unit_cost' => $item->unit_cost, 'total_cost' => $item->unit_cost, 'vendor' => $customer_id, 'ref_id' => $sale->id]
//                        );
//
//                        // Insert it to profit and loss
//                        DB::table ('cost_profit')->insert (
//                            ['sale_id' => $sale->id, 'item' => $item->id,
//                                'item_cost' => $saleItem->qty * $item->unit_cost,
//                                'item_selling_price' => $saleItem->sub_total,
//                                'profit' => $saleItem->sub_total - ($saleItem->qty * $item->unit_cost), 'date' => $date_sale]
//                        );

                    } else {

                        // There is a variant

                        $item = $this->item->find ($item_array[0]);

                        // Get the variant
                        $barcode_item_store = DB::table ('item_variants')
                            ->where ('item_variants.id', $item_array[1])
                            ->first ();

                        // Save the Sale item
                        $saleItem = new SaleOrderItem();
                        $saleItem->item = $item_array[0];
                        $saleItem->qty = $qty_list[$i];
                        $saleItem->unit_price = $unit_price_list[$i];
                        ///i added this below merhawi's addition

                        $saleItem->discount = $discount_list[$i];
                        $saleItem->sub_total = ($saleItem->qty * $saleItem->unit_price) - $saleItem->discount;
                        $saleItem->unit_cost = $barcode_item_store->unit_cost;
                        $saleItem->variant = $item_array[1];
                        $total_amount += $saleItem->sub_total;
                        $saleItem->sale ()->associate ($sale);

                        $saleItem->save ();

                        //updating total current amount
//                        $total_new_item = $item->current_amount - $saleItem->qty;
//                        $item->current_amount = $total_new_item;
//                        $item->save ();


                        // Update Variant qty
//                        $barcode_item_shop = $barcode_item_store;
//                        $existing_qty_shop = $barcode_item_shop->shop;
//                        $new_qty_shop = $existing_qty_shop - $saleItem->qty;
//                        $new_qty_store = $barcode_item_shop->store;

//                        DB::table ('item_variants')
//                            ->where ('item_variants.id', $item_array[1])
//                            ->update (['shop' => $new_qty_shop, 'current_qty' => $barcode_item_shop->store + $new_qty_shop, 'current_qty' => $new_qty_store + $new_qty_shop]);


//                        // Insert it to inventory record
//                        DB::table ('inventory_record')->insert (
//                            ['item' => $item->id, 'activity' => 'Sale', 'qty_previous' => $barcode_item_shop->current_qty, 'previous_cost' => $barcode_item_shop->unit_cost, 'units_received' => 0.00, 'units_sold' => $saleItem->qty, 'date' => $date_sale, 'qty_on_hand' => $item->current_amount, 'unit_cost' => $barcode_item_shop->unit_cost, 'total_cost' => $barcode_item_shop->unit_cost, 'vendor' => $customer_id, 'ref_id' => $sale->id]
//                        );
//
//                        // Insert it to profit and loss
//                        DB::table ('cost_profit')->insert (
//                            ['sale_id' => $sale->id, 'item' => $item->id, 'item_cost' => $saleItem->qty * $barcode_item_shop->unit_cost, 'item_selling_price' => $saleItem->sub_total, 'profit' => $saleItem->sub_total - ($saleItem->qty * $barcode_item_shop->unit_cost), 'date' => $date_sale]
//                        );

                    }
                }

                $sale->total_amount = $total_amount;
                $sale->save ();

                if ($request->input ('payment') == "Cash")
                {
                    $payment = new Receipt();

                    $data = [];
                    $payment->customer = $request->input ('customer');
                    $payment->date = $request->input ('date');
                    $payment->sales_id = $sale->id;
                    $payment->amount = $total_amount;

                    $sale->amount_paid = $total_amount;
                    $sale->status = "paid";
                    $sale->save ();
                    $payment->save ();

                } else if ($request->input ('payment') == "Credit") {

                    // Update customer balance
                    $customer = $this->customer->find ($request->input ('customer'));
                    $customer->balance = $customer->balance + $total_amount;
                    $customer->save ();
                }
            }

            DB::commit ();

            return redirect ('sale_orders');

        } catch (\Exception $e) {
            throw $e;
            DB::rollBack ();
        }
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleOrder $saleOrder)
    {
        //
    }
}
