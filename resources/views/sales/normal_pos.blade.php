
@extends('layouts.app')

@section('content')

<script>
   
var checker=false;

var check= new Array();

function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    var table=document.getElementById('POITable')
    var id=table.rows[i].cells[1].getElementsByTagName('input')[1].value;
    table.deleteRow(i);

// remove from check
    for(var j=0;j<=table.rows.length;j++){
        if(check[j]==id){
            check.splice ( j, 1 );
        }
    }

   calculate_table_total();


// remove from barcode, barcode items, barcode qty


}
function  calculator(pos) {
        var total=0;
        var sub_total=0;
        var row = pos.parentNode.parentNode;
        var tbl=document.getElementById('POITable');
        
      var price=tbl.rows[row.rowIndex].cells[1].getElementsByTagName('input')[0].value;
        
        var discount=tbl.rows[row.rowIndex].cells[3].getElementsByTagName('input')[0].value;
        var amount=tbl.rows[row.rowIndex].cells[2].getElementsByTagName('input')[0].value;
        sub_total=(price*amount)-discount;
    
       
        tbl.rows[row.rowIndex].cells[4].getElementsByTagName('input')[0].value=sub_total;
        tbl.rows[row.rowIndex].cells[4].getElementsByTagName('input')[1].value=sub_total;
        for(var i=1;i<tbl.rows.length;i++){
            var price=tbl.rows[i].cells[1].getElementsByTagName('input')[0].value;

            var discount=tbl.rows[i].cells[3].getElementsByTagName('input')[0].value;
            var amount=tbl.rows[i].cells[2].getElementsByTagName('input')[0].value;
            sub_total=(price*amount)-discount;
            total=total+sub_total;

        }

        document.getElementById('total').innerHTML = total;
        
    }


function insRow()
{ 

    var filas = document.getElementById("POITable").rows.length;
   
    
    var test=document.getElementById("main_item");
   
    var test=document.getElementById("tokens");
    
    var x = document.getElementById("POITable").insertRow(filas);
    //var y = x.insertCell(0);
    //var z = x.insertCell(1);
    //var k = x.insertCell(2);
    var a= x.insertCell(0);
    var b = x.insertCell(1);
    var c = x.insertCell(2);
    var d = x.insertCell(3);
    //var i= x.insertCell(4);
    var e = x.insertCell(4);
    var f = x.insertCell(5);
     
   
a.innerHTML='<select  name="tokens[]" id="item_name" class="form-control item_name" onchange="test(this)" data-live-search="true" required > <option value=""></option> @foreach ($items as $item)<?php if($item->color!=null){$item_variety = " (".$item->color.", ".$item->size.")";}else{$item_variety="";}?><option value="{{$item->id}}-{{$item->barcode_id}}" id="item" name="{{$item->id}}">{{$item->item_name}} {{$item_variety}}</option>@endforeach</select>';
    b.innerHTML = '<input class="input-sm small-cell"   type="text" id="lngbox"   name="unit_price[]" onchange="calculator(this);"/><input class=" webcampics input-sm small-cell" type="hidden" id="lngbox" name="unit_price_h[]" onchange="price_calculator(this);"/>';
    c.innerHTML = '<input class="webcampics input-sm small-cell" type="number" id="qty lngbox"  onchange="calculator(this);" pattern="^\d+$" name="qty[]" required/>';
    d.innerHTML = '<input type="text" class="webcampics input-sm small-cell" id="lngbox"  onchange="calculator(this);"  name="discount[]" value="0"/>';
   // i.innerHTML = '<input type="text" class="webcampics input-sm small-cell" id="lngbox"  onchange="calculator(this);"  name="items_barcode[]"/>';
   e.innerHTML = '<input type="text" class="input-sm small-cell" id="lngbox" disabled  name="sub_total[]"/><input type="hidden" class="webcampics input-sm small-cell" id="lngbox" size=4 name="sub_total_h[]"/>';
    f.innerHTML = '<button type="button" class="btn btn-danger input-sm" id="delPOIbutton" onclick="deleteRow(this)"><span class="fa fa-trash"></span> Del</button>';
  
                    // var x=document.getElementById('POITable');
                    // var tbody=x.getElementsByTagName('TBODY')[0];
                    // b=x.insertRow(-1)
                    // b=tbody.innerHTML
          /*                
                    var x=document.getElementById('POITable');
                    // deep clone the targeted row
                    var r=x.rows[1].cells[0].cloneNode(true)
                    // alert(r.innerHTML)
                    //var test=document.getElementsByTagName('select');
                    //alert(test)
                    var new_row = x.rows[1].cloneNode(true);
                    // print(type(new_row))
                    alert(new_row.cells[0].innerHTML)//.getElementsByTagName('select')[0].innerHTML)//='hitest'
                    
                    // r.innerHTML=test.innerHTML
                    //  // get the total number of rows
                    // //
                    // //alert(r)
                    // var len = x.rows.length;
                    // // set the innerHTML of the first row 
                    
                    
                    // alert(r.innerHTML)
                    // // grab the input from the first cell and update its ID and value
                    // var inp1 = new_row.cells[1]
                          
                    
                    // var inph = new_row.cells[0].getElementsByTagName('select')[1];
                    // //inph.id += len;
                    
                   
                    // // grab the input from the first cell and update its ID and value
                    // var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
                    

                    // var inp2 = new_row.cells[2].getElementsByTagName('input')[1];
                    

                    // var inp2 = new_row.cells[3].getElementsByTagName('input')[0];
                    // inp2.value = 1;

                    // var inp4 = new_row.cells[4].getElementsByTagName('input')[0];
                    // inp4.value = 0.00;

                    // var inp5 = new_row.cells[5].getElementsByTagName('input')[0];
                    

                    // var inp5 = new_row.cells[5].getElementsByTagName('input')[1];
                    
                  
                    // // append the new row to the table
                     x.appendChild( new_row );
                     */

}
function hope(){
    document.getElementById('tokens').className="selectpicker"
}

