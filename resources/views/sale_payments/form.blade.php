
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
      <div class="medium-12 large-12 columns">
        <form action="" method="post" name="create_paymentSales">
        @csrf
            <table class="table">
          <tr><td>
            <label>Customer</label> <label>{{$customer_data->customer_name}}</label></td><td>

<!--        <input type='hidden' name='customer' value="{{$customer}}" /> -->

 <select class="form-control" name="customer" id="customer" >                                                
 <option value=""></option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                                                @endforeach
</select>

        </td></tr>
        <tr><td>
            <label>Amount</label></td><td>
            <input name="amount" type="text" value="" class="form-control" required>
        </td></tr>
        <tr><td>
            <label>Ref</label></td><td>
            <input name="ref" type="text" value="" class="form-control">
        </td></tr>
        <tr><td><label>Date</label></td><td> <input  name="date" type="date" value="" class="form-control">
            </td>
        </tr>
        
        </table>

        <table class="table">
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
$('#customer').on('change',function(){
    //alert('kdsjflsdfls');
//$value=$(this).val();
var customer = document.getElementById('customer');
        customer_id = customer.value;

//console.log(customer_id);

$.ajax({
//    console.log(customer_id);

type : 'get',
//url : '{{URL::to('new_paymentSales2')}}',
url:'/paymentsales/new_pay',

data:{'customer_id':customer_id},
success:function(data){
$('#table-data').html(data.data);
//document.getElementById("table-data").innerHTML=xmlhttp.responseText;
//alert(data.data);
//console.log(customer_id);

}
});
})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

    @endsection
