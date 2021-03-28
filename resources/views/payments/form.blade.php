
@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-md-6 col-sm-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Payment </h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  

      <div class="row">
      <div class="medium-15 large-15 columns" >
        <form action="" method="post" name="new_payment_pos">
        @csrf
       
            <table class="table">
          <tr><td>
            <label>Supplier</label></td><td>
            <select class="form-control" id="supplier" name="suppliers" onchange='change_()'>
                                                <option></option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}" name="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                                @endforeach

                                            </select>
        </td></tr>
        <tr><td>
            <label>Amount</label></td><td>
            <label name="amount1" id='amount1'>0.00</label>
            
        </td></tr>
        <input type='hidden' name="amount" id='amount' class='form-control' value="0" >
        <tr><td>
            <label>Ref</label></td><td>
            <input name="ref"  class='form-control' type="text" value="">
        </td></tr>
        <tr><td>
            <label>Date</label></td><td>
            <div class="input-group bs-datepicker">
                                                            <input type="date" class="form-control" id="iv_date" name="date" required/>
                                                            <span class="input-group-addon">
                                                                <span class="icon-calendar-full"></span>
                                                            </span>
                                                        </div>
        </td></tr>
        
        </table>

        <table id='table_payment' class="table">
                                    <thead>
                                        <tr>
                                            <th>Purchase Id</th>
                                            <th>Ref</th>
                                            <th>Date</th>
                                            <th>total amount</th>
                                            <th>Amount to pay</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody id="table-data">

                                                      
                                    </tbody>

                                    </table>
                                
            <button type='Submit' class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Save </button>
           
        
        </form>

    </div>
    </div> 
</div>
</div>
</div>
<script type="text/javascript">

function test(x){
    var tbl=document.getElementById('table_payment')
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
  amount1.value=sub
  amount1.innerHTML=sub
  amount.value=sub
 }


$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
function change_(){
    var amount1=document.getElementById('amount1')
    var amount=document.getElementById('amount')
    amount.value=0
    amount1.value=0
    amount1.innerHTML=0
var supplier = document.getElementById('supplier');
        supplier_id = supplier.value;

console.log(supplier_id);

$.ajax({
//    console.log(customer_id);

type : 'get',
//url : '{{URL::to('new_receiptSales2')}}',
url:"{{route('new_paymentPurchase2')}}",

data:{'supplier_id':supplier_id},
success:function(data){
$('#table-data').html(data.data);

//document.getElementById("table-data").innerHTML=xmlhttp.responseText;
//alert(data.data);
//console.log(customer_id);

}
});
}
</script>
    @endsection