</script>


<form class="form-horizontal" action="{{route('create_normal_sale')}}" method="post">
@csrf

<div class="panel panel-default" onkeypress="return noenter()">
<div class="panel-heading" onkeypress="return noenter()">
<h3 class="panel-title">New Sale </h3>
</div>
<div class="panel-body">
<div class="block-content">


<br/>
<div class="row">


<div class="col-md-4">

    <div style="width:90%;">

    <label for="name">Customer</label>

    <select class="form-control" name="customer" id="customer" required>                                                

                                                 <option value=""></option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                                                @endforeach

    </select>

    </div>

    <br/>

    <div style="width:90%;">
    <label for="name">Date</label>

    <div class="input-group">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" class="form-control pull-right" id="datepicker">
                                            </div>

    </div>
 </div>

<div class="col-md-4 col-lg-4">

<div style="width:90%;">
    <label for="name">Payment</label>
    <select class="form-control" id="payment" name="payment" required> 
    <option value=""></option>                                                                                         
        <option value="Cash">Cash</option>
        <option value="Credit">Credit</option>                                          
    </select>
</div>

    <br/>

<div style="width:90%;">
    <label for="name">Remark</label>
    <input type="text" name="remark" class="form-control" >
</div>

</div>
      
</div>  
<div class="block" id="POItablediv">
    <table id="POITable" class="table table-bordered"  onclick="calculate()">
    <thead class="thead-inverse">
            <td>Item</td>
            <td>Price</td>
            <td>Qty</td>
            <td>Discount</td>
            <td>Sub totals</td>
            <td>Del</td>
        </thead>
        <tbody >
        <tr style="font-size:14;" >
        
        
        <td id="main_item">

<select id="item_name" name="tokens[]" class="form-control item_name" onchange="test(this)"  data-live-search="true" required >

