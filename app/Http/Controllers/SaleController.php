<?php

namespace App\Http\Controllers;

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


class SaleController extends Controller
{
    var $item_for_sale = array(
        'item_id' => '', 'barcode' => '',
        'variant_barcode' => '', 'unit_price_variant' => '',
        'unit_price' => '', 'package_tracking' => '',
        'variants' => '', 'main_item_name' => '',
        'item_name' => '', 'item_id' => '',
        'barcode_main' => '', 'barcode_id' => '',
        'color' => '', 'barcode' => '',
    );

    var $all_items_for_sale = array();

    public function __construct(Sale $sale, Customer $customer, Item $item)
    {
        $this->sale = $sale;
        $this->customer = $customer;
        $this->item = $item;
    }

    public function index()
    {
        $data = [];
        $data['sales'] = DB::table ('customers')
            ->join ('sales', 'customers.id', '=', 'sales.customer')
            ->get ();
        return view ('sales/index', $data);
    }

    /// Create Sale
    public function createSale(Request $request, Sale $sale)
    {
        $data = [];

        $data['customers'] = $this->customer->all ();
        $data['categories'] = DB::table ('item_categories')->get ();

        $price_method_data = DB::table ('configurations')
            ->where ('configuration_name', '=', 'pricing')
            ->first ();
        $price_method = $price_method_data->configuration_value;
        session ()->put ('price_method', $price_method);

        $data['products'] = DB::table ('items')
            ->leftjoin ('item_categories', 'items.category', '=', 'item_categories.id')
            ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
            ->select ('items.*', 'item_variants.id as barcode_id', 'item_variants.color', 'item_variants.route','item_variants.variant_name',
                'item_variants.dosage',
                'item_variants.barcode as variant_barcode',
                'item_variants.size', 'item_variants.unit_price as unit_price_variant',
                'item_variants.barcode as barcode')
            ->where ('item_variants.active', '<>', 0)
            ->Orwhere ('item_variants.active', '=', null)
            ->orderBy ('items.item_order','asc')
            ->get ();

        return view ('sales/form-an', $data);
    }

    //Skipped- Getting Item Details from barcode
    public function newSale2A(Request $request)
    {
        $data = [];
        $input = $request->all ();
        $variant = 0;

        try {

            $barcode_received = $request->item_barcode;

            $barcode_received = "1011-1-317";

            $array_barcode = explode ('-', $barcode_received);

            $item = $array_barcode[0];
            $variant = $array_barcode[2];
            $package = $array_barcode[1];

            $package_name = $this->get_package_name ($package);

            if ($variant != 0) {
                $product = DB::table ('items')
                    ->leftjoin ('item_categories', 'items.category', '=', 'item_categories.id')
                    ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
                    ->select ('items.*', 'item_variants.id as barcode_id', 'item_variants.color as color',
                        'item_variants.id as variant_barcode', 'item_variants.id as variants',
                        'item_variants.size as size', 'item_variants.unit_price as unit_price_variant',
                        'item_variants.barcode as barcode', 'item_variants.route as route','item_variants.variant_name')
                    ->where ('item_variants.active', '<>', 0)
                    ->where ('items.barcode_main', '=', $item)
                    ->where ('item_variants.id', '=', $variant)
                    ->Orwhere ('item_variants.active', '=', 1)
                    ->first ();

//                function (item_name,item_id,barcode_main,barcode,barcode_id,unit_price,
//                          package_tracking,unit_price_variant,variants,main_item_name)

                $variant_barcode = $product->variant_barcode;
                $unit_price_variant = $product->unit_price_variant;
                $unit_price = $product->unit_price;
                $package_tracking = $product->package_tracking;
                $variants = $product->barcode_id;
                $main_item_name = $product->item_name;
                $item_name = $product->item_name . " " . $product->variant_name . "-BCC";
                $item_id = $product->id;
                $barcode_main = $product->barcode_main;
                $barcode_id = $product->barcode_id;
                $color = $product->color;
                $barcode = $product->barcode;

                //dd($item_name)

            } else if ($variant == 0) {
                $product = DB::table ('items')
                    ->leftjoin ('item_categories', 'items.category', '=', 'item_categories.id')
                    ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
                    ->select ('items.*', 'item_variants.id as barcode_id', 'item_variants.color',
                        'item_variants.barcode as variant_barcode', 'item_variants.id as variants',
                        'item_variants.size', 'item_variants.unit_price as unit_price_variant',
                        'item_variants.barcode as barcode')
                    ->where ('item_variants.active', '<>', 0)
                    ->where ('items.barcode_main', '=', $item)
                    ->Orwhere ('item_variants.active', '=', null)
                    ->first ();

                $variant_barcode = $product->variant_barcode;
                $unit_price_variant = 0.00;
                $unit_price = $product->unit_price;
                $package_tracking = $product->package_tracking;
                $variants = 0;
                $main_item_name = $product->item_name;
                $item_name = $product->item_name;
                $item_id = $product->id;
                $barcode_main = $product->barcode_main;
                $barcode_id = "-";
                $color = $product->color;
                $barcode = "-";

            }


            //$product_detail = array('item_name'=>$product['item_name'],'item_name'=>$product['color']);

//            addItem('{{$product->item_name}} {{$product->size}} {{$product->color}}', {{$product->id}}, '{{$product->barcode_main}}',
//     @if($product->variants=='false')
//                '-','-',{{$product->unit_price}},
//            @else
//                                                     '{{$product->barcode}}',{{$product->barcode_id}},{{$product->unit_price_variant}},
//            @endif
//                                             {{$product->package_tracking}},
//@if($product->variants=='false')0.00,
//@else
//                                             {{$product->unit_price_variant}},
//@endif{{$product->variants}},'{{$product->item_name}}');"

//            $item_barcode = $request->item_barcode;
//
//            $barcode_got = "1012-15-01-03";
//
//            $barcode_pieces = explode("-", $barcode_got);

            //dd($barcode_pieces[0]);
            //dd($barcode_pieces[1]);
            //dd($barcode_pieces[2]);

//            $item_barcode_a = $barcode_pieces[0]."-".$barcode_pieces[1];
//            $variant_barcode = $barcode_pieces[2];
//            $package_barcode = $barcode_pieces[3];

            //$package_barcode = $barcode_pieces[3];


//            if($item_barcode_a!=null)
//            {
//                $item_data = DB::table('items')
//                    ->where('items.barcode_main','=',$item_barcode_a )
//                    ->select('items.*')
//                    ->first();
//            }
//
//            if($variant_barcode!=0 && $variant_barcode!="0")
//            {
//                $variant_data = DB::table('item_barcodes')
//                    ->where('item_barcodes.barcode','=',($item_barcode_a."-".$variant_barcode))
//                    ->select('item_barcodes.*')
//                    ->first();
//            }


//            if($package_barcode!=0 && $package_barcode!="0")
//            {
//                $package_data = DB::table('item_package')
//                    ->where('item_package.barcode','=',$barcode_got)
//                    ->select('item_package.*')
//                    ->first();
//            }


//            $count = 0;


            /*
            $count = DB::table('item_barcodes')
            ->join('items', 'item_barcodes.item', '=', 'items.id')
            ->where('item_barcodes.barcode','=',$item_barcode )
            ->count();

            if($count>0)
            {
            $item = DB::table('item_barcodes')
            ->join('items', 'item_barcodes.item', '=', 'items.id')
            ->where('item_barcodes.barcode','=',$item_barcode )
            ->select('item_barcodes.id as barcode_id','item_barcodes.unit_price as unit_price','items.id','items.barcode_main','items.item_name','item_barcodes.color','item_barcodes.barcode','item_barcodes.size')
            ->first();
            $variant = $item->barcode_id;
            $variant_barcode = $item->barcode;
            }else if($count==0){
                $item = DB::table('items')
                ->where('items.barcode_main','=',$item_barcode)
                ->first();

                $variant_barcode = "";
                $variant = 0;
            }
            */

            return response ()->json (['success' => $item_name,
                'item_name' => $item_name,
                'variant_barcode' => $variant_barcode,
                'unit_price_variant' => $unit_price_variant,
                'unit_price' => $unit_price,
                'package_tracking' => $package_tracking,
                'variants' => $variants,
                'main_item_name' => $main_item_name,
                'item_name' => $item_name,
                'item_id' => $item_id,
                'barcode_main' => $barcode_main,
                'barcode_id' => $barcode_id,
                'color' => $color,
                'barcode' => $barcode,
                'unit_price' => $unit_price,
                'package' => $package,
                'package_name' => $package_name]);

//            return response()->json(['success'=>'success','unit_price'=>$item_data->unit_price,'item_id'=>$item_data->id,
//                'item_name'=>$item_data->item_name,'barcode_main'=>$item_data->barcode_main,
//                'barcode_variant'=>$item_data->barcode_main,'variant'=>$variant_data->id,'package'=>$package_data->id,
//                'package_name'=>$package_data->package_name]);
        } catch (\Exception $e) {
            return response ()->json (['success' => 'failure' . $e, 'unit_price' => $e, 'item_id' => $e, 'item_name' => $e, 'variant' => $e]);
        }
    }

