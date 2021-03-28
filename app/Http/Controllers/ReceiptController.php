<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Receipt as Receipt;
use App\Sale as Sale;
use App\Customer as Customer;
use App\Purchase as Purchase;
use App\Supplier as Supplier;
use Illuminate\Support\Facades\DB;

use PdfReport;
use PDF;

class ReceiptController extends Controller
{

    public function __construct(Receipt $receipt, Sale $sale,Customer $customer,Purchase $purchase, Supplier $supplier )
    {
        $this->receipt = $receipt;
        $this->sale = $sale;
        $this->customer = $customer;
        $this->supplier = $supplier;
        $this->purchase = $purchase;
    }


    public function index()
    {
        $data = [];

        $data['receipts'] = $this->receipt->all();
        
        return view('receipts/index', $data);

    }

    public function index_receipts()
    {
        $data = [];

        $data['receipts'] = $this->receipt->all();
        return view('receipts/index', $data);
    }

    public function index_purchase_receipt()
    {
        $data = [];

        $data['receipts'] = DB::table('suppliers')
        ->join('receipts', 'suppliers.id', '=', 'receipts.customer')
        ->where('type','=','out')
        ->get();
        
        return view('purchase_receipts/index', $data);
    }

    public function index_sales_receipt()
    {
        $data = [];

        // $data['receipts'] = $this->receipt->all();

        $data['receipts'] = DB::table('customers')
        ->join('receipts', 'customers.id', '=', 'receipts.customer')
        ->where('type','=','in')
        ->get();
//dd( $data['receipts']);
        return view('receipts/index', $data);

    }

    public function createReceiptPOS(Request $request, Receipt $receipt)
    {
        $data = [];

        $data['customers'] = $this->customer->all();
        return view('receipts/form', $data);

    }


    public function newReceiptSales(Request $request, Receipt $receipt)
    {
        $receipt = new Receipt();

        $receipt->customer = $request->input('customer'); 
        $receipt->amount = 0.00; 
        $receipt->date = $this->change_date_to_standard($request->input('date'));
        $receipt->remark = $request->input('remark'); 

        $sales_id = $request->input('sales_id');
        $amount_paid = $request->input('amount_paid');
        //dd($sales_id);
        
        DB::beginTransaction();
    
        try
        {
        
            $receipt->save();
            $receipt_id = $receipt->id;
    
            $total_receipt=0.00;
    
           
            $count=count($amount_paid);
    
            for($i=0;$i<$count;$i++)
            {
    
                if($amount_paid[$i]>0 || $amount_paid[$i]!=NULL)
                {
                    DB::table('receipt_items')->insert(
                        ['sales_id' =>$sales_id[$i] ,'amount'=>$amount_paid[$i],'receipt_id'=>$receipt_id]
                    );
    
                    $total_receipt+=$amount_paid[$i];
                    $sale = $this->sale->find($sales_id[$i]);
    
    //                $sale = DB::table('sales')->where('id', $sales_id[$i] )->first();
                    $sale->amount_paid = $sale->amount_paid + $amount_paid[$i];
                    if($sale->amount_paid==$sale->total_amount || $sale->amount_paid>$sale->total_amount ){
                        $sale->status = "paid";
                    }
    
                    $customer = $this->customer->find($request->input('customer'));
                    $customer->balance = $customer->balance - $amount_paid[$i];
                    $customer->save();
                    $sale->save();
     
                }
          
            }
    
            $receipt->amount = $total_receipt;
            $receipt->save();
    
            if( $request->isMethod('post') )
            {
                
                $this->validate(
                    $request,
                    [
    
    
                    ]
                );
                
    
                $data['receipts'] = $this->receipt->all();
                DB::commit();          
            
                return redirect('/receiptsales');
        
                //$receipt->insert($data);
    
                //return redirect('receipts/index_receipts');
            }
            return redirect('receipts/index', $data);
            
            //return view('receipts/form', $data);
    
       

          }

     
           //this is for catch
        catch(Exception $e){
            DB::rollBack();
            
        
        
        }    
    }