<option value=""></option>

    @foreach ($items as $item)

    <?php 
                if($item->color!=null){
                    $item_variety = " (".$item->color.", ".$item->size.")";
                }else{
                    $item_variety="";
                }
    ?>

        <option value="{{$item->id}}-{{$item->barcode_id}}" id="item" name="{{$item->id}}">{{$item->item_name}} {{$item_variety}}</option>

    @endforeach
    </select><input class="webcampics input-sm small-cell" type="hidden" id="latbox" name="itemid[]" value="{{$item->id}}" /></td>
        <td ><input class="input-sm small-cell"   type="text" id="lngbox"   name="unit_price[]" onchange="calculator(this);" required/>            
             <input class=" webcampics input-sm small-cell" type="hidden" id="lngbox" name="unit_price_h[]" onchange="price_calculator(this);"/></td>
        <td id='qty_td'><input class="webcampics input-sm small-cell" type="number" id="qty lngbox"  onchange="calculator(this);" pattern='^\d+$' name="qty[]" required/></td>
        <td ><input type="text" class="webcampics input-sm small-cell" id="lngbox"  onchange="calculator(this);"  name="discount[]" value="0"/></td>
       <td ><input type="text" class="input-sm small-cell" id="lngbox" disabled  name="sub_total[]"/>
            <input type="hidden" class="webcampics input-sm small-cell" id="lngbox" size=4 name="sub_total_h[]"/></td>
        <td><button type="button" class="btn btn-danger input-sm" id="delPOIbutton" onclick="deleteRow(this)"><span class='fa fa-trash'></span> Del</button></td>



    </tr>

</tbody>
</table>


</body>
<div align="right">
<button type="button" class="btn btn-success" onclick="insRow()">Add Item</button>

</div>



<script>


    
//////merhawi

    function  calculate_table() {
        var total=0;
        var sub_total=0;
        alert('in');
        var tbl=document.getElementById('POITable');


        for(var i=1;i<tbl.rows.length;i++){

            tbl.rows[i].cells[6].getElementsByTagName('input')[0].value=sub_total;
            tbl.rows[i].cells[6].getElementsByTagName('input')[1].value=sub_total;

        }

        document.getElementById('total').innerHTML = total;
//        console.log(total);
    }


    function  calculate_table_total() {
        var total=0;
        var sub_total=0;
		//alert('in total');
        
        var tbl=document.getElementById('POITable');

        for(var i=1;i<tbl.rows.length;i++){
            var price=tbl.rows[i].cells[1].getElementsByTagName('input')[0].value;

            var discount=tbl.rows[i].cells[2].getElementsByTagName('input')[0].value;
            var amount=tbl.rows[i].cells[3].getElementsByTagName('input')[0].value;

            sub_total=(price*amount)-discount;
        

            total=total+sub_total;

        }

        document.getElementById('total').innerHTML = total;
//        console.log(total);
    }


function clear(){
        var tableID ="POITable";
        var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            for (var i = 3; i < rowCount; i++) {
                table.deleteRow(i);
                    rowCount--;
                    i--;
                    clearchecker=false;
     }

    table.rows[2].cells[1].getElementsByTagName('input')[0].value=null;
    table.rows[2].cells[1].getElementsByTagName('input')[1].value=null;
     table.rows[2].cells[2].getElementsByTagName('input')[0].value=null;
     table.rows[2].cells[3].getElementsByTagName('input')[0].value=null;
     table.rows[2].cells[4].getElementsByTagName('input')[0].value=null;
     table.rows[2].cells[5].getElementsByTagName('input')[0].value=0;
     checker=true;

        document.getElementById('total').innerHTML = "0.00";

    }
</script>
<div style="float:right;">


<table class="table bordered">
<tr>
        <td><b><u><span style="font-size:18px; float:left;">Total: </span></b></td>
        <td></td>
        <td></td>

        <td> </td>
        <td> </td>
        <td  style="font-size:18px;" id="total">0.00</u></td>
</tr>

</table>
<button class="btn btn-success btn-submit">Finish Sale </button>
</div>

</form>

</div>

</div>
</div>

</div>

</div>


<script type="text/javascript" src="{{ asset('js/jqueryselect.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrapselect.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-select.js')}}"></script>


<script type="text/javascript">   
var date2;

    $(".btn-submit").click(function(e){

        var date1=document.getElementById('date').value;
        date2=document.getElementById('date').value;
		//alert(date1)
		if (date1=="") {
			
			//break;
			
		}
		
		else{
			
        // Get customer id
        var customer = document.getElementById('customer');
        customer_id = customer.value;
        //alert( customer.value );
        

        // Get customer id
        var payment = document.getElementById('payment');
        payment_id = payment.value;
        console.log( payment.value );
        

        // Get customer id
        var date_sale_id = document.getElementById('date');
        date_sale = date_sale_id.value;
        console.log( date_sale );
        //alert ('in')

       // alert(item_barcode_id);

  //
       
		}
        printDivSection(sale_id);
	});
	
