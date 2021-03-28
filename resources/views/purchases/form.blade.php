@extends('layouts.app')

@section('content')

<div class="container">

<div class="block-content">
                                <form class="form-horizontal"  action="" method="post">
@csrf
                                <div class="panel panel-primary" onkeypress="return noenter()">
<div class="panel-heading" onkeypress="return noenter()">
    <h2 class="panel-title"><B>New Purchase </B></h2>
</div>


<div class="panel-body">
<div class="block-content" onkeypress="return noenter()">

    <script>


$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});


function deleteRow(pos) {
    var total=0;
    var row=pos.parentNode.parentNode;
    var tbl=document.getElementById('myTable');
    if (tbl.rows.length==2){
       // tbl.rows[row.rowIndex].cells[6].getElementsByTagName('button')[0].disabled=true;
        document.getElementsByClass('btn').disabled=true
    }
    else{
    tbl.deleteRow(row.rowIndex);
    //alert(row.rowIndex)

    for(var i=1;i<tbl.rows.length;i++)
    {
        var quantity=tbl.rows[i].cells[1].getElementsByTagName('input')[0].value;
        var unit_price=tbl.rows[i].cells[2].getElementsByTagName('input')[0].value;
        var sub_total=(unit_price*quantity);
        total=total+sub_total;

    }
    document.getElementById('total').innerHTML = total;
}
}

function  calculator(pos) {
    var total = 0;
    var sub_total;
    var row = pos.parentNode.parentNode;
    var tbl = document.getElementById('myTable');
    var quantity = tbl.rows[row.rowIndex].cells[1].getElementsByTagName('input')[0].value;
    var unit_price = tbl.rows[row.rowIndex].cells[2].getElementsByTagName('input')[0].value;
    sub_total = (quantity * unit_price);
    tbl.rows[row.rowIndex].cells[3].getElementsByTagName('input')[0].value = sub_total;
    tbl.rows[row.rowIndex].cells[3].getElementsByTagName('input')[1].value = sub_total;
    for(var i=1;i<tbl.rows.length;i++){

        var quantity=tbl.rows[i].cells[1].getElementsByTagName('input')[0].value;
        var unit_price=tbl.rows[i].cells[2].getElementsByTagName('input')[0].value;
        sub_total=(unit_price*quantity);
        total=total+sub_total;

    }


    document.getElementById('total').innerHTML = total;
}

function insRow(id)
{
    var filas = document.getElementById("myTable").rows.length;
    //alert(filas)

    var n = document.getElementById("main_item").innerHTML;

    var x = document.getElementById(id).insertRow(filas);
    var a = x.insertCell(0);
    var b = x.insertCell(1);
    var c = x.insertCell(2);
    var d = x.insertCell(3);
    var e = x.insertCell(4);
    var h = x.insertCell(5);
    var z = x.insertCell(6);


    a.innerHTML = n;
    b.innerHTML = '<INPUT type="text" class="form-control" name ="qty[]" id="qty"  onchange="calculator(this);" id="lngbox" placeholder="Quantity" required/>';
    c.innerHTML = '<INPUT type="text" class="form-control" name="unit_price[]" id="lngbox"  onchange="calculator(this);" id="unit_price" placeholder="Unit Cost"  required/>';
    d.innerHTML = '<INPUT type="text" name="sub_total[]" id="lngbox" placeholder="Sub Total" class="form-control" disabled /><INPUT name="sub_total_h[]" type="hidden" id="lngbox"  disabled/>';
    //e.innerHTML = '<input type="date" class="form-control" id="iv_date" name="expire_date[]" placeholder="Expire Date">';
    //f.innerHTML = '<input type="text" id="fname" class="form-control" name="barcode[]" onkeypress="return noenter()" placeholder="Barcode"/>';
    e.innerHTML = '<input type="text" class="form-control" id="shop" name="shop[]" placeholder="shop" required/>';
    h.innerHTML = '<input type="text" class="form-control" id="store" name="store[]" placeholder="store" required/>';
    z.innerHTML ='<button id="btn" name="btn"  class="btn btn-sucess bb" onclick="deleteRow(this);" > Delete</button>';
    //k.innerHTML = n;
}


function noenter() {
  return !(window.event && window.event.keyCode == 13); 
  }


</script>

<div class="form-group">
<br/>
                                        <label class="col-md-2">Supplier : </label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="suppliers" name="supplier" required>
                                            <option></option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}" name="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                            <label class="col-md-2 ">Date :</label>
                                            <div class="col-md-4">
                                                            <input type="date" class="form-control" name="date" required/>
                                            </div>
                                    </div> 

                             <div class="form-group">
                                    <label class="col-md-2 ">Ref No :</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="ref" id="ref">
                                    </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 ">Payment Mode:</label>
                                      <div class="col-md-4">
                               
                                        <select class="form-control" id="payment" name="payment" required>   
                                            <option></option>                                                                                       
                                            <option value="Cash">Cash</option>
                                            <option value="Credit">Credit</option>                                          
                                        </select>
                                       </div>  
                            </div> 

                      </div>

<div class="block">
    <table id="myTable" class="table"  onkeypress="return noenter();">
    <thead class="thead-inverse">
                                              <tr>
                                                <th>Items</th>
                                                <th>Quantity</th>
                                                <th>Unit Cost</th>
                                                <th>Sub Total</th>
                                                <th>Received Shop</th>
                                                <th>Received Store</th>
                                                <th>Delete</th>
                                              </tr>
                                            </thead>
    <tr>

    <TD id="main_item">

            <select class="form-control" id="item" name="item[]" required>

            <option value=""></option>

                @foreach ($items as $item)
                <?php 
                if($item->variant_name!=null){
                    $item_variety = " [".$item->variant_name."]";
                }else{
                    $item_variety="";
                }
                    ?>
                    <option value="{{$item->id}}-{{$item->barcode_id}}" name="{{$item->id}}">{{$item->item_name}} {{$item_variety}}</option>
                @endforeach

            </select>

                                                                                            </TD>

                                            <TD><INPUT type="text" class="form-control" name ="qty[]" id="qty"  onchange="calculator(this);" placeholder="Quantity"  required/></TD>
                                            <TD><INPUT type="text" class="form-control" name="unit_price[]" id="lngbox"  onchange="calculator(this);" id="unit_price" placeholder="Unit Cost"  required/></TD>
                                            <TD><INPUT type="text" name="sub_total[]" id="lngbox" class="form-control" disabled/>
                                            <input name="sub_total_h[]" type="hidden" id="lngbox" /></TD>
    <td><input type="text" class="form-control" id="shop" name="shop[]" placeholder="Qty Received Shop" required></td>
    <td><input type="text" class="form-control" id="store" name="store[]" placeholder="Qty Received Store" required></td>
    <td><input type="button" value="Delete" class="btn btn-danger" onclick="deleteRow(this);"></td>
    </tr>
    </table>
  
    <p>
<div style="float:right"><input type="button" onclick="insRow('myTable')" class="btn btn-success btn-sm" value="Add Item"> </div>
</p>

</div>
    <table class="table">
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total</b></td>
            <td id="total"></td>
        </tr>

    </table>


<button type="submit" class="btn btn-info">SAVE</button>
</form>

<script>

bootstrapValidate(
   '#qty',
   'number:Enter a valid E-Mail Address!'
);
</script>


@endsection
