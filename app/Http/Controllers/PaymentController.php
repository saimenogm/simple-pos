<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Payment as Payment;
use App\Sale as Sale;
use App\Customer as Customer;
use App\Purchase as Purchase;
use App\Supplier as Supplier;
use Illuminate\Support\Facades\DB;

use PdfReport;
use PDF;

class PaymentController extends Controller
{
    //

    public function __construct(Payment $payment, Sale $sale,Customer $customer,Purchase $purchase, Supplier $supplier )
    {
        $this->payment = $payment;
        $this->sale = $sale;
        $this->customer = $customer;
        $this->supplier = $supplier;
        $this->purchase = $purchase;
    }


    public function index()
    {
        $data = [];

        $data['payments'] = $this->payment->all();
        
        return view('payments/index', $data);

    }

    public function index_payments()
    {
        $data = [];

        $data['payments'] = $this->payment->all();
		
        
        return view('payments/index', $data);

    }

    public function index_purchase_payment()
    {
        $data = [];

        $data['payments'] = DB::table('suppliers')
        ->join('payments', 'suppliers.id', '=', 'payments.customer')
        ->where('type','=','out')
        ->get();
        
        return view('purchase_payments/index', $data);

    }

    public function index_sales_payment()
    {
        $data = [];

        // $data['payments'] = $this->payment->all();

        $data['payments'] = DB::table('suppliers')
        ->join('payments', 'suppliers.id', '=', 'payments.supplier')
        ->where('type','=','in')
        ->get();
       

        return view('sale_payments/index', $data);

    }

