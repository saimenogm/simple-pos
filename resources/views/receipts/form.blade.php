
@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-md-6 col-sm-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Receipt </h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
        <form action="" method="post" name="create_receiptSales">
        @csrf
            <table class="table">
          <tr><td>
            <label>Customer</label></td><td>

 <select class="form-control" name="customer" id="customer" onchange='cust()' >                                                
 <option value=""></option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                                                @endforeach
</select>

        </td></tr>
        <tr><td>
            <label>Amount</label></td><td>
            <label id='amount1' name="amount1">0</label>
            <input id='amount' type='hidden' name="amount" type="text" value="0" class="form-control" disabled>
        </td></tr>
        <tr><td>
            <label>Ref</label></td><td>
            <input name="ref" type="text" value="" class="form-control">
        </td></tr>

        <tr><td><label>Date</label>
        </td><td>
        <div class="input-group bs-datepicker">
                                                            <input type="date" class="form-control" id="iv_date" name="date" required/>
                                                            <span class="input-group-addon">
                                                                <span class="icon-calendar-full"></span>
                                                            </span>
                                                        </div>
            </td>
        </tr>

        <tr><td>
            <label>Remark</label></td><td>
            <input name="remark" type="text" value="" class="form-control">
        </td></tr>

        </table>

        <table id='table_receipts' class="table">
                                    <thead>
                                        <tr>
                                            <th>Sales Id</th>
                                            <th>Ref</th>
                                            <th>Date</th>
                                            <th>total amount</th>
                                            <th>Amount to pay</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody id="table-data">

<!--
                 @foreach( $sales as $sale )
                      <tr>
                      <td>{{ $sale->id }}<input type="hidden" name="sales_id[]" value="{{$sale->id}}"></td>
                        <td>{{ $sale->ref }}</td>
                        <td>{{ $sale->date }}</td>
                        <td>{{ $sale->total_amount - $sale->amount_paid }}</td>
                        <td><input type="text" name="amount_paid[]" class="form-control"></td>
                        </tr>
                  @endforeach
    -->                                                          
                                    </tbody>
                                </table>
        
        <button type='Submit' role='button' class='btn btn-info'> <i class='fa fa-fw fa-save'></i> Save </button>
        </form>
    </div>
    </div> 
</div>
</div>
</div>
<script type="text/javascript">
function cust(){
  
var customer = document.getElementById('customer');
        customer_id = customer.value;

console.log(customer_id);

$.ajax({
//    console.log(customer_id);

type : 'get',
//url : '{{URL::to('new_receiptSales2')}}',
url:"{{route('new_receiptSales2')}}",

data:{'customer_id':customer_id},
success:function(data){
$('#table-data').html(data.data);

//document.getElementById("table-data").innerHTML=xmlhttp.responseText;
//alert(data.data);
//console.log(customer_id);

}
});
}
function test(x){
  
    var tbl=document.getElementById('table_receipts')
    var sub=0
    
    for (i=1;i<tbl.rows.length;i++){
        j=tbl.rows[i].cells[4].getElementsByTagName('input')[0].value 
 
        if (j==''){
            j=0
        }
        sub=sub+Number(j)
      
    }
   var amount1=document.getElementById('amount1')
  
  var amount=document.getElementById('amount')
  amount1.innerHTML=sub
  amount.value=sub
}
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

    @endsection