//WebSocket settings


//Do printing...

function printDivSection(sale_id) 
{  var total=0;
var d=''


           var Contents_Section=document.getElementById('POITable');
           var newtbl=document.createElement('p');
		    d='<center><u><span style="font-size:17pt;">Kingdom<br> Super Market</span></u></center><center><br>Sale Id:'+sale_id+'<span style="font-size:11pt;">Tel No: 113854</span><span style="float:right;">'+date2+'</span></center>'
		    d+='<div style="margin-top:-30px"><table ><span style="font-size:14pt;"> <th>Item&nbsp;&nbsp;&nbsp;</th><th></th><th></th><th>&nbsp;price</th><th></th><th></th><th>&nbsp;&nbsp;Qty</th><th></th><th> &nbsp;&nbsp;&nbsp;Subtotal</th></span>'
		    for (var i=2;i<Contents_Section.rows.length;i++){
			var name=Contents_Section.rows[i].cells[1].getElementsByTagName('input')[0].value;
			var price=Contents_Section.rows[i].cells[2].getElementsByTagName('input')[0].value;
            var discount=Contents_Section.rows[i].cells[4].getElementsByTagName('input')[0].value;
            var amount=Contents_Section.rows[i].cells[3].getElementsByTagName('input')[0].value;

            sub_total=(price*amount)-discount;
			total=total+sub_total;
	        d+='<span style="font-size:8pt;"><tr><td>'+name+'&nbsp;&nbsp;&nbsp;</td><td></td><td></td>'+'<td>&nbsp;&nbsp;'+price+'</td><td></td><td> </td>'+'<td>&nbsp;&nbsp;'+'x'+amount+'</td><td></td></td>'+'<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+sub_total+'</td><tr></span>'
	 
	 
	 
	 }
	 d+='<b><span style="font-size:16pt;"><tr><td>Total</td><td></td><td></td><td></td><td></td><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;<u><b>'+total+'</b></u></td><tr></span></b><br>'
	 d+='<tr><span style="font-size:14pt;text-alignalign:right"><td >&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;Thankyou</td> </tr><tr><td colspan=4>&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbspComeAgain!!!</td><tr></span>'
	 
	 
	 d+='</table></div>'
	 
	newtbl.innerHTML=d
	 
     //var originalContents = document.innerHTML;
    var originalContents=document.getElementById('main_html').innerHTML;

     var printContents = newtbl.innerHTML;
     w=window.open()
     w.document.write(printContents);
     w.print()
     w.close()

     //window.print();

     //document.body.innerHTML = originalContents;

     return true;
}


</script>
<script>
function createOptions(number) {
  var options = [], _options;

  for (var i = 0; i < number; i++) {
    var option = '<option value="' + i + '">Option ' + i + '</option>';
    options.push(option);
  }

  _options = options.join('');
  
  $('#number')[0].innerHTML = _options;
  $('#number-multiple')[0].innerHTML = _options;


  $('#number2')[0].innerHTML = _options;
  $('#number2-multiple')[0].innerHTML = _options;
}

var mySelect = $('#first-disabled2');

createOptions(4000);

$('#special').on('click', function () {
  mySelect.find('option:selected').prop('disabled', true);
  mySelect.selectpicker('refresh');
});

$('#special2').on('click', function () {
  mySelect.find('option:disabled').prop('disabled', false);
  mySelect.selectpicker('refresh');
});

$('#basic2').selectpicker({
  liveSearch: true,
  maxOptions: 1
});
</script>



<script type="text/javascript">
function test(id){
    var row=id.parentNode.parentNode.rowIndex
    var tbl=document.getElementById('POITable')
    
    //alert('kdsjflsdfls');
//$value=$(this).val();
var item_id = id.value;

console.log(item_id);

$.ajax({
//    console.log(customer_id);

type : 'get',
//url : '{{URL::to('new_receiptSales2')}}',
url:"{{route('item_info')}}",

data:{'item_id':item_id},
success:function(data){
var val=data.data.pop().unit_price;
console.log(data);
tbl.rows[row].cells[1].getElementsByTagName('input')[0].value=val;
calculate_table_total()



//document.getElementById("table-data").innerHTML=xmlhttp.responseText;
//alert(data.data);
//console.log(customer_id);

}
});
}
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection()