    public function cancelReceipt(Request $request)
    {

        $receipt_id = $request->input('receipt_id');
        $receipts_id = $receipt_id;
        $receipt = $this->receipt->find($receipts_id);
        $receipt->status = "void";

        $receipts_data = $this->receipt->find($receipts_id);

        $customer = $this->customer->find($receipt->customer);

        $customer->balance = $customer->balance + $receipt->amount;
        DB::beginTransaction();
    
        try
        {
        
            $customer->save();
            $receipt->save();
    
    
            $receipt_items = DB::table('receipt_items')
            ->where('receipt_id', $receipt_id)
            ->get();
    
            foreach($receipt_items as $item ){
                
                $sales_data = $this->sale->find($item->sales_id);
                $sales_data->amount_paid -= $item->amount;
                $sales_data->save();
            }
    
            $data = [];
    
            $total_amount=0.00;
    
                $input = $request->all();
    
                $receipt->status ='void';
                $receipt->save();
    
    
                // Update items to void
                DB::table('receipt_items')
                    ->where('receipt_id', $receipts_id)
                    ->update(['status' => 'void']);
    
           
       
         DB::commit();          

          } 

           //this is for catch
        catch(Exception $e){
            DB::rollBack();
            
        
        
        }    
    }

    public function newReceiptSales2(Request $request, Receipt $receipt)
    {
        $receipt = new Receipt();

        $receipt->customer = $request->input('customer'); 
        $receipt->amount = $request->input('amount'); 
        $receipt->date = $request->input('date');

        $sales_id = $request->input('sales_id');
        $amount_paid = $request->input('amount_paid');

        DB::beginTransaction();
    
        try
        {
        
            $receipt->save();
            $receipt_id = $receipt->id;
    
            $count=count($amount_paid);
    
            for($i=0;$i<$count;$i++)
            {
    
                if($amount_paid[$i]>0 || $amount_paid[$i]!=NULL)
                {
                    DB::table('receipt_items')->insert(
                        ['sales_id' => 67 ,'amount'=>868,'receipt_id'=>$receipt_id]
                    );
    
                    $sale = $this->sale->find($sales_id[$i]);
    
    //                $sale = DB::table('sales')->where('id', $sales_id[$i] )->first();
                    $sale->amount_paid = $sale->amount_paid + $amount_paid[$i];
                    if($sale->amount_paid==$sale->total_amount || $sale->amount_paid>$sale->total_amount ){
                        $sale->status = "paid";
                    }
    
                    $customer = $this->customer->find($request->input('customer'));
                    $customer->balance = $customer->balance - $amount_paid[$i];
                    $customer->save();
                    $sale->save();
     
                }
          
            }
    
            if( $request->isMethod('post') )
            {
                
                $this->validate(
                    $request,
                    [
    
    
                    ]
                );
                
    
                $data['receipts'] = $this->receipt->all();

                DB::commit();          
       
                return view('receipts/index', $data);
        
            }
            
           
       
     
          }
           //this is for catch
        catch(Exception $e){
            DB::rollBack();
            
        
        
        }    
     
    }

    public function createReceiptSales(Request $request, Receipt $receipt)
    {
        $data = [];

        $data['customers'] = $this->customer->all();

        $data['sales'] = DB::table('sales')
        ->where('status', 'unpaid')
        ->where('customer')
        ->get();
        
        return view('receipts/form', $data);

    }


    public function createReceiptSales2(Request $request)
    {
        $data = [];

        $input = $request->all();

        //$data['customers'] = $this->customer->all();

  //      $data['customer'] = $customer_id;

    //    $customer_data = $this->customer->find($customer_id);
//$data['customer_data'] = $customer_data;
//        $data['customers'] = $this->customer->all();

        

//        if($request->ajax())
//{
$output="";

try{
    $sales = DB::table('sales')
    ->where('status', 'unpaid')
    ->where('customer',$request->customer_id)
    ->get();
    
    
    //$products=DB::table('products')->where('title','LIKE','%'.$request->search."%")->get();
    if($sales)
    {
    foreach ($sales as $sale) {
    $output.='<tr>'.
    '<td>'.$sale->id.'<input type="hidden" name="sales_id[]" value="'.$sale->id.'"></td>'.
    '<td>'.$sale->ref.'</td>'.
    '<td>'.$sale->date.'</td>'.
    '<td>'.($sale->total_amount - $sale->amount_paid).'</td>'.
    '<td><input type="text" onchange="test(this)" name="amount_paid[]" class="form-control"></td>'.
    '</tr>';
    }

}
return response()->json(['failure'=>'success','data'=>$output]);

}catch(\Exception $e){

//    DB::rollBack();
//throw $e;
return response()->json(['failure'=>'success','item'=>'error'.$e]);
//$output = $e;
}
return response()->json(['failure'=>'success','data'=>$output]);
//   }
//   return Response($request->customer_id);
//  echo "sdkfjsdlkjf"; 
     }     //return view('Receipts/form', $data);
    
    

