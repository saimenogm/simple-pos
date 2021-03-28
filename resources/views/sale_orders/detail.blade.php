

@extends('layouts.app')

@section('content')

<style>

.items{
    background-color:#ccc;
}    
.item{
    background-color:white;
    display:inline;
    float:left;
    margin:6px;
    padding:2px;
}

.item-image{
    display:block;
    margin-left:6%;
}

.item-footer{
    display:block;
    margin-top:0px;
    padding:0px;
    text-align:center;
}



form {
  border: 3px solid #f1f1f1;
}


/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 30%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;

}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 60%;
  }
}


.modala {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(9,0,9,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-contents {
  background-color: #fefefe;
  margin: 5px auto; /* 15% from the top and centered */
  border: 1px solid #888;
  width: 60%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  /* Position it in the top right corner outside of the modal */
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}


.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)}
  to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
  from {transform: scale(0)}
  to {transform: scale(1)}
}


</style>

<script>
//if the sale is void
if ('{{$sales->status}}'=='void'){
 
  document.getElementById('return_id_btn').hidden=true
  

}
function showBlock(){

document.getElementById('id01').style.display='block';

}

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script> 

<div class="card-header">


<div id="id01" class="modala">
  <span onclick="document.getElementById('id01').style.display='none'"
class="close" title="Close Modal">&times;</span>

  <!-- Modal Content -->
  <div class="modal-contents animate" action="#">
    <div class="imgcontainer">
    <h3>Returned Item</h3>
    </div>

    <div style='width:100%;'>
    <form action="{{route('returned_items')}}" method="get">
          <table class="table">
          <thead>
             <th>Item Name</th>
             <th>Amount</th>
             <th>Refunded</th>
          </thead>
          <tr>
                                           
          <INPUT type="hidden" class="form-control " name="sales_id" id="sales_id"  value="{{$sale_id}}"/>
                                                                                
          @foreach($sales_item as $list)                                         
                                                      <INPUT type="hidden" class="form-control " name="item_id[]" id="item_id"  value="{{$list->item}}"/>
                                                      <INPUT type="hidden" class="form-control " name="returned_price[]" id="returned_price"  value="{{$list->unit_price}}"/>
                                                       <INPUT type="hidden" class="form-control " name="returned_discount[]" id="returned_discount"  value="{{$list->discount}}"/>
                                                       <INPUT type="hidden" class="form-control " name="returned_variant[]" id="returned_variant"  value="{{$list->variant}}"/>
                                                       
                                                        <TD><INPUT type="type" class="form-control " name="returned_name[]" id="returned_name"  value="{{$list->item_name}} {{$list->color}} {{$list->size}}"/></td>
                                                        <TD><INPUT type="number" class="form-control " name="returned_qty[]" id="returned_qty" placeholder="Maximum {{$list->qty}}" value=""  max="{{$list->qty}}" /> </td>    
                                                       <td><input type='checkbox' name='refund' value='yes'></td>
                                                                
                                                        </tr>
            @endforeach
                                          
          </table>
    <div>
      <button class="btn btn-small" type="submit">Submit</button>       <button type="button" float:right; onclick="document.getElementById('id01').style.display='none'" class="btn btn-small btn-danger">Cancel</button>
    </div>
    </form>
          
    </div>
    </div>
    </div>
    </div>


<div class="container">

<div class="panel panel-primary">
                                                
                            
                                <div class="panel-heading">                                
                                    <div class="title">
                                        Sales Detail 
                                      
                                    </div>      
                                                            
                                </div>


<div class='panel-body'>
<div class="row">

                   @csrf
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Customer : </label>
                                        <div class="col-md-7">

                                            <select class="form-control" id="customers" name="customer" disabled>
                                                
                                                @foreach ($customers as $customer)
                                                <?php if($sales->customer==$customer->id){
                                                  ?>
                                                    <option value="{{$customer->id}}" selected=true name="{{$customer->id}}">{{$customer->customer_name}}</option>
<?php
?>
                                                    <option value="{{$customer->id}}" name="{{$customer->id}}">{{$customer->customer_name}}</option>
<?php                                                }else{
                                                }?>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    
                
                                    <div class="form-group">
                                            <label class="col-md-3 control-label">Date :</label>
                                            <div class="input-group date col-md-4">
                                            
                                            <label class="col-md-3 control-label">{{$sales->date}}</label>
                                            
                                            </div>
                            
                                    </div>  
                             
                             <div class="form-group">
                                    <label class="col-md-3 control-label">Payment Mode :</label>
                                    <div class="col-md-7">
                                    <label class="col-md-3 control-label"> {{$sales->payment_mode}}</label>
                                          
                                    </div>
                            </div>   

                            <div class="form-group">
                                    <label class="col-md-3 control-label">Amount Paid :</label>
                                    <div class="col-md-7">
                                    <label class="col-md-3 control-label"> {{$sales->amount_paid}}</label>
                                    </div>
                            </div>   



                            <div class="form-group">
                                    <label class="col-md-3 control-label">Status :</label>
                                    <div class="col-md-7">
                                    <label class="col-md-3 control-label"> {{$sales->status}}</label>
                                        </div>
                            </div>

                            <div class="form-group">
                            <label class="col-md-3 control-label">Sale Time:</label>
                            
                            <div>
                            <label class="col-md-7 control-label">
                            <?php
                            $d=strtotime($sales->created_at);
                            echo date("h:i  d-m-Y", $d);                            
                            ?>
                            </div>
                                    </div>
</label>

                            </div>


       </div>                        
                    
                                                                          
                                    <table class="table" id="POITable" onclick="calculate()">
                                            <thead class="thead-inverse">
                                              <tr>
                                                <th>Item</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
                                                <th>discount</th>
                                                <th>Sub Total</th>
                                              </tr>
                                            </thead>
                                    <tbody> 
                                        {{-- do not touch this first <tr> element is it just a template  --}}
                                        @foreach( $sales_item as $sale_item )
                      <tr>
                        <td>{{ $sale_item->item_name }}  {{$sale_item->color}} {{$sale_item->size}}</td>
                        <td>{{ $sale_item->unit_price }}</td>
                        <td>{{ $sale_item->qty }}</td>
                        <td>{{ $sale_item->discount }}</td>
                        <td>{{ $sale_item->sub_total }}</td>
                        </tr>
                  @endforeach

                                       
                                    </tbody>  
                                    
                                    </TABLE>
                                            
                                    <br/>
                            <br/>
    <table class="table">
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total</b></td>
            <td id="total" style="font-weight:bold; font-size:18px;">{{$sales->total_amount}}</td>
        </tr>

    </table>
</div>


<?php

if($sales->status!="void"){
?>


<div style="float:right;">
                <button class="btn btn-success" onclick="document.getElementById('id01').style.display='block';" id='return_id_btn'> Return </button>

</div>

<div style="float:right;">
    <form class="form-horizontal" name="sale_cancel" id="transfer_form" action="{{route('del_sale')}}" method="post">
        @csrf
        <button class="btn btn-danger" type="submit"> Delete </button>
        <input type="hidden" value="{{$sale_id}}" name="sale_id"/>
    </form>
</div>

<?php
}

//echo $sales->created_at;

?>

</div>
                            
                        </div>
                     </div>
                    </div>

               </div>

@endsection

