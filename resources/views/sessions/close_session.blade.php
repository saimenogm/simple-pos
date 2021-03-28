
@extends('layouts.app')

@section('content')

<div class="row">

<div class="col-md-6 col-sm-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Session</h3>
</div>
<div class="panel-body">

      <div class="row">
      <div class="medium-4 large-4 columns">
      <form action="{{route('close_session_save')}}" method="post">
        @csrf  <?php                 
                  $ending_bal=0 ;
                    $total_sales=0; 
                  foreach( $session_sales as $sale ){
                    $ending_bal=$ending_bal+ $sale->amount_paid;
                }                   
                $total_sales=$ending_bal;
                   $ending_bal=$ending_bal+$session->beginning_bal;
                   ?>
     <table class="table">   
<tr><td>
            <label>Beginning Balance</label></td><td>
            <input name="beginning_bal" id="begning_bal" type="text" value="{{$session->beginning_bal}}"  class="form-control" >
           
</td></tr>

                


    <tr><td>
            <label>Ending Balance</label></td><td>
            <input name="ending_bal" id="ending_bal" type="text" value={{$ending_bal}} onchange=" total_sale()"class="form-control" >
         
        </td>
    </tr>

    <tr><td>
            <label>Total Amount Sold</label></td><td>
            <input name="total_amount" id='total_sales' type="text" value='{{$total_sales}}'  class="form-control" >
           
        </td></tr>

   

<tr><td>
            <label>User</label></td><td>
            <input name="user" type="text" value="{{$session->name}}"  class="form-control">
           
</td></tr>

<tr><td>
            <label>Reciver</label>
            </td>

<td>
            <select class="form-control" id="name" name="reciver">
<option></option>
@foreach ($users as $user)
    <option value="{{$user->name}}" >{{$user->name}}</option>


@endforeach

</select>


</tr>
        <tr><td></td><td>
            <button type='Submit'  class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Close Session </button>
            </td></tr>
            </table>
        </form>

    </div>
    </div> 
    
</div>
<script>
 
function total_sale(){
   
    
var beg=document.getElementById('begning_bal').value;
var end=document.getElementById('ending_bal').value;
document.getElementById('total_sales').value=Number(beg)+Number(end);
}
</script>


    @endsection