    public function show($payment_id)
    {
        //$payment_data = $this->payment->find ($payment_id);
        $payment_data = DB::table ('payments')
            ->join ('payments', 'suppliers.id', '=', 'payments.supplier')
            ->select ('payments.*','suppliers.supplier_name')
            ->where ('payments.id', $payment_id)->first ();

        //$data = $payment_data;
        //dd($data->supplier);
        //dd($data);
        $data['modify'] = 1;
        $data['payment'] = $payment_data;

        return view ('sale_payments/detail', $data);

    }
    public function newPaymentPOS(Request $request, Payment $payment)
    {

        $payment = new Payment();
       
        $payment->supplier = $request->input('suppliers'); 
        $payment->amount = $request->input('amount'); 
        $payment->date = $this->change_date_to_standard($request->input('date'));
        $sales_id = $request->input('sales_id');
        $amount_paid = $request->input('amount_paid');
        //dd( $request->input('amount') );
        $payment->activity = $request->input('payment'); 

    
        DB::beginTransaction();
         try
        {
            $payment->save();
            $payment_id = $payment->id;
    
            $count=count($amount_paid);
    
            for($i=0;$i<$count;$i++)
            {
    
                if($amount_paid[$i]>0 || $amount_paid[$i]!=NULL)
                {
                    DB::table('payment_items')->insert(
                        ['purchase_id' => $sales_id[$i] ,'amount'=>$amount_paid[$i],'payment_id'=>$payment_id]
                    );
    
                    $sale = $this->purchase->find($sales_id[$i]);
    
                    $sale->amount_paid = $sale->amount_paid + $amount_paid[$i];
                    if($sale->amount_paid==$sale->total_amount || $sale->amount_paid>$sale->total_amount ){
                        $sale->status = "paid";
                    }
    
                    $supplier = $this->supplier->find($request->input('suppliers'));
                    $supplier->balance = $supplier->balance - $amount_paid[$i];
                    $supplier->save();
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
       
                DB::commit();                   
    
                return redirect('paymentsales');
            }
            
            return view('payments', $data);
    
            
       
       

          }

           //this is for catch
        catch(Exception $e){
            DB::rollBack();
            
        
        
        }    
        
    }


    public function createPaymentPOS(Request $request, Payment $payment)
    {
        $data = [];

        $data['suppliers'] = $this->supplier->all();

        return view('payments/form', $data);

    }


    public function newPaymentSales(Request $request, Payment $payment)
    {
        $payment = new Payment();

        $payment->supplier = $request->input('supplier'); 
        $payment->amount = $request->input('amount'); 
        $payment->date = $request->input('date');

        $sales_id = $request->input('sales_id');
        $amount_paid = $request->input('amount_paid');
        
        DB::beginTransaction();
    
        try
        {
        
       
       
            $payment->save();
            $payment_id = $payment->id;
    
            $count=count($amount_paid);
    
            for($i=0;$i<$count;$i++)
            {
    
                if($amount_paid[$i]>0 || $amount_paid[$i]!=NULL)
                {
                    DB::table('payment_items')->insert(
                        ['purchases_id' => $sales_id[$i] ,'amount'=>$amount_paid[$i],'payment_id'=>$payment_id]
                    );
    
                    $sale = $this->sale->find($sales_id[$i]);
    
    //                $sale = DB::table('sales')->where('id', $sales_id[$i] )->first();
                    $sale->amount_paid = $sale->amount_paid + $amount_paid[$i];
                    if($sale->amount_paid==$sale->total_amount || $sale->amount_paid>$sale->total_amount ){
                        $sale->status = "paid";
                    }
    
                    $supplier = $this->customer->find($request->input('supplier'));
                    $supplier->balance = $customer->balance - $amount_paid[$i];
                    $supplier->save();
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
                
    
                $data['payments'] = $this->payment->all();
    
                DB::commit();          
            
                return redirect('/paymentsales');
        
                //$payment->insert($data);
    
                //return redirect('payments/index_payments');
            }
            return redirect('payments/index', $data);
            
            //return view('payments/form', $data);

          }
         //this is for catch
         catch(Exception $e){
            DB::rollBack();
            
        
        
        }    
        

    }


    public function newPaymentSales2(Request $request, Payment $payment)
    {
        $payment = new Payment();

        $payment->supplier = $request->input('supplier'); 
        $payment->amount = $request->input('amount'); 
        $payment->date = $request->input('date');

        $sales_id = $request->input('sales_id');
        $amount_paid = $request->input('amount_paid');
        
        DB::beginTransaction();
    
        try
        {
        
       
            $payment->save();
            $payment_id = $payment->id;
    
            $count=count($amount_paid);
    
            for($i=0;$i<$count;$i++)
            {
    
                if($amount_paid[$i]>0 || $amount_paid[$i]!=NULL)
                {
                    DB::table('payment_items')->insert(
                        ['sales_id' => $sales_id[$i] ,'amount'=>$amount_paid[$i],'payment_id'=>$payment_id]
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
                
    
                $data['payments'] = $this->payment->all();

                DB::commit();          
       
                return view('payments/index', $data);
        
            }
            
         
       
      }

       //this is for catch
       catch(Exception $e){
        DB::rollBack();
        
    
    
    }    

    }

    public function createPaymentSales(Request $request, Payment $payment)
    {
        $data = [];

        $data['customers'] = $this->customer->all();

        $data['sales'] = DB::table('sales')
        ->where('status', 'unpaid')
        ->where('customer')
        ->get();
        
        return view('receipts/form', $data);

    }


    public function createPaymentSales2(Request $request)
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
    '<td><input type="text" name="amount_paid[]" class="form-control"></td>'.
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
     }     //return view('sale_payments/form', $data);


    public function createPaymentPurchases(Request $request, Payment $payment,$supplier_id)
    {
        $data = [];

        $data['supplier'] = $supplier_id;

        $data['suppliers'] = $this->supplier->all();

        $data['purchases'] = DB::table('purchases')
        ->where('status', 'unpaid')
        ->where('supplier',$supplier_id)
        ->get();
        
        return view('purchase_payments/form', $data);

    }


    public function newPaymentPurchases(Request $request, Payment $payment)
    {
      
        $payment = new Payment();
        $payment->supplier = $request->input('supplier'); 
        $payment->amount = $request->input('amount'); 
        $payment->date = $request->input('date');

        $purchases_id = $request->input('purchases_id');
        $amount_paid = $request->input('amount_paid');
        $payment->type="out";

        DB::beginTransaction();
    
        try
        {

            $payment->save();
            $payment_id = $payment->id;
    
            $count=count($amount_paid);
    
            for($i=0;$i<$count;$i++)
            {
                if($amount_paid[$i]>0 || $amount_paid[$i]!=NULL)
                {
                    DB::table('payment_items')->insert(
                        ['purchase_id' => $purchases_id[$i] ,'amount'=>$amount_paid[$i],'payment_id'=>$payment_id]
                    );
    
                    $purchase = $this->purchase->find($purchases_id[$i]);
    
    //                $purchase = DB::table('purchases')->where('id', $purchases_id[$i] )->first();
                    $purchase->amount_paid = $purchase->amount_paid + $amount_paid[$i];
                    if($purchase->amount_paid==$purchase->total_amount || $purchase->amount_paid>$purchase->total_amount ){
                        $purchase->status = "paid";
                    }
    
                    //dd($request->input('customer'));
                    $supplier = $this->supplier->find($request->input('supplier'));
                    // dd($supplier->balance);
                    $supplier->balance = $supplier->balance + $amount_paid[$i];
                    $supplier->save();
                    $purchase->save();
     
                }
          
            }
    
            if( $request->isMethod('post') )
            {
                
                $this->validate(
                    $request,
                    [
    
    
                    ]
                );
                
    
                //$payment->insert($data);
    
                //return redirect('payments/index_payments');
            }
            //dd('helloworld');
            $data = [];
    
            $data['payments'] = DB::table('suppliers')
            ->join('payments', 'suppliers.id', '=', 'payments.customer')
            ->where('type','=','out')
            ->get();
       
            DB::commit();          
                 
            return view('purchase_payments/index', $data);        
       
       

          }
        //return view('payments/form', $data);
 //this is for catch
        catch(Exception $e){
            DB::rollBack();
            
        
        
        }    
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
    
    public function payment_report(Request $request)
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

            
            $data['payments'] = DB::table('payments')
            ->join('suppliers', 'suppliers.id', '=', 'payments.supplier')
            ->whereBetween('date', [$start_date, $end_date])
            ->get();
    
            //dd($data['payments']);

             //$data['payments'] = $this->payment->all();

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

                $data['payments'] = DB::table('payments')
                ->join('customers', 'customers.id', '=', 'payments.customer')
                ->where('type','=','out')
                ->whereBetween('date', [$start_date, $end_date])
                ->get();

                $data['receipts'] = DB::table('payments')
                ->join('customers', 'customers.id', '=', 'payments.customer')
                ->where('type','=','in')
                ->whereBetween('date', [$start_date, $end_date])
                ->get();
    
                //dd($start_date." ".$end_date);
                
                //dd($data['receipts']);

                
                $pdf = PDF::loadView('reports/payments_report', $data);
                $pdf->save(storage_path().'_filename.pdf');
                return $pdf->stream('payments.pdf');
             
             }else{
                return view('payments/report_index', $data);
             }
    
        }
        return view('payments/report_index', $data);
    }
    public function new_paymentPurchase2(Request $request){
        $data = [];

        $input = $request->all();
        $output="";

try{
    $sales = DB::table('purchases')
    ->where('status', 'unpaid')
    ->where('supplier',$request->supplier_id)
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

    }

public function cancelSupplierPurchaces( $payment_id){
	//dd($payment_id);
	
    DB::beginTransaction();
    
    try
    {
    
        $cancel = $this->payment->find($payment_id);
        $cancel->status='void';
        $cancel->save();
        //dd('in');
        
        $data['payments'] = DB::table('suppliers')
           ->join('payments', 'suppliers.id', '=', 'payments.customer')
           ->where('type','=','out')
           ->get();
   
           DB::commit();          
           
           return view('purchase_payments/index', $data);
        
      

      }
    
    //this is for catch
     catch(Exception $e){
        DB::rollBack();
        
    
    
    }    

	
	
}
}
