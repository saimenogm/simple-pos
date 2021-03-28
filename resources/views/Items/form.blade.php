@extends('layouts.app')

@section('content')

    <meta name="_token" content="{{ csrf_token() }}">

    <div class="col-md-10 col-lg-10">


        <div class="panel panel-primary" onkeypress="return noenter()">
            <div class="panel-heading" onkeypress="return noenter()">
                <h3 class="panel-title">New Item </h3>
            </div>
            <div class="panel-body">
                <div class="block-content" onkeypress="return noenter()">

                    <div class="block">
                        <div class="row">

                            <form action="{{route ('create_item')}}" method="post" name="item_form"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6 col-lg-6">


                                    <table class="table">
                                        <tr>
                                            <td>
                                                <label>Item Name</label></td>
                                            <td>
                                                <input name="item_name" type="text" value="" class="form-control"
                                                       required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label>Item Code</label></td>
                                            <td>
                                                <input name="item_code" type="text" value="" class="form-control"
                                                       required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label>Barcode Method</label></td>
                                            <td>
                                                <select class="form-control" id="barcode_type" name="barcode_generation"
                                                        onchange='barcode_enabler()' required>
                                                    <option value=""></option>
                                                    <option value="Generate Company Barcode">Generate Company Barcode
                                                    </option>
                                                    <option value="No Barcode">No Barcode</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label>Category</label></td>
                                            <td>


                                                <select class="form-control" id="customers" name="category" required>
                                                    <option value=""></option>
                                                    @foreach ($itemsCategorys as $itemsCategory)
                                                        <option value="{{$itemsCategory->id}}">{{$itemsCategory->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label>Image</label></td>
                                            <td>
                                                <input type="file" class="form-control" name="bookcover"/>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label>Remark</label></td>
                                            <td>
                                                <input name="remark" type="text" value="" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Description</label></td>
                                            <td>
                                                <input name="description" type="text" value="" class="form-control">
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <label>Variants Available</label></td>
                                            <td>
                                                <input id='variant' name="variant" type="checkbox" onchange='checker()'
                                                       value="true">
                                            </td>
                                        </tr>

                                    </table>


                                    <button type='Submit' role='button' class='btn btn-info'><i
                                                class='fa fa-fw fa-save'></i> Save & New
                                    </button>
                                    <!-- <form method='' action=''>
                                    <button type='Submit' role='button' class='btn btn-info'> <i class='fa fa-fw fa-save'></i> Save and Add New </button>
                                    </form> -->

                                </div>

                                <div class="col-md-6 col-lg-6">

                                    <table class="table">
                                        <tr>
                                            <td>
                                                <label>Unit Cost</label></td>
                                            <td>
                                                <input id='unit_cost' name="unit_cost" pattern="[0-9]+[.]+\d+"
                                                       type="text" value="" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Unit Price</label></td>
                                            <td>
                                                <input id='unit_price' name="unit_price" pattern="[0-9]+[.]+\d+"
                                                       type="text" value="" class="form-control" required>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <label>Min Qty</label></td>
                                            <td>
                                                <input id="min_qty" name="min_qty" type="text" value=""
                                                       class="form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label>Qty at Shop</label></td>
                                            <td>
                                                <input id='qty_at_shop' name="qty_at_shop" type="text" value=""
                                                       class="form-control">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label>Qty at Store</label></td>
                                            <td>
                                                <input id='qty_at_store' name="qty_at_store" type="text" value=""
                                                       class="form-control">
                                            </td>
                                        </tr>
                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<label>Company</label></td>--}}
                                            {{--<td>--}}
                                                {{--<select class="form-control" id="company" name="company">--}}
                                                    {{--<option value=""></option>--}}
                                                    {{--@foreach ($companys as $company)--}}
                                                        {{--<option value="{{$company->id}}">{{$company->company_name}}</option>--}}
                                                    {{--@endforeach--}}
                                                {{--</select>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}


                                    </table>

                                </div>

                                <ul id="myTab" hidden=true class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Varieties and Barcode</a></li>
                                </ul>

                                <div id="myTabContent" hidden=true class="tab-content">

                                    <div class="tab-pane fade in active" id="home">

                                        <table id="myTable1" name="test[]" class="tab-content"
                                               onkeypress="return noenter();">
                                            <thead class="thead-inverse">
                                            <tr>
                                               <th>Dosage</th>
                                                <th>Unit Cost</th>
                                                <th>Unit Price</th>
                                                <th>Qty at Shop</th>
                                                <th>Qty at Store</th>
                                                <th>Min Qty</th>
                                                <th><span class='fa fa-trash'></span> Delete</th>
                                            </tr>
                                            </thead>
                                            <tr id="clone_row">

                                                <TD>
                                                    <INPUT type="text" class="form-control" name="variant_name[]"
                                                           id="variant_name" onchange="calculator(this);"
                                                           placeholder="Variant" required/>
                                                </TD>

                                                <TD><INPUT type="text" class="form-control" name="unit_cost_variant[]"
                                                           id="unit_cost_variant" placeholder="Cost"/></TD>
                                                <TD><INPUT type="text" class="form-control" name="unit_price_variant[]"
                                                           id="unit_price_variant" placeholder="price"/></TD>
                                                <TD><INPUT type="text" class="form-control" name="qty_at_shop_variant[]"
                                                           id="qty_at_shop_variant" onchange="calculator(this);"
                                                           placeholder="Quantity"/></TD>
                                                <TD><INPUT type="text" class="form-control "
                                                           name="qty_at_store_variant[]" id="qty_at_store_variant"
                                                           onchange="calculator(this);" placeholder="Unit Cost"/></TD>
                                                <TD><INPUT type="text" class="form-control" name="min_qty_variant[]"
                                                           id="min_qty_variant" placeholder="Min Qty"/></TD>


                                                <td><input type="button" value="DeleteF" class="btn btn-danger"
                                                           onclick="deleteRow(this);"></td>
                                                <div style="float:right"><input type="button"
                                                                                onclick="insRow('myTable1')"
                                                                                class="btn btn-success btn-sm"
                                                                                value="Add Item"></div>

                                            </tr>
                                        </table>

                                    </div>
                                </div>
                                <div>
                                </div>


                        </div>

                    </div>

                    </form>
                    <script>

                        $(document).ready(function () {
                            $(window).keydown(function (event) {
                                if (event.keyCode == 13) {
                                    event.preventDefault();
                                    return false;
                                }
                            });
                        });

                        function calculate(pos) {

                            var total = 0
                            var row = pos.parentNode.parentNode;

                            var tbl = document.getElementById('myTable')
                            var j

                            for (var i = 1; i < tbl.rows.length; i++) {

                                j = Number(tbl.rows[i].cells[2].getElementsByTagName('input')[0].value)

                                total = total + j;
                            }

                            document.getElementById('min_qty').value = total;


                        }

                        function barcode_enabler() {

                            var bar = document.getElementById('barcode_type').value;
                            if (bar == 'No Barcode' || bar == 'Generate Company Barcode') {

                                var barcode0 = document.getElementById('barcode_id0').disabled = true;
                                var barcode1 = document.getElementById('barcode_id1').disabled = true;
                                var barcode1 = document.getElementById('store1').disabled = true;
                                var barcode1 = document.getElementById('shop1').disabled = true;


                            }
                            else {


                                var barcode0 = document.getElementById('barcode_id0').disabled = false;
                                var barcode1 = document.getElementById('barcode_id1').disabled = false;
                                var barcode1 = document.getElementById('store1').disabled = false;
                                var barcode1 = document.getElementById('shop1').disabled = false;
                            }


                        }

                        function deleteRow(row) {

                            var table = document.getElementById('myTable1')
                            // alert(table.rows.length)
                            if (table.rows.length == 2) {
                                row.diaabled = true

                            }
                            else {
                                var i = row.parentNode.parentNode.rowIndex;
                                table.deleteRow(i);

                            }
// remove from check
                            // for(var j=0;j<=table.rows.length;j++){
                            //     if(check[j]==id){
                            //         check.splice ( j, 1 );
                            //     }
                            // }
                        }

                        function noenter() {
                            return !(window.event && window.event.keyCode == 13);
                        }


                        jQuery(document).ready(function () {
                            jQuery('#ajaxSubmit').click(function (e) {
                                e.preventDefault();
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    }
                                });
                                alert('wowow');
                                $value = 'heljsdkfj';
                                jQuery.ajax({
                                    url: '{{URL::to('item_ajax')}}',
                                    type: 'get',
                                    data: {
                                        name: $value,
                                    },
                                    success: function (result) {
                                        console.log(result);
                                        alert('lsjdfklsdjfls');
                                    }
                                });
                            });
                        });

                        // if (check.checked == true){
                        //     document.getElementById('myTab').hidden=false
                        //     document.getElementById('myTabContent').hidden=false

                        // }
                        // else {
                        //     document.getElemen tById('myTab').hidden=true
                        //     document.getElementById('myTabContent').hidden=true
                        // }
                        function checker() {
                            var check = document.getElementById('variant')
                            if (check.checked == true) {
                                document.getElementById('myTab').hidden = false
                                document.getElementById('myTabContent').hidden = false
                                document.getElementById('qty_at_shop').disabled = true
                                document.getElementById('qty_at_store').disabled = true
                                document.getElementById('min_qty').disabled = true
                                document.getElementById('unit_cost').disabled = true
                                document.getElementById('unit_price').disabled = true

                            }
                            else {

                                document.getElementById('min_qty_variant').required = false
                                document.getElementById('myTab').hidden = true
                                document.getElementById('myTabContent').hidden = true
                                document.getElementById('unit_price').disabled = false
                                document.getElementById('unit_cost').disabled = false
                                document.getElementById('min_qty').disabled = false
                                document.getElementById('qty_at_shop').disabled = false
                                document.getElementById('qty_at_store').disabled = false
                            }
                        }

                    </script>

                    <script>


                        function insRow(id) {
                            var filas = document.getElementById(id).rows.length;
                            //alert(filas)

                            //var n = document.getElementById("color_col").innerHTML;
                            var m = document.getElementById("size_col").innerHTML;
                            var aa = '<select class="form-control"><option></option><option value="Box">Box</option><option value="Strip">Strip</option><option value="Bottle">Bottle</option><option value="PCs">PCs</option></select>';


                            var x = document.getElementById(id).insertRow(filas);
                            //var y = x.insertCell(0);
                            //var z = x.insertCell(1);
                            //var k = x.insertCell(2);
                            //var a = x.insertCell(0);
                            var b = x.insertCell(0);
                            // var c = x.insertCell(1);
                            // var bb = x.insertCell(2);
                            var d = x.insertCell(1);
                            var e = x.insertCell(2);
                            var f = x.insertCell(3);
                            var g = x.insertCell(4);
                            var h = x.insertCell(5);


                            //a.innerHTML = n;
                            b.innerHTML = '<INPUT type="text" class="form-control" name="variant_name[]" />';
                            // c.innerHTML = m;
                            // bb.innerHTML= aa;
                            d.innerHTML = '<INPUT type="text" class="form-control" name="unit_cost_variant[]"  placeholder="Cost" required />';
                            e.innerHTML = '<INPUT type="text" class="form-control" name="unit_price_variant[]"   placeholder="price" required />';
                            f.innerHTML = '<INPUT type="text" class="form-control" name="qty_at_shop_variant[]"  onchange="calculator(this);"  placeholder="Quantity"  required/>';
                            g.innerHTML = '<INPUT type="text" class="form-control" name="qty_at_store_variant[]"   onchange="calculator(this);"  placeholder="Unit Cost" required />';
                            h.innerHTML = '<INPUT type="text" class="form-control" name="min_qty_variant[]" placeholder="Min Qty"  required />';

                            //y.innerHTML = '<input type="text" id="fname" name="barcode[]" onkeypress="return noenter()">';
                            z.innerHTML = '<input type="button" value="Delete" class="btn btn-danger" onclick="deleteRow(this);">';
                            //k.innerHTML = n;

                        }

                    </script>
@endsection