    ///
    public function get_all_sales_items(Request $request)
    {
        try {
            $all_sale_item = DB::table ('current_transactions')
                ->select (DB::raw ("concat(item_name,'  ---->',qty) as name"), 'user_id')
                ->where ('user_id', '=', 1)
                ->get ();
            echo json_encode ($all_sale_item);

        } catch (\Exception $e) {
            return response ()->json (['success' => 'failure' . $e, 'unit_price' => $e, 'item_id' => $e, 'item_name' => $e, 'variant' => $e]);
        }
    }

    ///
    public function get_all_sales_items_browser(Request $request)
    {
        try {

            $all_sale_item = DB::table ('current_transactions')
                ->where ('user_id', '=', 1)
                ->get ();

            return response ()->json (['success' => $all_sale_item]);

        } catch (\Exception $e) {
            return response ()->json (['success' => 'failure' . $e, 'unit_price' => $e, 'item_id' => $e, 'item_name' => $e, 'variant' => $e]);
        }
    }

    //S Adding to DB from scanner
    public function newSale2Q(Request $request)
    {
        $data = [];

        $input = $request->all ();

        $variant = 0;

        try {

            $barcode_received = $request->item_barcode;

            $barcode_received = "0101811400823-317-81";

            $array_barcode = explode ('-', $barcode_received);

            $item = $array_barcode[0];
            $variant = $array_barcode[1];
            //$package = $array_barcode[2];

            if ($variant != 0) {
                $product = DB::table ('items')
                    ->leftjoin ('item_categories', 'items.category', '=', 'item_categories.id')
                    ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
                    ->select ('items.*', 'item_variants.id as barcode_id', 'item_variants.color as color',
                        'item_variants.barcode as variant_barcode',
                        'item_variants.size as size', 'item_variants.unit_price as unit_price_variant',
                        'item_variants.barcode as barcode')
                    ->where ('item_variants.active', '<>', 0)
                    ->where ('items.barcode_main', '=', $item)
                    ->where ('item_variants.id', '=', $variant)
                    ->Orwhere ('item_variants.active', '=', null)
                    ->first ();

                $variant_barcode = $product->variant_barcode;
                $unit_price_variant = $product->unit_price_variant;
                $unit_price = $product->unit_price;
                $package_tracking = $product->package_tracking;
                $variants = $product->barcode_id;
                $main_item_name = $product->item_name;
                $item_name = $product->item_name . " " . $product->color . " " . $product->size;
                $item_id = $product->id;
                $barcode_main = $product->barcode_main;
                $barcode_id = $product->barcode_id;
                $color = $product->color;
                $barcode = $product->barcode;


            }
            else if ($variant == 0) {
                $product = DB::table ('items')
                    ->leftjoin ('item_categories', 'items.category', '=', 'item_categories.id')
                    ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
                    ->select ('items.*', 'item_variants.id as barcode_id', 'item_variants.color',
                        'item_variants.barcode as variant_barcode',
                        'item_variants.size', 'item_variants.unit_price as unit_price_variant',
                        'item_variants.barcode as barcode')
                    ->where ('item_variants.active', '<>', 0)
                    ->where ('items.barcode_main', '=', $item)
                    ->Orwhere ('item_variants.active', '=', null)
                    ->first ();

                $variant_barcode = $product->variant_barcode;
                $unit_price_variant = 0.00;
                $unit_price = $product->unit_price;
                $package_tracking = $product->package_tracking;
                $variants = 0;
                $main_item_name = $product->item_name;
                $item_name = $product->item_name;
                $item_id = $product->id;
                $barcode_main = $product->barcode_main;
                $barcode_id = "-";
                $color = $product->color;
                $barcode = "-";


            }

            //$package_name = $this->get_package_name ($package);

            // Select all items of the user
            $all_sale_item = DB::table ('current_transactions')
                ->where ('user_id', '=', 1)
                ->get ();

            if (count ($all_sale_item) == 0) {
                DB::table ('current_transactions')->insert (
                    ['user_id' => 1,
                        'item_id' => $item_id, 'barcode' => $barcode,
                        'variant_barcode' => $variant_barcode, 'unit_price_variant' => $unit_price_variant,
                        'unit_price' => $unit_price, 'package_tracking' => $package_tracking,
                        'variants' => $variants, 'main_item_name' => $main_item_name,
                        'item_name' => $item_name, 'item_id' => $item_id,
                        'barcode_main' => $barcode_main, 'barcode_id' => $barcode_id,
                        'color' => null, 'barcode' => $barcode,
                        'package' => null,
                        'package_name' => null,
                        'package_tracking' => $product->package_tracking
                    ]
                );
            }
            else {

                // compare the item on the list selected
                $flag = false;
                $item_index = -1;
                $current_qty = 1;

                for ($i = 0; $i < count ($all_sale_item); $i++) {
                    if ($all_sale_item[$i]->item_id == $item_id && $all_sale_item[$i]->barcode_id == $barcode_id) {
                        $item_index = $i;
                        $flag = true;
                        $item_id = $item_id;
                        $barcode_id = $all_sale_item[$i]->barcode_id;
                        $current_qty = $all_sale_item[$i]->qty;
                    }
                }

                // If item detail exists, increment qty

                if ($flag == true) {
                    DB::table ('current_transactions')
                        ->where ('current_transactions.user_id', 1)
                        ->where ('current_transactions.item_id', $item_id)
                        ->where ('current_transactions.barcode_id', $barcode_id)
                        ->update (['qty' => $current_qty + 1]);
                } else {
                    // Else insert item
                    DB::table ('current_transactions')->insert (
                        ['user_id' => 1,
                            'item_id' => $item_id, 'barcode' => $barcode,
                            'variant_barcode' => $variant_barcode, 'unit_price_variant' => $unit_price_variant,
                            'unit_price' => $unit_price, 'package_tracking' => $package_tracking,
                            'variants' => $variants, 'main_item_name' => $main_item_name,
                            'item_name' => $item_name, 'item_id' => $item_id,
                            'barcode_main' => $barcode_main, 'barcode_id' => $barcode_id,
                            'color' => null, 'barcode' => $barcode,
                            'package' => null,
                            'package_name' => null,

                        ]
                    );
                }

            }

            $all_sale_item = DB::table ('current_transactions')
                ->where ('user_id', '=', 1)
                ->get ();

//            DB::table ('current_transactions')->where ('user_id', '=', 1)->delete ();

//            if ($variant != 0) {
//                $product = DB::table ('items')
//                    ->leftjoin ('item_categories', 'items.category', '=', 'item_categories.id')
//                    ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
//                    ->select ('items.*', 'item_variants.id as barcode_id', 'item_variants.color as color',
//                        'item_variants.barcode as variant_barcode',
//                        'item_variants.size as size', 'item_variants.unit_price as unit_price_variant',
//                        'item_variants.barcode as barcode')
//                    ->where ('item_variants.active', '<>', 0)
//                    ->where ('items.barcode_main', '=', $item)
//                    ->where ('item_variants.id', '=', $variant)
//                    ->Orwhere ('item_variants.active', '=', null)
//                    ->first ();
//
//                $variant_barcode = $product->variant_barcode;
//                $unit_price_variant = $product->unit_price_variant;
//                $unit_price = $product->unit_price;
//                $package_tracking = $product->package_tracking;
//                $variants = $product->barcode_id;
//                $main_item_name = $product->item_name;
//                $item_name = $product->item_name . " " . $product->color . " " . $product->size;
//                $item_id = $product->id;
//                $barcode_main = $product->barcode_main;
//                $barcode_id = $product->barcode_id;
//                $color = $product->color;
//                $barcode = $product->barcode;
//
//
//            } else if ($variant == 0)
//            {
//                $product = DB::table ('items')
//                    ->leftjoin ('item_categories', 'items.category', '=', 'item_categories.id')
//                    ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
//                    ->select ('items.*', 'item_variants.id as barcode_id', 'item_variants.color',
//                        'item_variants.barcode as variant_barcode',
//                        'item_variants.size', 'item_variants.unit_price as unit_price_variant',
//                        'item_variants.barcode as barcode')
//                    ->where ('item_variants.active', '<>', 0)
//                    ->where ('items.barcode_main', '=', $item)
//                    ->Orwhere ('item_variants.active', '=', null)
//                    ->first ();
//
//                $variant_barcode = $product->variant_barcode;
//                $unit_price_variant = 0.00;
//                $unit_price = $product->unit_price;
//                $package_tracking = $product->package_tracking;
//                $variants = 0;
//                $main_item_name = $product->item_name;
//                $item_name = $product->item_name;
//                $item_id = $product->id;
//                $barcode_main = $product->barcode_main;
//                $barcode_id = "-";
//                $color = $product->color;
//                $barcode = "-";
//
//
//            }
//
//
//            DB::table ('current_transactions')->insert (
//                [   'user_id'=>1,
//                    'item_id' => $item_id,'barcode'=>$barcode,
//                    'variant_barcode' => $variant_barcode,'unit_price_variant' => $unit_price_variant,
//                    'unit_price' => $unit_price,'package_tracking' => $package_tracking,
//                    'variants' => $variants,'main_item_name' => $main_item_name,
//                    'item_name' => $item_name,'item_id' => $item_id,
//                    'barcode_main' => $barcode_main,'barcode_id' => $barcode_id,
//                    'color' => $color,'barcode' => $barcode,'package' => $package,'package_name' => $package_name
//                ]
//            );

            $all_sale_item = DB::table ('current_transactions')
                ->select (DB::raw ("concat(item_name,'  ---->',qty) as name"), 'user_id')
                ->where ('user_id', '=', 1)
                ->get ();


            echo json_encode ($all_sale_item);

//				echo json_encode($emp_list);

        } catch (\Exception $e) {
            return response ()->json (['success' => 'failure' . $e, 'unit_price' => $e, 'item_id' => $e, 'item_name' => $e, 'variant' => $e]);
        }
    }