    public function createReceiptPurchases(Request $request, Receipt $receipt,$supplier_id)
    {
        $data = [];

        $data['supplier'] = $supplier_id;

        $data['suppliers'] = $this->supplier->all();

        $data['purchases'] = DB::table('purchases')
        ->where('status', 'unpaid')
        ->where('supplier',$supplier_id)
        ->get();
        
        return view('purchase_receipts/form', $data);

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
    
    
    public function change_date_to_readable($date)
    {
        $date=date("d/m/Y",strtotime($date));
        return $date;

    }
    
    public function receipt_report(Request $request)
    {
        $data = [];

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $print = $request->input('print');

        $start_date_org = $request->input('start_date');
        $end_date_org = $request->input('end_date');

       // dd("slkdhflskdjf");



        if(isset($start_date) && isset($end_date) ){

            //dd($start_date);

            $start_date = str_replace('/','-',$start_date);
            $array = explode('-',$start_date);
            $year=$array[2];
            $month=$array[1];
            $day=$array[0];
            $start_date=join('-',[$year,$month,$day]);
    
            $end_date = str_replace('/','-',$end_date);
            $array = explode('-',$end_date);
            $year=$array[2];
            $month=$array[1];
            $day=$array[0];
            $end_date=join('-',[$year,$month,$day]);

            //$d1=new date_format($start_date,"d/m/Y");
            

            $data['d1']=date("d/m/Y",strtotime($start_date));
            $data['d2']=date("d/m/Y",strtotime($end_date));
            //dd($d2);

            
            $data['receipts'] = DB::table('receipts')
            ->join('customers', 'customers.id', '=', 'receipts.customer')
                ->whereBetween('date', [$start_date_org, $end_date_org])
            ->get();
    
            //dd($data['receipts']);

             //$data['receipts'] = $this->receipt->all();

             $data['start_date']=$start_date;
             $data['end_date']=$end_date;
          
             $data['customers'] = $this->customer->all();

             if(isset($print))
             {
                //dd($request->input('start_date'));

                $start_date = $this->change_date_to_standard( $request->input('start_date')) ;
                $end_date = $this->change_date_to_standard( $request->input('end_date')) ;

                $data['start_date']= $this->change_date_to_standard( $request->input('start_date')) ;
                $data['end_date']=$this->change_date_to_standard( $request->input('end_date'));

                $data['receipts'] = DB::table('receipts')
                ->join('customers', 'customers.id', '=', 'receipts.customer')
                ->where('type','=','out')
                ->whereBetween('date', [$start_date, $end_date])
                ->get();

                $data['receipts'] = DB::table('receipts')
                ->join('customers', 'customers.id', '=', 'receipts.customer')
                ->where('type','=','in')
                ->whereBetween('date', [$start_date, $end_date])
                ->get();
    
                //dd($start_date." ".$end_date);
                
                //dd($data['receipts']);

                
                $pdf = PDF::loadView('reports/receipts_report', $data);
                $pdf->save(storage_path().'_filename.pdf');
                return $pdf->stream('receipts.pdf');
             
             }else{
                return view('receipts/report_index', $data);
             }
    
        }
        return view('receipts/report_index', $data);
 
    }


	public function show($receipt_id)
	
    {
        $data = []; 

        $data['customers'] = $this->customer->all();

        //$data['customer_id'] = $customer_id;
        $data['modify'] = 1;
        $data['receipts'] = DB::table('receipts')
        ->join('customers', 'customers.id', '=', 'receipts.customer')
        ->where('receipts.id', '=',$receipt_id)->first();

        $data['date'] = $this->change_date_to_readable($data['receipts']->date);
        $receipts = DB::table('receipts')
        ->where('receipts.id', '=',$receipt_id)->first();
        $remark=$receipts->remark;
       
        $data['receipt_id']=$receipt_id;
        $data['receipt_items'] = DB::table('receipt_items')
        ->join('sales','sales.id','=','receipt_items.sales_id')
        ->where('receipt_items.receipt_id','=', $receipt_id)
        ->get();
    // dd($data['receipt_items'] );
        //$data['customer_name'] = $customer_data->customer_name;
        
      
	
//dd($data);
             return view('receipts/detail',  $data)->with('remark',$remark);


    }

public function cancelSupplierPurchaces( $receipt_id){
    //dd($receipt_id);
    $cancel = $this->receipt->find($receipt_id);
	 $cancel->status='void';
	  
    DB::beginTransaction();
    
    try
    {
    
        $cancel->save();
        //dd('in');
        
        $data['receipts'] = DB::table('suppliers')
           ->join('receipts', 'suppliers.id', '=', 'receipts.customer')
           ->where('type','=','out')
           ->get();
           DB::commit();          

           return view('purchase_receipts/index', $data);
     }
   
     //this is for catch
  catch(Exception $e){
    DB::rollBack();
    

 
       }   
      }
	
	 
  
}
