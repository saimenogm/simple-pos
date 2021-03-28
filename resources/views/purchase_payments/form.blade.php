
@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-md-6 col-sm-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Payment</h3>
</div>
<div class="panel-body"> 
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
        <form action="" method="post" name="create_paymentPurchases">
        @csrf
            <table class="table">
          <tr><td>
            <label>Supplier</label></td><td>
        <!--    <input name="supplier" type="text" value=""> -->
        <select class="form-control" id="suppliers" name="supplier">

                    @foreach ($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}" name="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                                @endforeach
                                                </select>

        </td></tr>
        <tr><td>
            <label>Amount</label></td><td>
            <input class='form-control' name="amount" id='amount' type="text" value="">
        </td></tr>
       
        <tr><td>Date</td><td> <input class='form-control'  name="date" type="date" value="">
            </td>
        </tr>
        </table>

        <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Date</th>
                                            <th>total amount</th>
                                            <th>Amount to pay</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $purchases as $purchase )
                      <tr>
                      <td>{{ $purchase->id }}<input type="hidden" name="purchases_id[]" value="{{$purchase->id}}"></td>
                        <td>{{ $purchase->date }}</td>
                        <td>{{ $purchase->total_amount - $purchase->amount_paid }}</td>
                        <td><input class='form-control' onchange='test(this)' type="text" name="amount_paid[]"></td>
                        </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
        
        <button type='Submit' role='button' class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Save </button>
        </form>
    </div>
    </div> 
</div>
</div>
</div>
<script>
function test(x){
  
  var amount=document.getElementById('amount')
  amount.value=Number(amount.value)+Number(x.value)
 }
</script>
    @endsection
