

@extends('layouts.app')

@section('content')

<div class="container">

<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">

                            <div class="panel panel-default" onkeypress="return noenter()">
                                <div class="panel-heading" onkeypress="return noenter()">
                                    <h2 class="panel-title">
                                        <B>Purchase Details</B></h2>
                                </div>

                                <div class="panel-body">
                                    <div class="block-content" onkeypress="return noenter()">

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Supplier : </label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="suppliers" name="supplier" disabled>
                                                
                                                @foreach ($suppliers as $supplier)
                                                <?php if($purchases->supplier==$supplier->id){

?>
                                                    <option value="{{$supplier->id}}" selected=true name="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
<?php
?>
                                                    <option value="{{$supplier->id}}" name="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
<?php                                                }else{
                                                }?>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <br/><br/>

                                    <div class="form-group">
                                            <label class="control-label col-md-3">Date :</label>
                                            
                                            <label class="col-md-3" >{{$purchase_date}}</label>
                                    </div>
                                      <br/>
                             
                             <div class="form-group">
                                    <label class="col-md-3 control-label">Ref No :</label>
                                    <label class='col-md-3 control-label'>{{$purchases->ref}}</label>
                                    
                            </div>
                                <br/>

                          <div class="form-group" style="display: block;">
                                    <label class="col-md-3 control-label">Payment Mode:</label>
                                    <label class='col-md-3 control-label'>{{$purchases->payment_mode}}</label>

                            </div>
                          <br/>

                            <div class="form-group">
                                    <label class="col-md-3 control-label">Payment Status:</label>
                                    <label class='col-md-3 control-label'>{{$purchases->status}}</label>
                                    
                            </div>   

<br/>
                                        <br/>

                                    <table class="table table-bordered">
                                            <thead class="thead-inverse">
                                              <tr>
                                                <th>Item</th>
                                                <th>Unit Cost</th>
                                                <th>Quantity</th>
                                                <th>Sub Total</th>
                                                  <th>Shop</th>
                                                  <th>Store</th>

                                              </tr>
                                            </thead>
                                    <tbody> 
                                        {{-- do not touch this first <tr> element is it just a template  --}}
                                        @foreach( $purchases_item as $purchase_item )
                      <tr>
                        <td>{{ $purchase_item->item_name }} {{ $purchase_item->size }} {{ $purchase_item->color }}</td>
                        <td>{{ $purchase_item->unit_price }}</td>
                        <td>{{ $purchase_item->qty }}</td>
                        <td>{{ $purchase_item->sub_total }}</td>
                        <td>{{ $purchase_item->shop }}</td>
                        <td>{{ $purchase_item->store }}</td>
                      </tr>
                  @endforeach

                                       
                                    </tbody>  
                                    
                                    </TABLE>
                                    
                                    
                                </form>  
                                
                            </div>


                            </div>
                            <div>
                            <br/>
                            <br/>
    <table class="table">
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total</b></td>
            <td id="total"><B><u>{{$purchases->total_amount}}</u></B></td>
        </tr>

    </table>

<div style="float:right;">
<?php
if($purchases->status!="void"){
    ?>
                            <form class="form-horizontal" name="sale_cancel" id="transfer_form" action="{{route('del_purchase')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{$purchase_id}}" name="purchase_id"/>
                                    <input value="Delete Purchase" class="btn btn-danger" type="submit">
                                </form>
    <?php
}
?>
    
                            </div>
                     </div>
                            
                    </div>

               </div>


@endsection

