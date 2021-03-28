

<div class="container">

    <div class="col-md-6 col-sm-6">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">New Transfer</h3>
            </div>
            <div class="panel-body">
                <div class="block-content">
                    <div class="block">



                    <form class="form-horizontal" name="transfer_form" id="purhase_form" action="{{route('new_transfer')}}" method="post">
                   @csrf
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Supplier :</label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="customers" name="customer">
                                                
                                                @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}" name="{{$customer->id}}">{{$customer->customer_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <select class="form-control" id="source" name="source">
                                                
                                                @foreach ($locations as $location)
                                                    <option value="{{$location->id}}" name="{{$location->id}}">{{$location->location_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>


                                        <div class="col-md-4">
                                            <select class="form-control" id="destination" name="destination">
                                                
                                                @foreach ($locations as $location)
                                                    <option value="{{$location->id}}" name="{{$location->id}}">{{$location->location_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>
                                    
                                    <div class="form-group">
                                            <label class="col-md-2 control-label">Date :</label>
                                            <div class="col-md-4">
                                                    <div class="input-group bs-datepicker">
                                                            <input type="text" class="form-control" id="iv_date" name="iv_date">
                                                            <span class="input-group-addon">
                                                                <span class="icon-calendar-full"></span>
                                                            </span>
                                                        </div>
                                            </div>
                                    </div>  
                             
                             <div class="form-group">
                                    <label class="col-md-2 control-label">Ref No :</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="ref" id="ref" required>
                                    </div>
                            </div>   
                                               
       </div>                        
                                      
                                    {{-- put here --}}
                                    <div align="right">
                                        <button type="button" class="btn btn-success" onclick="insRow('POITable')">Add Item</button>
                                        


                                    </div>
</div>
</div>                     <div>
                                    <table class="table" id="POITable" onclick="calculate()">
                                            <thead class="thead-inverse">
                                              <tr>
                                                <th>#</th>
                                                <th>Items</th>
                                                <th>Qauntity</th>
                                                <th>Barcode</th>
                                                <th>Tax</th>
                                                <th>Sub Total</th>
                                                <th>options</th>
                                              </tr>
                                            </thead>
                                 
                                       
                                        <TR>
                                           
                                            <td> 1</td>

                                             <TD id="main_item">
                                                                                                
                                                                                                <select class="form-control" name="item[]" id="lngbox">
                                                                                                        @foreach ($items as $item)
                                                                                                            <option value="{{$item->id}}" name="item_name[]">{{$item->item_name}}</option>
                                                                                                        @endforeach
                                                                                                </select>
                                                                                                 
                                                                                            </TD>

                                            <TD><INPUT type="text" class="form-control" name ="amount[]" id="qty" id="lngbox" placeholder="Quantity" onchange='calculate();'/></TD>
                                            <TD><INPUT type="text" class="form-control" name="unit_price[]" id="lngbox" id="barcode" placeholder="Barcode" onchange='calculate();'/></TD>
                                            <TD><INPUT type="text" class="form-control" name="tax[]" id="lngbox"  placeholder="Tax" onchange='calculate();'/></TD>
                                            <TD><INPUT type="text" name="sub_total[]" id="lngbox" class="form-control" disabled />
                                            <INPUT name="sub_total_h[]" type="hidden" id="lngbox" /></TD>
                                            <td><button type="button" class="btn btn-danger input-sm" id="delPOIbutton" onclick="deleteRow(this)"><span class='fa fa-trash'></span> Del</button></td>

                                        </TR>
                                       
                                    
                                    
                                    </table>
                                    </div>
                                    
                                    <table class="table" id="table_summary">
                                            <thead class="thead-inverse">
                                              <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>Total</th>
                                                
                                              </tr>
                                            </thead>
                                    <tbody> 
                                    <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td id="sum_sub_total">0</td>
                                            
                                    </tr>
                                    </tbody> 

                                    </table>
                                </form>  
                                
                            </div>
                            <button type="submit" class="btn btn-info" >SAVE</button>
                        </div>
                     </div>
                            
                    </div>

               </div>

<script language='javascript'>


function insRow(id){
    
    
    var filas = document.getElementById("POITable").rows.length;
    var n = document.getElementById("main_item").innerHTML;
    
    var x = document.getElementById(id).insertRow(filas);
    
    var i=  x.insertCell(0);
   // alert(filas);
    var a = x.insertCell(1);
   
    var b = x.insertCell(2);
    var c = x.insertCell(3);
    var d = x.insertCell(4);
    var e = x.insertCell(5);
    var z = x.insertCell(6);
   
i.innerHTML=filas;
a.innerHTML = ' <select class="form-control" name="item[]" id="lngbox">@foreach ($items as $item)<option value="{{$item->id}}" name="item_name[]">{{$item->item_name}}</option>@endforeach</select>';
b.innerHTML = '<INPUT type="text" class="form-control" name ="amount[]" id="qty" id="lngbox" placeholder="Quantity" onchange="calculate();"/>';
c.innerHTML = '<INPUT type="text" class="form-control" name="barcode[]" id="lngbox" id="barcode" placeholder="Barcode" onchange="calculate();"/>';
d.innerHTML = '<INPUT type="text" class="form-control" name="tax[]" id="lngbox"  placeholder="Tax" onchange="calculate();"/>';
e.innerHTML = '<INPUT type="text" name="sub_total[]" id="lngbox" class="form-control" disabled /><INPUT name="sub_total_h[]" type="hidden" id="lngbox" />';

//y.innerHTML = '<input type="text" id="fname" name="barcode[]" onkeypress="return noenter()">';
z.innerHTML ='<button type="button" class="btn btn-danger input-sm" id="delPOIbutton" onclick="deleteRow(this)"><span class="fa fa-trash"></span> Del</button></td>';
//k.innerHTML = n;
    
}


function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(i);
}


// A function to calucluate column values and set the values 


function calculate(){
    //alert("hello");

                var table = document.getElementById('POITable');
                var rowCount = table.rows.length;
               // var colCount = table.rows[0].cells.length;

    for(var i=1; i<=rowCount; i++) {
      //alert("wks;ldf");                  
                            var qty = (table.rows[i].cells[2].getElementsByTagName('input')[0].value);
//                            alert("sjdklf: "+qty);
                            //table.rows[i].cells[3].getElementsByTagName('input')[0].value = qty ;
                            var unit_price = table.rows[i].cells[3].getElementsByTagName('input')[0].value;
                            var tax = table.rows[i].cells[4].getElementsByTagName('input')[0].value;
                            
                            if (tax==""){
                                table.rows[i].cells[4].getElementsByTagName('input')[0].value = 0.00;
                                tax=0.00;
                            }                            
                            table.rows[i].cells[5].getElementsByTagName('input')[0].value = ((qty*unit_price)+Number(tax));
//                            table.rows[i].cells[5].getElementsByTagName('input')[1].value = qty*unit_prices;
find_sum();
                       }

}

function find_sum()
{
    

    var table = document.getElementById('POITable');
    //alert("hello merhaw");
                var rowCount = table.rows.length;
                
                //var colCount = table.rows[0].cells.length;
                //alert(rowCount)
    var total_sum =0.00;

    for(var i=1; i<rowCount; i++) {
       
      //alert("wks;ldf");                  
                            var qty = (table.rows[i].cells[2].getElementsByTagName('input')[0].value);
//                            alert("sjdklf: "+qty);
                            //table.rows[i].cells[3].getElementsByTagName('input')[0].value = qty ;
                            var unit_price = table.rows[i].cells[3].getElementsByTagName('input')[0].value;
                            var tax = table.rows[i].cells[4].getElementsByTagName('input')[0].value;
                            
                            if (tax==""){
                                table.rows[i].cells[4].getElementsByTagName('input')[0].value = 0.00;
                                tax=0.00;
                            }                            
                            table.rows[i].cells[5].getElementsByTagName('input')[0].value = ((qty*unit_price)+Number(tax));
                            var sub_total = ((qty*unit_price)+Number(tax));
//                            table.rows[i].cells[5].getElementsByTagName('input')[1].value = qty*unit_prices;
total_sum=total_sum+sub_total;

                       }
                       document.getElementById('sum_sub_total').innerHTML = total_sum;

}


</script>

