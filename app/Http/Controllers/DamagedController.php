<?php
/**
 * Created by PhpStorm.
 * User: Hack
 * Date: 3/26/2019
 * Time: 9:45 AM
 */

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Customer;
use App\Damaged as Damaged;
use App\Item as Item;
use App\DamagedItem as DamagedItem;
use App\Journal as Journal;
use App\JournalItem as JournalItem;
use App\Supplier as Supplier;
use App\Customer as Customer;


class DamagedController extends Controller
{

    public function __construct(Damaged $Damaged, Customer $customer, Item $item)
    {
        $this->Damaged = $Damaged;
        //$this->customer = $customer;
        $this->item = $item;
       //in the above constructer there is supplier argument
        // $this->supplier = $supplier;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        //$data['purchases'] = $this->purchase->all();

        //$data['damaged'] = DB::table('damaged')
           // ->join('customers', 'customers.id', '=', 'damaged.customer_id')
            //->get();

        //return view('damaged/index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Get customers  id/name.
        $curstomers = DB::table('customers')->get();

        // Get items it/name
        $data['items'] = DB::table('items','id')->get();

        // render the blade with data.
        return view('damaged/form',$data);
    }

public function test(Request $request){
    // echo "<pre>" . var_dump($request->input,true) . "</pre>";

}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Damaged = new Damaged();

        //$damaged->customer_id = $request->input('customer');

        $date_posted = $request->input('iv_date');
        $date_replaced = str_replace('/','-',$date_posted);
        //$date_formatted = date('Y-m-d',strtotime($date_replaced));

        //dd($date_replaced);

        $array = explode('-',$date_replaced);
        $year=$array[2];
        $month=$array[1];
        $day=$array[0];
        $date_formatted=join('-',[$year,$month,$day]);


        $Damaged->date = $date_formatted;
        //echo $date_formatted;
        $Damaged->description = $request->input('reason');
        $Damaged->amount = 0.00;


        $Damaged->save();

        $item_list = $request->input('item');
        //$unit_price_list = $request->input('unit_price');
        //$qty_list = $request->input('qty');
        //$tax_list = $request->input('tax');
        //$sub_total_list = $request->input('sub_total');
        $amount=$request->input('amount');

       $items_list = $request->input('item');

        $date_input = $date_formatted;

        //$count=count($unit_price_list);
        //echo count($items_list);
        $items_number = count($items_list);

        //dd($qty_list);


        // Insert it into journal entry
       // $journal = new Journal();
       // $journal->date = $date_input;
       // $journal->total_debit = 0.00;
       // $journal->total_credit = 0.00 ;
       // $journal->ref=$request->input('ref');
       // $journal->save();


        //$total_amount =0.00;

        for($i=0;$i<$items_number;$i++)
        {
            $DamagedItem = new DamagedItem();
            $DamagedItem->item = $item_list[$i];
            $DamagedItem->amount = $amount[$i];
            //$purchaseItem->unit_price = $unit_price_list[$i];
            //$purchaseItem->tax = $tax_list[$i];

            //$purchaseItem->sub_total = $sub_total_list[$i];
            //$total_amount +=$sub_total_list[$i];

            $DamagedItem->Damaged()->associate($Damaged);
            $DamagedItem->save();

            //$item = DB::table('items')->where('id', $item_list[$i])->first();
          //  $item = $this->item->find($item_list[$i]);
            //$current_cost = $item->unit_cost;
            //$previous_cost = $item->unit_cost;
            //$current_amount = $item->current_amount;

           // $purchased_cost = $unit_price_list[$i];
           // $purchased_qty = $qty_list[$i];

            //$new_cost = (($current_cost * $current_amount) + ($purchased_cost * $purchased_qty))/($current_amount+$purchased_qty) ;
            //$new_amount = $current_amount+$purchased_qty;

            //$item->unit_cost = $new_cost;
            //$item->current_amount = $new_amount;
            //$item->save();


            // Insert it to inventory record
            //DB::table('inventory_record')->insert(
              //  ['item' => $item->id ,'activity'=>'Purchase', 'units_received' => $purchased_qty,'units_sold'=>0.00,'qty_on_hand'=>$new_amount,
                //    'unit_cost'=>$purchased_cost,'previous_cost'=>$previous_cost,'date'=>$date_formatted ,'total_cost'=>$sub_total_list[$i],'vendor'=>$request->input('customer')]
            //);



            //(For sales) Get account receivable from customers

            //$journal_id = $journal->id;

            // Get the inventory account
            //$inventory_account = $item->inventory_account;

            //DB::table('journal_items')->insert(
              //  ['journal_id' => $journal_id , 'date' => $date_formatted,
                //    'account_id'=>$inventory_account,'total_debit'=>$total_amount,
                  //  'total_credit'=>0.00]
            //);

            // Journal Entry
            //$journal->partner = $request->input('customer');
            //$journal->total_debit = $total_amount;
            //$journal->total_credit = $total_amount;
            //$journal->save();
        //}

        // Get payable from supplier
        //$supplier = $this->supplier->find($request->input('customer'));
        //$account_payable=$supplier->account_payable;

        //DB::table('journal_items')->insert(
          //  ['journal_id' => $journal_id , 'date' => $date_formatted,
            //    'account_id'=>$account_payable,'total_debit'=>0.00,
              //  'total_credit'=>$total_amount]
        //);

        $data = [];

        $data['damaged'] = $this->Damaged->all();
        return view('damaged/index', $data);

    }}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}