    // Adding to DB from Browser
    public function newSaleItemAdd(Request $request)
    {
        // Select all items of the user
        $all_sale_item = DB::table ('current_transactions')
            ->where ('user_id', '=', 1)
            ->get ();

        // receive the item
        $product = $request->product;

        $unit_price_variant = $product['unit_price'];
        $unit_price = $product['unit_price'];
        $package_tracking = $product['package_tracking'];
        $variants = $product['variants'];
        $main_item_name = $product['item'];
        $item_name = $product['item'];
        $item_id = $product['item_id'];
        $barcode_main = "";

        if ($product['barcode_id'] == "-") {
            $barcode_id = null;
        } else {
            $barcode_id = $product['barcode_id'];
        }

        $variant_barcode = $barcode_id;//$product->variant_barcode;

        $barcode = $product['barcode'];

        if (count ($all_sale_item) == 0) {
            // Select if there exist variant defaults
            if ($barcode_id != null) {
                $variant_default = DB::table ('variant_default')
                    ->where ('variant_id', '=', $barcode_id)
                    ->first ();

                $freq = "";
                $dosage = 0.00;
                $duration_time = 0.00;
                $duration_day = 0;
                $uod = "";
                $uom = "";
                $route = "";
            } else {

                $freq = "";
                $dosage = 0.00;
                $duration_time = 0.00;
                $duration_day = 0;
                $uod = "";
                $uom = "";
                $route = "";
            }

            $default_package = null;

            // New Comment
//            if ($product['package_tracking'] == 1 || $product['package_tracking'] == '1') {
//                if ($barcode_id == null) {
//                    $package_details = DB::table ('item_package')
//                        ->where ('item', '=', $item_id)
//                        ->where ('variant', '=', $barcode_id)
//                        ->where ('status', '=', 'active')
//                        ->where ('qty_total', '>', 0)
//                        ->first ();
//                } else {
//                    $package_details = DB::table ('item_package')
//                        ->where ('item', '=', $item_id)
//                        ->where ('status', '=', 'active')
//                        ->where ('qty_total', '>', 0)
//                        ->first ();
//                }
//                $default_package = $package_details->id;
//            }

            DB::table ('current_transactions')->insert (
                ['user_id' => 1,
                    'item_id' => $item_id, 'barcode' => $barcode,
                    'variant_barcode' => $variant_barcode, 'unit_price_variant' => $unit_price_variant,
                    'unit_price' => $unit_price, 'package_tracking' => 0,//$package_tracking,
                    'variants' => $variants, 'main_item_name' => $main_item_name,
                    'item_name' => $item_name, 'item_id' => $item_id,
                    'barcode_main' => $barcode_main, 'barcode_id' => $barcode_id,
                    'color' => null, 'barcode' => $barcode,
                    'package' => 0,//$default_package,
                    'package_name' => null,
                    'package_id' => 0,//$default_package,
                    'dosage' => 0,//$dosage,
                    'duration' => 0,//$duration_time,
                    'uod' => 0,//$uod,
                    'uom' => 0,//$uom,
                    'route' => 0,//$route,
                ]
            );
        }
        else {
            // compare the item on the list selected
            $flag = false;
            $item_index = -1;
            $current_qty = 1;

            for ($i = 0; $i < count ($all_sale_item); $i++) {
                if ($all_sale_item[$i]->item_id == $item_id && $all_sale_item[$i]->barcode_id == $barcode_id) {
                    $item_index = $i;
                    $flag = true;
                    $item_id = $item_id;
                    $barcode_id = $all_sale_item[$i]->barcode_id;
                    $current_qty = $all_sale_item[$i]->qty;
                }
            }

            // If item detail exists, increment qty

            if ($flag == true) {
                DB::table ('current_transactions')
                    ->where ('current_transactions.user_id', 1)
                    ->where ('current_transactions.item_id', $item_id)
                    ->where ('current_transactions.barcode_id', $barcode_id)
                    ->update (['qty' => $current_qty + 1]);
            } else {
                // Else insert item
                // Select if there exist variant defaults
                if ($barcode_id != null) {
                    $variant_default = DB::table ('variant_default')
                        ->where ('variant_id', '=', $barcode_id)
                        ->first ();

                    $count = DB::table ('variant_default')
                        ->where ('variant_id', '=', $barcode_id)
                        ->count ();

                    if ($count > 0) {
                        $freq = $variant_default->freq;
                        $dosage = $variant_default->dosage;
                        $duration_time = $variant_default->duration_time;
                        $duration_day = $variant_default->duration_day;
                        $uom = $variant_default->uom;
                        $route = $variant_default->route;
                    } else {
                        $freq = "";
                        $dosage = 0.00;
                        $duration_time = 0.00;
                        $duration_day = "";
                        $uom = "";
                        $route = "";
                    }
                } else {
                    $freq = "";
                    $dosage = 0.00;
                    $duration_time = 0.00;
                    $duration_day = "";
                    $uom = "";
                    $route = "";
                }

                DB::table ('current_transactions')->insert (
                    ['user_id' => 1,
                        'item_id' => $item_id, 'barcode' => $barcode,
                        'variant_barcode' => $variant_barcode, 'unit_price_variant' => $unit_price_variant,
                        'unit_price' => $unit_price, 'package_tracking' => $package_tracking,
                        'variants' => $variants, 'main_item_name' => $main_item_name,
                        'item_name' => $item_name, 'item_id' => $item_id,
                        'barcode_main' => $barcode_main, 'barcode_id' => $barcode_id,
                        'color' => null, 'barcode' => $barcode, 'package' => null, 'package_name' => null,
                        'freq' => $freq,
                        'dosage' => $dosage,
                        'duration' => $duration_time,
                        'uod' => $duration_day,
                        'uom' => $uom,
                        'route' => $route,

                    ]
                );
            }

        }

        $all_sale_item = DB::table ('current_transactions')
            ->where ('user_id', '=', 1)
            ->get ();

        return response ()->json (['success' => $all_sale_item]);
    }


