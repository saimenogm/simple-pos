@extends('layouts.app')

@section('content')

<div class="container" style="margin-left: -0px;">


        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">New Transfer</h3>
            </div>
            <div class="panel-body">
                <div class="block-content">
                    <div class="block">


                    <script>

 if({{$checker}}){

     alert('Current Quantity at source is less then the Transfere amount')
 }

function insRow(id){
    
    
    var filas = document.getElementById("POITable").rows.length;
    var n = document.getElementById("main_item").innerHTML;
    
    var x = document.getElementById(id).insertRow(filas);
    
    
    var a = x.insertCell(0);
   
    var b = x.insertCell(1);
    //var c = x.insertCell(2);
    var z = x.insertCell(2);
   
a.innerHTML = n;
b.innerHTML = '<INPUT type="text" class="form-control" name ="amount[]" id="qty" id="lngbox" placeholder="Quantity" onchange="calculate();"/>';
//c.innerHTML = '<select onchange="calculate();" class="form-control" name="package[]" id="lngbox" required> <option value=""></option> @foreach ($packages as $package)<option value="{{$package->id}}">{{$package->package_name}}</option> @endforeach </select>';

//y.innerHTML = '<input type="text" id="fname" name="barcode[]" onkeypress="return noenter()">';
z.innerHTML ='<button type="button" class="btn btn-danger input-sm" id="delPOIbutton" onclick="deleteRow(this)"><span class="fa fa-trash"></span> Del</button></td>';
//k.innerHTML = n;
    
}


function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(i);
}


</script>
<form class="form-horizontal" name="transfer_form" id="purhase_form" action="{{route('new_transfer')}}" method="post">
                   @csrf
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">From :</label>

                                        <div class="col-md-3">
                                            <select required class="form-control" id="source" name="source">
                                                <option value=""></option>
                                                <option value="1">Shop</option>
                                                <option value="2">Store</option>
                                            </select>
                                        </div>

                                        <label class="col-md-2 control-label">To :</label>

                                        <div class="col-md-3">
                                            <select class="form-control" id="destination" name="destination">
                                                <option value=""></option>
                                                <option value="1">Shop</option>
                                                <option value="2">Store</option>
                                            </select>
                                        </div>

                                    </div>
                                    
                                    <div class="form-group">
                                            <label class="col-md-2 control-label">Date :</label>
                                            <div class="col-md-3">
                                                    <div class="input-group bs-datepicker">
                                                            <input type="date" class="form-control" id="date" name="date">
                                                            <span class="input-group-addon">
                                                                <span class="icon-calendar-full"></span>
                                                            </span>
                                                        </div>
                                            </div>

                                        <label class="col-md-2 control-label">Ref No :</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="ref" id="ref">
                                        </div>

                                    </div>  
                             
                             <div class="form-group">
                            </div>
                                               
                         <div>
                                    <table class="table" id="POITable" onclick="calculate()">
                                            <thead class="thead-inverse">
                                              <tr>
                                                
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                {{--<th>Package Name</th>--}}
                                                <th>Del</th>
                                              </tr>
                                            </thead>
                                 
                                        {{-- do not touch this first <tr> element is it just a template  --}}
                                        <TR>
                                            {{-- <TD><INPUT type="checkbox" name="chk"  id="latbox"/></TD> --}}
                                           
                                             <TD id="main_item">
                                                                                                
                                                                                                <select name="item[]" id="lngbox" class="form-control" >

                                                                                                <option value=""></option>

@foreach ($items as $item)
<?php 
if($item->variant_name!=null){
    $item_variety = " (".$item->variant_name.")";
}else{
    $item_variety="";
}
?>
    <option value="{{$item->id}}-{{$item->barcode_id}}" name="{{$item->id}}">{{$item->item_name}} {{$item_variety}}</option>
@endforeach

</select>
                                                                                            </TD>

                                            <TD><INPUT type="text" class="form-control" name ="amount[]" id="qty" id="lngbox" placeholder="Quantity" /></TD>
{{--<TD>--}}

            {{--<select class="form-control" name="package[]" id="lngbox" required>--}}
            {{--<option value="" name=""></option>--}}
            {{--<option value=""></option>--}}

                {{--@foreach ($packages as $package)--}}
                    {{--<option value="{{$package->id}}">{{$package->package_name}}</option>--}}
                {{--@endforeach--}}

            {{--</select>--}}
{{--</TD>--}}

                                            <td><button type="button" class="btn btn-danger input-sm" id="delPOIbutton" onclick="deleteRow(this)"><span class='fa fa-trash'></span> Del</button></td>

                                        </TR>
                                       
                                    
                                    
                                    </table>
                                    </div>
									<div align="right">
                                        <button type="button" class="btn-sm btn-success" onclick="insRow('POITable')">Add Item</button>
                                        


                                    </div>
                                    
                                    <table class="table" id="table_summary">
                                            <thead class="thead-inverse">
                                              <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                
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
                                            <td ></td>
                                            
                                    </tr>
                                    </tbody> 

                                    </table>
                                
                            </div>
                            <div align="right">

                            <button type="submit" class="btn btn-primary" >Save</button>
                        </div>
                     </div>
                     </form>  
                            
                    </div>

               </div>
@endsection