    public function get_pos_list(Request $request)
    {
        $all_sale_item = DB::table ('current_transactions')
            ->where ('user_id', '=', 1)
            ->get ();

        return response ()->json (['success' => $all_sale_item]);
    }

    public function get_package_name($package)
    {
        $data = DB::table ('item_package')
            ->where ('id', '=', 317)
            ->first ();
        return ($data['package_name']);
    }

    // All Sales Transactions

    public function newPOSSaleAn2(Request $request, Sale $sale)
    {
        $data = [];
        $total_amount = 0.00;

        $all_sale_item = DB::table ('current_transactions')
            ->where ('user_id', '=', 1)
            ->get ();

        try {

            $input = $request->all ();

            $all_items_list = $all_sale_item;//$request->items_list;
            $customer_id = $request->customer;
            $date_sale = $request->sale_date;
            $payment_method = $request->payment_method;
            $user = auth ()->user ();
            $price_method = session ()->get ('price_method');

            $count = count ($all_items_list);

//            return response ()->json (['success' => 'DONE','item' => $count, 'sale_id' => '', 'package_list' => 'heksjkdlfjsldkf', 'qty_store' => 'woooo']);


            $sale = new Sale();
            $sale->customer = $customer_id;
            $sale->ref = "";
            $sale->date = $date_sale;
            $sale->total_amount = 0.00;
            $sale->user = $user->id;
            $sale->user_name = $user->name;
            $sale->payment_mode = $payment_method;
            $sale->save ();

            $total_amount = 0.00;

            for ($i = 0; $i < $count; $i++) {
                if ($all_items_list[$i]->barcode_id == null ||
                    $all_items_list[$i]->barcode_id == ""
                    || $all_items_list[$i]->barcode_id == "-") {

                    // No variant: Single Item

                    $item = $this->item->find ($all_sale_item[$i]->item_id);

                    $saleItem = new SaleItem();
                    $saleItem->item = $all_sale_item[$i]->item_id;
                    $saleItem->qty = $all_sale_item[$i]->qty;
                    $saleItem->unit_price = $all_sale_item[$i]->unit_price;
                    $saleItem->unit_cost = $item->unit_cost; // needs modification
                    $saleItem->barcode = $all_sale_item[$i]->barcode_id;
                    $saleItem->discount = 0.00;//$all_sale_item[$i]->discount;
                    $saleItem->sub_total = ($saleItem->qty * $saleItem->unit_price) - $saleItem->discount;
                    $saleItem->date = $date_sale;
                    $saleItem->package = $all_sale_item[$i]->package;

                    $saleItem->sale ()->associate ($sale);
                    $saleItem->save ();

                    $sale->total_amount += $saleItem->sub_total;

//                    //Update Item Qty
                    $previous_qty = $item->current_amount;
                    $current_amount = $item->qty_shop - $all_sale_item[$i]->qty + $item->qty_store;
                    $item->qty_shop -= $all_sale_item[$i]->qty;
                    $item->current_amount = $item->qty_shop + $item->qty_store;
                    $item->save();


                    DB::table ('inventory_record')->insert (
                        ['item' => $item->id, 'activity' => 'Sale', 'qty_previous' => $previous_qty,
                            'previous_cost' => $item->unit_cost, 'units_received' => 0.00,
                            'units_sold' => $saleItem->qty, 'date' => $sale->date,
                            'qty_on_hand' => $current_amount, 'unit_cost' => $item->unit_cost,
                            'total_cost' => $item->unit_cost * $saleItem->qty, 'vendor' => 0, 'ref_id' => $sale->id]
                    );

                    DB::table ('cost_profit')->insert (
                        ['sale_id' => $sale->id,
                            'item' => $item->id,
                            'item_unit_cost' => $item->unit_cost,
                            'item_cost' => $item->unit_cost * $saleItem->qty,
                            'item_unit_price' => $saleItem->unit_price,
                            'item_selling_price' => $saleItem->unit_price * $saleItem->qty,
                            'profit' => $saleItem->unit_price * $saleItem->qty - $saleItem->qty * $item->unit_cost,
                            'date' => $sale->date,
                            'qty' => $saleItem->qty,
                            'pkg' => 0 //$package_data->id
                        ]
                    );


                    //$this->calculateTotalItemOnly ($saleItem->item);
                }
                else {

                    // There is variant

                    $item = $this->item->find ($all_items_list[$i]->item_id);

                    // Save Sale Item
                    $saleItem = new SaleItem();
                    $saleItem->item = $all_items_list[$i]->item_id;
                    $saleItem->qty = $all_items_list[$i]->qty;
                    $saleItem->unit_price = $all_items_list[$i]->unit_price;
                    $saleItem->unit_cost = $item->unit_cost; // needs modification
                    $saleItem->barcode = $all_items_list[$i]->barcode_id;
                    $saleItem->discount = $all_items_list[$i]->discount;
                    $saleItem->variant = $all_items_list[$i]->barcode_id; //????
//                    $saleItem->freq = $all_items_list[$i]->freq;
//                    $saleItem->uom = $all_items_list[$i]->uom;
//                    $saleItem->dosage = $all_items_list[$i]->dosage;
//                    $saleItem->duration = $all_items_list[$i]->duration;
//                    $saleItem->uod = $all_items_list[$i]->uod;
//                    $saleItem->route = $all_items_list[$i]->route;
                    $saleItem->sub_total = ($saleItem->qty * $saleItem->unit_price) - $saleItem->discount;
                    $saleItem->date = $date_sale;
                    $saleItem->package = $all_sale_item[$i]->package;


                    $item = $this->item->find ($all_items_list[$i]->item_id);
                    $saleItem->sale ()->associate ($sale);
                    $saleItem->save ();

                    $sale->total_amount += ($saleItem->sub_total);

                    $previous_qty = $item->current_amount;
                    $current_amount = $item->qty_shop - $all_items_list[$i]->qty + $item->qty_store;

                    // Update Item Qty
                    $item->qty_shop -= $all_items_list[$i]->qty;
                    $item->current_amount = $item->qty_shop + $item->qty_store;
                    $item->save ();


                    // Update variants data
                    $barcode_item_store = DB::table ('item_variants')
                        ->where ('item_variants.id', $all_items_list[$i]->barcode_id)
                        ->first ();

                    $existing_qty_shop = $barcode_item_store->shop;
                    $new_qty_shop = $existing_qty_shop - $all_items_list[$i]->qty;

                    DB::table ('cost_profit')->insert (
                        ['sale_id' => $sale->id, 'item' => $item->id,
                            'item_cost' => $saleItem->qty * $item->unit_cost,
                            'item_selling_price' => $saleItem->unit_price * $saleItem->qty,
                            'profit' => $saleItem->unit_price * $saleItem->qty - $saleItem->qty * $item->unit_cost,
                            'date' => $sale->date, 'qty' => $saleItem->qty,
                            'item_unit_cost' => $item->unit_cost,

                            'item_unit_price' => $saleItem->unit_price,
                            'item_variant' => $saleItem->variant,
                            'pkg' => 0 //$package_data->id
                        ]
                    );


                    // Insert it to inventory record
                    DB::table ('inventory_record')->insert (
                        ['item' => $item->id, 'activity' => 'Sale', 'qty_previous' => $previous_qty,
                            'previous_cost' => $item->unit_cost, 'units_received' => 0.00,
                            'units_sold' => $saleItem->qty, 'date' => $sale->date,
                            'qty_on_hand' => $current_amount, 'unit_cost' => $item->unit_cost,
                            'total_cost' => $saleItem->qty * $item->unit_cost, 'vendor' => 0, 'ref_id' => $sale->id]
                    );

                    DB::table ('item_variants')
                        ->where ('item_variants.id', $all_items_list[$i]->barcode_id)
                        ->update (['shop' => $new_qty_shop, 'current_qty' => $new_qty_shop + $barcode_item_store->store]);


                    //$this->calculateTotalItemOnly ($saleItem->item);

                }
            }

            //$sale->total_amount = $total_amount;
            if ($sale->payment_mode == "Cash") {
                $sale->amount_paid = $sale->total_amount;
                $sale->status = "paid";

                $receipt = new Receipt();

                $data = [];
                $receipt->customer = $customer_id;
                $receipt->date = $date_sale;
                $receipt->sales_id = $sale->id;
                $receipt->activity = "Sale";
                $receipt->amount = $sale->total_amount;
                $receipt->save ();
            }
            $sale->save ();

            $all_sale_item = DB::table ('current_transactions')
                ->where ('user_id', '=', 1)
                ->delete ();

            DB::commit ();

            return response ()->json (['success' => 'DONE', 'item' => $all_items_list, 'sale_id' => $all_sale_item,
                'package_list' => 'heksjkdlfjsldkf', 'qty_store' => 'woooo']);
        } catch
        (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['success' => 'UN SUCCESSFUL' . $e, 'item' => 'error' . $e, 'barcode' => $e, 'package_list' => 'errorsss']);
        }
    }

    public function delete_transaction(Request $request)
    {

        $input = $request->all ();

        try {
            $item_id = $request->item_id;
            $barcode_id = $request->barcode_id;

            DB::table ('current_transactions')
                ->where ('item_id', '=', $item_id)
                ->where ('barcode_id', '=', $barcode_id)
                ->delete ();
            return response ()->json (['success' => 'Deletion was successful ' . $item_id . " " . $barcode_id]);
        } catch (\Exception $e) {
            return response ()->json (['success' => 'failure']);
        }

    }

    public function cancelSale(Request $request)
    {
        // cancel sale
        // cancel item sales
        // cancel profit and loss
        // cancel payment

        // cancel inventory record

        // cancel barcode sales
        // add the item barcode qty

        $sale_id = $request->input ('sale_id');
        $sales_id = $sale_id;
        $sale = $this->sale->find ($sales_id);


        $sales_data = $this->sale->find ($sales_id);


        $sale_items = DB::table ('sale_items')
            ->where ('sale_id', $sales_id)
            ->get ();


        $data = [];

        $total_amount = 0.00;


        DB::beginTransaction ();

        try {

            $input = $request->all ();

            $sale->status = 'void';
            $sale->save ();


            // Update items to void
            DB::table ('sale_items')
                ->where ('sale_id', $sales_id)
                ->update (['status' => 'void']);

            // Update cost profit to void
            DB::table ('cost_profit')
                ->where ('sale_id', $sales_id)
                ->update (['status' => 'void']);

            // Update payments to void
            DB::table ('receipts')
                ->where ('sales_id', $sales_id)
                ->where ('activity', 'Sale')
                ->update (['status' => 'void']);

            // Update inventory_record to void
            DB::table ('inventory_record')
                ->where ('ref_id', $sales_id)
                ->where ('activity', 'Sale')
                ->update (['status' => 'void']);


            $purchase_items_barcode = DB::table ('sale_items')
                ->where ('sale_id', $sales_id)
                ->get ();

            $barcode_counts = count ($purchase_items_barcode);

            if ($barcode_counts > 0) {
                for ($i = 0; $i < $barcode_counts; $i++) {

                    if ($purchase_items_barcode[$i]->variant == 0) {
                        // If it is an item
                        $item = $this->item->find ($purchase_items_barcode[$i]->item);
                        $current_amount = $item->current_amount;

                        $item->qty_shop = $item->qty_shop + $purchase_items_barcode[$i]->qty;
                        $item->qty_store = $item->qty_store;
                        $item->current_amount = $item->qty_shop + $item->qty_store;
                        $item->save ();

                    } else {

                        // If it is a variant
                        $barcode = DB::table ('item_variants')
                            ->where ('item_variants.id', $purchase_items_barcode[$i]->variant)->first ();

                        // Update that specific barcode qty
                        $existing_qty_shop = $barcode->shop;
                        $existing_qty_store = $barcode->store;
                        $new_qty_shop = $existing_qty_shop + $purchase_items_barcode[$i]->qty;
                        $new_qty_store = $existing_qty_store;

//                        $result = DB::table ('item_variants')
//                            ->where ('id', '=',$purchase_items_barcode[$i]->variant)
//                            ->first ();

                        DB::table ('item_variants')
                            ->where ('id', $purchase_items_barcode[$i]->variant)
                            ->update (['location' => 1, 'shop' => $new_qty_shop, 'store' => $new_qty_store,
                                'current_qty' => $new_qty_shop + $new_qty_store]);

                        //dd($result);

                        $data['sales'] = DB::table ('customers')
                            ->join ('sales', 'customers.id', '=', 'sales.customer')
                            ->get ();

//                        return view ('sales/index', $data);

                        //dd("Yeeeee ".$purchase_items_barcode[$i]->variant.$result);


                    }
                    //$this->calculateTotalItemOnly ($purchase_items_barcode[$i]->item);

                }
            }

            // Reverse the package transactions done
//            $package_transactions = DB::table ('cost_profit')
//                ->where ('sale_id', $sales_id)
//                ->get ();
//
//            foreach ($package_transactions as $transaction) {
//                $item_packages = DB::table ('item_package')
//                    ->where ('id', '=', $transaction->pkg)
//                    ->first ();
//
//                DB::table ('item_package')
//                    ->where ('id', '=', $transaction->pkg)
//                    ->update (['qty_shop' => $item_packages->qty_shop + $transaction->qty,
//                        'qty_total' => $item_packages->qty_shop + $transaction->qty + $item_packages->qty_store]);
//            }


//            if ($barcode_counts > 0) {
//                for ($i = 0; $i < $barcode_counts; $i++) {
//
//                    $this->calculateTotalItemOnly ($purchase_items_barcode[$i]->item);
//
//                }
//            }

            DB::commit ();

        } catch (\Exception $e) {

            DB::rollBack ();
            throw $e;
            //return response()->json(['failure'=>'success','item'=>'error'.$e,'barcode'=>$e]);

        }

        $users = DB::table ('sales')
            ->join ('customers', 'customers.id', '=', 'sales.customer')
            ->get ();


        $data['sales'] = DB::table ('customers')
            ->join ('sales', 'customers.id', '=', 'sales.customer')
            ->get ();

        return view ('sales/index', $data);
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

    public function createReceipt(Request $request)
    {

//        $pdf = PDF::loadView('reports/customer_receipt');
        return view ('reports/customer_receipt');

    }

    public function get_interactions(Request $request)
    {


        $input = $request->all ();

        try {

            $items_list = $request->items_details_list;
            $sample = $request->sample_variable;

            $sample = DB::table ('test_drug_interations')
                ->where ('drug_id', '=', $sample[0]->item_id)
                ->Andwhere ('drug_interacting_id', '=', $sample[1]->item_id)
                ->get ();


            return response ()->json (['success' => 'success', 'interactions' => $sample]);

        } catch (\Exception $e) {

            return response ()->json (['success' => 'Error' . $e, 'interactions' => "Hello world: " . $e]);
        }


    }

    public function returned_items(Request $request)
    {
        $name = $request->input ('returned_name');
        $qty = $request->input ('returned_qty');
        $sales_id = $request->input ('sales_id');
        $returned_variant = $request->input ('returned_variant');
        $discount = $request->input ('returned_discount');
        $item_list = $request->input ('item_id');
        $item_count = count ($item_list);
        $returned_total = 0;
        $total = 0;
        //    dd($qty);
        for ($i = 0; $i < $item_count; $i++) {
            //retrive previous sale history
            // dd($request->input('item_id'));
            $sale_item = DB::table ('sale_items')
                ->where ('sale_id', $sales_id)
                ->where ('item', $item_list[$i])
                ->first ();
            //dd($item);
            // dd($sale_item->qty);
            $sub_total = (($sale_item->unit_price) * ($sale_item->qty - $qty[$i])) - $discount[$i];
            $total = $total + $sub_total;
            // dd($discount[$i]);
            ///update every saled item if it is returned
            DB::table ('sale_items')
                ->where ('sale_id', $sales_id)
                ->where ('item', $item_list[$i])
                ->update (['qty' => $sale_item->qty - $qty[$i], 'sub_total' => $sub_total]);

            $item_update = DB::table ('items')
                ->where ('id', $item_list[$i])
                ->first ();
            //
            if ($returned_variant[$i] == null or $returned_variant[$i] == 0) {
                //dd('in');
                DB::table ('items')
                    ->where ('id', $item_list[$i])
                    ->update (['qty_shop' => $item_update->qty_shop + $qty[$i], 'current_amount' => $item_update->current_amount + $qty[$i]]);
            } else {

                $item_barcode = DB::table ('item_variants')
                    ->where ('id', $returned_variant[$i])
                    ->first ();

                DB::table ('item_variants')
                    ->where ('id', $returned_variant[$i])
                    ->update (['shop' => $item_barcode->shop + $qty[$i]]);
                DB::table ('items')
                    ->where ('id', $item_list[$i])
                    ->update (['current_amount' => $item_update->current_amount + $qty[$i]]);

            }

        }


        $sale = DB::table ('sales')
            ->where ('id', $sales_id)
            ->first ();


        ///update the total amount
        DB::table ('sales')
            ->where ('id', $sales_id)
            ->update (['total_amount' => $total]);
        // dd($total);
        $returned_total = $sale->total_amount - $total;
        // dd($total);
        return redirect ('sales/');
    }

    public function show($sales_id)
    {
        $data = [];

        $data['customers'] = $this->customer->all ();

        $data['modify'] = 1;
        $sales_date = $this->sale->find ($sales_id);
        $d = $sales_date->date;
        $date_converted = date ("d/m/Y", strtotime ($d));

        $data['sales'] = DB::table ('customers')
            ->join ('sales', 'customers.id', '=', 'sales.customer')
            ->where ('sales.id', $sales_id)->first ();
//dd($data['sales']);
        $data['sale_id'] = $sales_id;
        $sales_item = DB::table ('sale_items')
            ->join ('items', 'items.id', '=', 'sale_items.item')
            ->leftjoin ('item_variants', 'sale_items.item', '=', 'item_variants.item')
            ->select ('items.item_name', 'sale_items.*', 'item_variants.shop', 'item_variants.store',
                'item_variants.color', 'item_variants.size', DB::raw ('sale_items.unit_price as unit_price'),
                DB::raw ('sale_items.item as item'))
            ->where ('sale_items.sale_id', $sales_id)
            ->where ('sale_items.variant', 0);

        $sales_item2 = DB::table ('sale_items')
            ->join ('items', 'items.id', '=', 'sale_items.item')
            ->leftjoin ('item_variants', 'sale_items.variant', '=', 'item_variants.id')
            ->select ('items.item_name', 'sale_items.*', 'item_variants.*',
                DB::raw ('sale_items.unit_price as unit_price'), DB::raw ('sale_items.item as item'))
            ->where ('sale_items.sale_id', $sales_id)
            ->get ();

        //dd($sales_item2);
        $data['sales_item'] = $sales_item2;
        return view ('sales/detail', $data)->with ('conv_date', $date_converted);
    }


    // Can be used as Normal Sale or Order
    public function createNormalSale(Request $request, Sale $sale)
    {
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

        return view ('sales/normal_pos', $data);
    }

    public function item_info(Request $request)
    {

        $data = [];
        $input = $request->all ();

        try {

            $item_array = explode ('-', $request->item_id);

            if ($item_array[1] == null) {
                $sales = DB::table ('items')
                    ->where ('items.id', $item_array[0])
                    ->select ('items.unit_price')
                    ->get ();
            } else {
                $sales = DB::table ('items')
                    ->leftjoin ('item_variants', 'items.id', '=', 'item_variants.item')
                    ->where ('item_variants.id', $item_array[1])
                    ->where ('item_variants.active', '<>', 0)
                    ->select ('item_variants.unit_price')
                    ->get ();
            }

            return response ()->json (['failure' => 'success', 'data' => $sales]);

        } catch (\Exception $e) {

            //    DB::rollBack();
            //throw $e;
            return response ()->json (['failure' => 'success', 'data' => 'error' . $e]);
            //$output = $e;
        }
    }

    public function normal_3(Request $request)
    {
        $data = [];
// dd('in');
        $total_amount = 0.00;


        DB::beginTransaction ();

        try {

            $input = $request->all ();

            $unit_price = $request->unit_price;
            $customer_id = $request->customer;

            $payment = $request->payment;
            $sub_total = $request->sub_total_h;

            $date_sale = $request->date;

            $user = auth ()->user ();

            $sale = new Sale();
            $sale->customer = $customer_id;
            $sale->ref = "";
            $sale->date = $date_sale;
            $sale->total_amount = 0.00;
            $sale->user = $user->id;
            $sale->user_name = $user->name;

            $sale->save ();
            $barcode_items = $request->items_barcode;
            $barcode_counts = count ($barcode_items);

            if ($barcode_counts > 0) {
                for ($i = 0; $i < $barcode_counts; $i++) {

                    $barcode = DB::table ('item_variants')
                        ->where ('item_variants.barcode', $barcode_items[$i])
                        ->where ('item_variants.item', $items_list_all[$i])
                        ->first ();

                    // Update that specific barcode qty
//            $existing_qty = $barcode->current_qty;
//            $new_qty = $existing_qty-$items_qty[$i];

                    $existing_qty = $barcode->shop;
                    $new_qty = $existing_qty - $items_qty[$i];

                    DB::table ('item_variants')
                        ->where ('id', $barcode->id)
                        ->update (['shop' => $new_qty]);


                    DB::table ('sales_items_barcode')->insert (
                        ['item' => $items_list_all[$i], 'qty' => $items_qty[$i], 'shop' => $items_qty[$i], 'sales_id' => $sale->id, 'sales_items_barcode_id' => $barcode->id]
                    );

                }

            }


            $itemid = $request->item;
            $unit_price = $request->unit_price;
            $qty = $request->qty;
            $discount = $request->discount;
            $sub_total = $request->sub_total_h;


            $count = count ($sub_total);
            //dd($sub_total);
            for ($i = 0; $i < $count; $i++) {
                $item = $this->item->find ($itemid[$i]);
                $current_qty = $item->current_amount;


                $saleItem = new SaleItem();
                $saleItem->item = $itemid[$i];
                //dd($itemid[$i]);
                $saleItem->qty = $qty[$i];
                $saleItem->unit_price = $unit_price[$i];
                $saleItem->discount = $discount[$i];
                $saleItem->sub_total = $sub_total[$i];
                $total_amount += $sub_total[$i];

                $saleItem->sale_id = $sale->id;
                //$saleItem->sale()->associate($sale);
                $saleItem->save ();
                $total_cost = $qty[$i] * $item->unit_cost;

                // Insert it to inventory record
                DB::table ('inventory_record')->insert (
                    ['item' => $item->id, 'activity' => 'Sale', 'qty_previous' => $current_qty, 'previous_cost' => $item->unit_cost, 'units_received' => 0.00, 'units_sold' => $qty[$i], 'date' => $date_sale, 'qty_on_hand' => $new_qty, 'unit_cost' => $item->unit_cost, 'total_cost' => $item->unit_cost, 'vendor' => $customer_id, 'ref_id' => $sale->id]
                );

                // Insert it to inventory record
                DB::table ('cost_profit')->insert (
                    ['sale_id' => $sale->id, 'item' => $item->id, 'item_cost' => $qty[$i] * $item->unit_cost, 'item_selling_price' => $sub_total[$i], 'profit' => $sub_total[$i] - $total_cost, 'date' => $date_sale]
                );

            }

            $this->calculateTotalItem2 ($item->id);

            $sale->total_amount = $total_amount;


            //Insert Inventory transactions
            // Payment Process

            if ($payment == "Cash") {

                //
                $sale->status = "paid";
                $sale->amount_paid = $total_amount;

                $payment = new Payment();

                $data = [];
                $payment->customer = $customer_id;
                $payment->date = $date_sale;
                $payment->sales_id = $sale->id;
                $payment->activity = "Sale";
                $payment->amount = $total_amount;

                $payment->save ();

            } else if ($payment == "Credit") {
                // Update customer balance
                $customer = $this->customer->find ($customer_id);;
                $customer->balance = $customer->balance + $total_amount;
                $customer->save ();

            }

            $sale->save ();

            DB::commit ();

            return redirect ('sales/new');
            //return response()->json(['success'=>'success','item'=>'$sub_total[1]','sale_id'=>$sale->id]);
            //barcode_items
            //return response()->json(['success'=>'success','item'=>'$sub_total[1]']);
        } catch (\Exception $e) {
            DB::rollBack ();
            throw $e;
            //return response()->json(['failure'=>'success','item'=>'error'.$e,'barcode'=>$e]);
        }
    }

    public function newSale(Request $request, Sale $sale)
    {

        $date_posted = $request->input ('date');
        $date_sale = $this->change_date_to_standard ($request->input ('date'));

        DB::beginTransaction ();

        try {

            if ($request->isMethod ('post')) {
                $sale = new Sale();
                $sale->customer = $request->input ('customer');
                $customer_id = $sale->customer;
                $sale->ref = $request->input ('ref');
                $sale_date = $this->change_date_to_standard ($request->input ('date'));
                $sale->date = $sale_date;
                $sale->payment_mode = $request->input ('payment');

                $saleItem = new SaleItem();

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
                        $saleItem = new SaleItem();
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

                        $sold_qty = $qty_list[$i];
                        $new_cost = $current_cost;
                        $new_amount = $current_amount - $sold_qty;
                        $total_cost = $new_cost * $sold_qty;
                        $item->unit_cost = $new_cost;
                        $item->qty_shop = $new_amount;
                        $total_new_item = $item->current_amount - $sold_qty;
                        $item->current_amount = $total_new_item;
                        $item->save ();


                        // Insert it to inventory record
                        DB::table ('inventory_record')->insert (
                            ['item' => $item->id, 'activity' => 'Sale', 'qty_previous' => $current_qty, 'previous_cost' => $item->unit_cost, 'units_received' => 0.00, 'units_sold' => $saleItem->qty, 'date' => $date_sale, 'qty_on_hand' => $item->current_amount, 'unit_cost' => $item->unit_cost, 'total_cost' => $item->unit_cost, 'vendor' => $customer_id, 'ref_id' => $sale->id]
                        );

                        // Insert it to profit and loss
                        DB::table ('cost_profit')->insert (
                            ['sale_id' => $sale->id, 'item' => $item->id,
                                'item_cost' => $saleItem->qty * $item->unit_cost,
                                'item_selling_price' => $saleItem->sub_total,
                                'profit' => $saleItem->sub_total - ($saleItem->qty * $item->unit_cost), 'date' => $date_sale]
                        );

                    } else {

                        // There is a variant

                        $item = $this->item->find ($item_array[0]);

                        // Get the variant
                        $barcode_item_store = DB::table ('item_variants')
                            ->where ('item_variants.id', $item_array[1])
                            ->first ();

                        // Save the Sale item
                        $saleItem = new SaleItem();
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
                        $total_new_item = $item->current_amount - $saleItem->qty;
                        $item->current_amount = $total_new_item;
                        $item->save ();


                        // Update Variant qty
                        $barcode_item_shop = $barcode_item_store;
                        $existing_qty_shop = $barcode_item_shop->shop;
                        $new_qty_shop = $existing_qty_shop - $saleItem->qty;
                        $new_qty_store = $barcode_item_shop->store;

                        DB::table ('item_variants')
                            ->where ('item_variants.id', $item_array[1])
                            ->update (['shop' => $new_qty_shop, 'current_qty' => $barcode_item_shop->store + $new_qty_shop, 'current_qty' => $new_qty_store + $new_qty_shop]);


                        // Insert it to inventory record
                        DB::table ('inventory_record')->insert (
                            ['item' => $item->id, 'activity' => 'Sale', 'qty_previous' => $barcode_item_shop->current_qty, 'previous_cost' => $barcode_item_shop->unit_cost, 'units_received' => 0.00, 'units_sold' => $saleItem->qty, 'date' => $date_sale, 'qty_on_hand' => $item->current_amount, 'unit_cost' => $barcode_item_shop->unit_cost, 'total_cost' => $barcode_item_shop->unit_cost, 'vendor' => $customer_id, 'ref_id' => $sale->id]
                        );

                        // Insert it to profit and loss
                        DB::table ('cost_profit')->insert (
                            ['sale_id' => $sale->id, 'item' => $item->id, 'item_cost' => $saleItem->qty * $barcode_item_shop->unit_cost, 'item_selling_price' => $saleItem->sub_total, 'profit' => $saleItem->sub_total - ($saleItem->qty * $barcode_item_shop->unit_cost), 'date' => $date_sale]
                        );

                    }

                }

                $sale->total_amount = $total_amount;
                $sale->save ();


                //Insert payment
                //payment
                //dd($request->input('payment'));

                if ($request->input ('payment') == "Cash") {

                    $payment = new Receipt();

                    $data = [];
                    $payment->customer = $request->input ('customer');
                    $payment->date = $this->change_date_to_standard ($request->input ('date'));
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

            return redirect ('sales');

        } catch (\Exception $e) {
            throw $e;
            DB::rollBack ();
        }
    }


    // Reports
    public function profit_loss(Request $request)
    {
        $data = [];

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
            $owner = $request->input ('owner');
            // dd($owner);
            // $end_date = str_replace('/','-',$end_date);
            // $array = explode('-',$end_date);
            // $year=$array[2];
            // $month=$array[1];
            // $day=$array[0];
            // $end_date=join('-',[$year,$month,$day]);

            $data['d1'] = date ("d/m/Y", strtotime ($start_date));
            $data['d2'] = date ("d/m/Y", strtotime ($end_date));

            $expenses_report = DB::table ('expenses')
                ->whereBetween ('date', [$start_date, $end_date])->get ();
            if ($owner != null) {
                $data['cost_profits'] = DB::table ('cost_profit')
                    ->join ('items', 'items.id', '=', 'cost_profit.item')
                    ->where ('items.owner', $owner)
                    ->whereBetween ('date', [$start_date, $end_date])
                    ->get ();
                //dd( $data['cost_profits'] );
            } else {
                $data['cost_profits'] = DB::table ('cost_profit')
                    ->join ('items', 'items.id', '=', 'cost_profit.item')
                    ->whereBetween ('date', [$start_date, $end_date])
                    ->get ();
                //dd( $data['cost_profits'] );
            }


            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;

            if (isset($print)) {
                $owner = $request->input ('owner');


                $start_date = $this->change_date_to_standard ($request->input ('start_date'));
                $end_date = $this->change_date_to_standard ($request->input ('end_date'));

                $data['start_date'] = $this->change_date_to_standard ($request->input ('start_date'));
                $data['end_date'] = $this->change_date_to_standard ($request->input ('end_date'));

                $expense = DB::table ('expenses')
                    ->select ('expense_name', 'amount', 'date', 'remark')
                    ->whereBetween ('date', [$start_date, $end_date])
                    ->get ();
                if ($owner != null) {
                    $data['cost_profits'] = DB::table ('cost_profit')
                        ->join ('items', 'items.id', '=', 'cost_profit.item')
                        ->where ('items.owner', $owner)
                        ->where ('status', '=', 'active')
                        ->whereBetween ('date', [$start_date, $end_date])
                        ->get ();
                    //dd( $data['cost_profits'] );
                } else {
                    $data['cost_profits'] = DB::table ('cost_profit')
                        ->join ('items', 'items.id', '=', 'cost_profit.item')
                        ->whereBetween ('date', [$start_date, $end_date])
                        ->where ('status', '=', 'active')
                        ->get ();
                }

                $pdf = PDF::loadView ('reports/cost_profit_report', $data);
                $pdf->save (storage_path () . '_filename.pdf');
                return $pdf->stream ('sales.pdf');

            } else {
                return view ('reports/profit_loss_index', $data);
            }

        }
        return view ('reports/profit_loss_index', $data);
    }

    public function sales_report(Request $request)
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
            //dd($d2);

            $user = $request->input ('user');

            if ($request->input ('user') != null) {
                //dd($request->input('user'));
                $data['sales'] = DB::table ('sales')
                    ->join ('customers', 'customers.id', '=', 'sales.customer')
                    ->Where ('user', $user)
                    ->whereBetween ('date', [$start_date, $end_date])
                    ->get ();

            } else {
                $data['sales'] = DB::table ('sales')
                    ->join ('customers', 'customers.id', '=', 'sales.customer')
                    ->whereBetween ('date', [$start_date, $end_date])->get ();

            }

            //$data['sales'] = $this->sale->all();

            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;


            $data['customers'] = $this->customer->all ();

            if (isset($print)) {
                $start_date = $this->change_date_to_standard ($request->input ('start_date'));
                $end_date = $this->change_date_to_standard ($request->input ('end_date'));

                //dd($request->input('start_date'));

                $data['start_date'] = $this->change_date_to_standard ($request->input ('start_date'));
                $data['end_date'] = $this->change_date_to_standard ($request->input ('end_date'));

                $data['sales'] = DB::table ('sales')
                    ->join ('customers', 'customers.id', '=', 'sales.customer')
                    ->whereBetween ('date', [$start_date, $end_date])
                    ->get ();
                //dd($start_date);

                $pdf = PDF::loadView ('reports/sales_report', $data);
                $pdf->save (storage_path () . '_filename.pdf');
                return $pdf->stream ('sales.pdf');

            } else {
                return view ('sales/report_index', $data);
            }

        }
        return view ('sales/report_index', $data);
    }

    // Other Functions
    public function change_date_to_readable($date)
    {
        $date = date ("d/m/Y", strtotime ($date));
        return $date;
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


    // Test functions
    public function view_icons()
    {
        $data = [];
        return view ('layouts/icons');
    }

    public function newSale2QT(Request $request)
    {
        $emp_list = DB::table ('emp')
            ->first ();
        echo json_encode ($emp_list);
    }

}
