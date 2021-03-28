@extends('layouts.app')

@section('content')

    <style>

        .items {
            background-color: #ccc;
        }

        .item {
            background-color: white;
            display: inline;
            float: left;
            margin: 6px;
            padding: 2px;
        }

        .item-image {
            display: block;
            margin-left: 6%;
        }

        .item-footer {
            display: block;
            margin-top: 0px;
            padding: 0px;
            text-align: center;
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

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        /* Modal Content/Box */
        .modal-content {
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
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes animatezoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }


    </style>

    <meta name="_token" content="{{ csrf_token() }}">

    <script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>
    <script>
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
    </script>

    <script>

        $(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        function converter(i, p) {
            alert('in')
            if (i == '1') {
                p.setAttribute('value', 'shop')

            }
            else {
                p.setAttribute('value', 'store')
            }

        }

        function calculate(pos) {


            var total = 0
            var row = pos.parentNode.parentNode;

            var tbl = document.getElementById('barcode_list')
            var j
            for (var i = 1; i < tbl.rows.length; i++) {

                j = Number(tbl.rows[i].cells[2].getElementsByTagName('input')[0].value)

                total = total + j;
            }

            document.getElementById('min_qty').value = total;


        }

        function noenter() {

            return !(window.event && window.event.keyCode == 13);
        }


        {{--jQuery(document).ready(function () {--}}
            {{--jQuery('#ajaxSubmit').click(function (e) {--}}
                {{--e.preventDefault();--}}
{{--//               alert('hlksdjfklsd');--}}
                {{--$.ajaxSetup({--}}
                    {{--headers: {--}}
                        {{--'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
                    {{--}--}}
                {{--});--}}
                {{--alert('wowow');--}}
                {{--$value = 'heljsdkfj';--}}
                {{--jQuery.ajax({--}}
                    {{--url: '{{URL::to('item_ajax')}}',--}}
                    {{--type: 'get',--}}
                    {{--data: {--}}
                        {{--name: $value,--}}
                    {{--},--}}
                    {{--success: function (result) {--}}
                        {{--console.log(result);--}}
                        {{--alert('lsjdfklsdjfls');--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
        {{--});--}}
    </script>

    <form role='form'
          action="{{ $modify == 1 ? route('update_item', [ 'drug_id' => $drug_id ]) : route('create_client') }}"
          method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-11 col-lg-11">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Item Details</h3>
                    </div>
                    <div class="panel-body">
                        <div class="block-content">
                            <div class="block">


                                <div class="row">
                                    <div class="col-md-8 col-lg-6">

                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <label>Item Name</label></td>
                                                <td>
                                                    <input name="item_name" type="text" class="form-control"
                                                           value="{{ old('drug_name') ? old('drug_name') : $drug_name }}">
                                                    <small class="error">{{$errors->first('drug_name')}}</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Item Code</label></td>
                                                <td>
                                                    <input name="item_code" type="text"
                                                           value="{{ old('item_code') ? old('item_code') : $item_code }}"
                                                           class="form-control">
                                                    <small class="error">{{$errors->first('item_code')}}</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Min Qty</label></td>
                                                <td>
                                                    <input id="min_qty" name="min_qty" type="text"
                                                           value="{{ old('min_qty') ? old('min_qty') : $min_qty }}"
                                                           class="form-control">
                                                    <small class="error">{{$errors->first('min_qty')}}</small>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <label>Barcode Method</label></td>
                                                <td>
                                                    <select class="form-control" id="customers"
                                                            name="barcode_generation" required>
                                                        <option value="{{ old('barcode_generation') ? old('barcode_generation') : $barcode_generation }}">{{ old('barcode_generation') ? old('barcode_generation') : $barcode_generation }}</option>
                                                        <option value="Has Its own Barcode">Has Its own Barcode</option>
                                                        <option value="Generate Company Barcode">Generate Company
                                                            Barcode
                                                        </option>
                                                        <option value="No Barcode">No Barcode</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Category</label></td>
                                                <td>
                                                    <select class="form-control" id="customers" name="category"
                                                            required>

                                                        @foreach ($drugCategorys as $itemsCategory)
                                                            <?php
                                                            if($itemsCategory->id == $category){
                                                            ?>
                                                            <option value="{{$itemsCategory->id}}" name="category_name"
                                                                    selected=true>{{$itemsCategory->category_name}}</option>

                                                            <?php
                                                            }else
                                                            {
                                                            ?>
                                                            <option value="{{$itemsCategory->id}}"
                                                                    name="category_name">{{$itemsCategory->category_name}}</option>

                                                    <?php
                                                    }

                                                    ?>
                                                    @endforeach


                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
<B> Has Variants </B> &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="checkbox"
                                                                   @if($variant=='true')
                                                                   checked
                                                                   @elseif($variant==='false')
                                                                   checked
                                                                   @endif
                                                                   name="has_variants" value="1">
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <input id='variant' type="hidden" name="variants" value="true">

                                        </table>


                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <table class="table">

                                            <tr>
                                                <td>
                                                    <label>Unit Cost</label></td>
                                                <td>
                                                    <input name="unit_cost" type="text"
                                                           value="{{ old('unit_cost') ? old('unit_cost') : $unit_cost }}"
                                                           class="form-control">
                                                    <small class="error">{{$errors->first('unit_cost')}}</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Unit Price</label></td>
                                                <td>
                                                    <input name="unit_price" type="text"
                                                           value="{{ old('unit_price') ? old('unit_price') : $unit_price }}"
                                                           class="form-control">
                                                    <small class="error">{{$errors->first('unit_price')}}</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Description</label></td>
                                                <td>
                                                    <input name="description" type="text"
                                                           value="{{ old('description') ? old('description') : $description }}"
                                                           class="form-control">
                                                    <small class="error">{{$errors->first('description')}}</small>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Total Qty</label></td>
                                                <td>
                                                    <input name="current_amount" type="text" disabled
                                                           value="{{ old('current_amount') ? old('current_amount') : $current_amount }}"
                                                           class="form-control">
                                                    <small class="error">{{$errors->first('current_amount')}}</small>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Qty Shop</label></td>
                                                <td>
                                                    <input name="qty_shop" type="text"
                                                           @if($variant=='true')
                                                           disabled
                                                           @elseif($variant==='false')
                                                           enabled
                                                           @endif
                                                           value="{{ old('qty_shop') ? old('qty_shop') : $qty_shop }}"
                                                           class="form-control">
                                                    <small class="error">{{$errors->first('qty_shop')}}</small>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Qty Store {{$variant}}</label></td>
                                                <td>
                                                    <input name="qty_store" type="text"
                                                           @if($variant=='true')
                                                           disabled
                                                           @elseif($variant==='false')
                                                           enabled
                                                           @endif
                                                           value="{{ old('qty_store') ? old('qty_store') : $qty_store }}"
                                                           class="form-control">
                                                    <small class="error">{{$errors->first('qty_store')}}</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Item Order</label></td>
                                                <td>
                                                    <input name="item_order" type="text"
                                                           value="{{ old('item_order') ? old('item_order') : $item_order }}"
                                                           class="form-control">
                                                </td>

                                        </table>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-2 col-sm-2">
                                        <button type="submit" class="btn btn-primary" value='submit'><i
                                                    class="fa fa-save"></i> Update
                                        </button>
                                    </div>
                                    <div class="col-md-2 col-sm-2"><a role='button' style="float: left;display: inline;"
                                                                      class="btn btn-info"
                                                                      href="{{ route('barcode_print_variant', ['drug_id' =>  $drug_id."-0"]) }}">
                                            <i class="fa fa-qrcode"></i> Item Barcode </a>
                                    </div>

                                    <div class="col-md-2 col-sm-2"><a
                                                href="{{ route('del_item', [ 'drug_id' => $drug_id ]) }}">
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete Item
                                            </button>
                                        </a></div>
                                </div>


<?php if($variant =='true'){
?>

                                <br/><br/>
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Variants</a></li>
                                    {{--<li><a href="#batch" data-toggle="tab">Batch and Package</a></li>--}}
                                    {{--<li><a href="#warning" data-toggle="tab">Caution/Precaution</a></li>--}}
                                    {{--<li><a href="#side_effect" data-toggle="tab">Adverse Effect</a></li>--}}
                                    {{--<li><a href="#drug_intertaction" data-toggle="tab">Drug Interaction </a></li>--}}
                                </ul>

                                <br/>

                                <br/>
                                <div id="myTabContent" class="tab-content">

                                    <div class="tab-pane fade in active" id="home">
                                        <p>
                                        <div style="float:right"><input type="button" onclick="insRow('myTable1')"
                                                                        class="btn btn-success btn-sm"
                                                                        value="Add Variants"></div>
                                        </p>
                                        <table id="myTable1" class="table" onkeypress="return noenter();">
                                            <thead class="thead-inverse">
                                            <tr>
                                                <th hidden>id</th>
                                                <th>Variant</th>
                                                <th>Unit Cost</th>
                                                <th>Unit Price</th>
                                                <th>Qty Shop</th>
                                                <th>Qty Store</th>
                                                <th>Min Qty</th>
                                                <th>Delete</th>
                                                <th colspan="2">Print</th>
                                            </tr>
                                            </thead>
                                            <tbody id='varities_body'>

                                            <?php

                                            if(sizeof ($varities) == 0)
                                            {

                                            ?>
                                            <tr>
                                                <td hidden><input name='variant_id[]' value='new'/></td>
                                                <td>
                                                    <INPUT type="text" class="form-control" name="variant_name[]"
                                                           id="dosage" onchange="calculator(this);"
                                                           placeholder="Variant" required/></td>

                                                <TD><INPUT type="text" class="form-control" name="varity_unit_cost[]"
                                                           id="lngbox" placeholder="Cost" required/></TD>
                                                <TD><INPUT type="text" class="form-control" name="varity_unit_price[]"
                                                           id="unit_price" placeholder="price" required/></TD>
                                                <TD><INPUT type="text" class="form-control" name="shop[]"
                                                           id="lngbox" placeholder="Qty Shop" required/></TD>
                                                <TD><INPUT type="text" class="form-control" name="store[]"
                                                           id="lngbox" placeholder="Qty Store" required/></TD>
                                                <TD><INPUT type="text" class="form-control" name="min_qty_var[]"
                                                           id="lngbox" placeholder="Min Qty" required/></TD>

                                                <TD></TD>

                                                <td><input type="button" value="Delete" class="btn btn-danger"
                                                           onclick="deleteRowTab(this,'myTable1');"></td>
                                            </tr>
                                            <?php }
                                            else {
                                            ?>


                                            @foreach($varities as $uom)
                                                <tr>
                                                    <td hidden><input name='variant_id[]' value='{{$uom->id}}'/></td>

                                                    <td><input type="text" id="dosage"
                                                               value="{{ old('variant_name') ? old('variant_name') : $uom->variant_name }}"
                                                               class="form-control" name='variant_name[]'
                                                               Placeholder="Variant" requied>
                                                        <small class="error">{{$errors->first('variant_name')}}</small>
                                                    </td>

                                                    <TD><INPUT type="text" class="form-control"
                                                               name="varity_unit_cost[]" id="unit_cost"
                                                               placeholder="Cost" required
                                                               value="{{ old('unit_cost') ? old('unit_cost') : $uom->unit_cost }}"/>
                                                        <small class="error">{{$errors->first('unit_cost')}}</small>
                                                    </TD>
                                                    <TD><INPUT type="text" class="form-control"
                                                               name="varity_unit_price[]" id="unit_price"
                                                               placeholder="price" required
                                                               value="{{ old('unit_price') ? old('unit_price') : $uom->unit_price }}"/>
                                                        <small class="error">{{$errors->first('unit_price')}}</small>
                                                    </TD>
                                                    <TD><INPUT type="text" class="form-control" name="shop[]"
                                                                      id="lngbox" placeholder="Current Qty" required
                                                                      value="{{ old('shop') ? old('shop') : $uom->shop }}"/>
                                                        <small class="error">{{$errors->first('shop')}}</small>
                                                    </TD>
                                                    <TD><INPUT type="text" class="form-control" name="store[]"
                                                               id="lngbox" placeholder="Qty store" required
                                                               value="{{ old('store') ? old('store') : $uom->store }}"/>
                                                        <small class="error">{{$errors->first('store')}}</small>
                                                    </TD>
                                                    <TD><INPUT type="text" class="form-control" name="min_qty_var[]"
                                                               id="lngbox" placeholder="Min Qty"
                                                               value="{{ old('min_qty_var') ? old('min_qty_var') : $uom->min_qty_var }}"
                                                               required/>
                                                        <small class="error">{{$errors->first('min_qty_var')}}</small>
                                                    </TD>

                                                    <td><a role='button' class="btn btn-danger"
                                                           onclick='del_varity({{ $uom->id }})'> <i
                                                                    class="fa fa-trash"></i> Delete</button></td>

                                                    <td>
                                                        <a role='button' style="float: left;display: inline;"
                                                           class="btn btn-info"
                                                           href="{{ route('barcode_print_variant', ['code' =>  $drug_id."-".$uom->id]) }}">
                                                            <i class="fa fa-barcode"></i> Barcode</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <?php
                                            }
                                            }
                                            ?>
                                            </tbody>
                                        </table>


                                    </div>
                                    <input type="hidden" id="drug_id" value={{$drug_id}} />


                                </div>


                            </div>
                        </div>

    </form>

    <div class="col-md-5">
        <div class="row">
            <!-- The Modal -->

            <script>


                // Get the modal
                var modal = document.getElementById('id01');

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function (event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>


            <script>
                function deleteRowTab(pos, id) {
                    if (id == 2) {
                        id = 'warning_table'
                    }
                    else if (id == 3) {
                        id = 'side_effect_table'
                    }
                    else if (id == 1) {
                        id = 'myTable1'
                    }
                    else {
                        id = id
                    }
                    var x = document.getElementById(id).rows.length;
                    var row = pos.parentNode.parentNode;
                    var tbl = document.getElementById(id);
                    tbl.deleteRow(row.rowIndex);

                }


                function insRow(id) {
                    var filas = document.getElementById(id).rows.length;
                    //alert(filas)


                    var x = document.getElementById(id).insertRow(filas);
                    var a = x.insertCell(0);
                    var b = x.insertCell(1);
                    var c = x.insertCell(2);
                    var d = x.insertCell(3);
                    var e = x.insertCell(4);
                    var f = x.insertCell(5);
                    var g = x.insertCell(6);
                    var h = x.insertCell(7);
                    var i = x.insertCell(8);
                    var j = x.insertCell(9);

                    var k = x.insertCell(10);


                    a.innerHTML = '<input name="variant_id[]" value="new"/>';
                    a.hidden = true

                    b.innerHTML = '<INPUT type="text" class="form-control" name ="variant_name[]" id="dosage"  onchange="calculator(this);"  placeholder="Variant"  required/>';
                    c.innerHTML = '<INPUT type="text" class="form-control" name="varity_unit_cost[]" id="lngbox" placeholder="Cost"  required/>';
                    d.innerHTML = '<INPUT type="text" class="form-control" name="varity_unit_price[]"   id="unit_price" placeholder="price"  required/>'
                    e.innerHTML = '<INPUT type="text" class="form-control" name="shop[]" id="lngbox" placeholder="Qty Shop"  required/>';
                    f.innerHTML = '<INPUT type="text" class="form-control" name="store[]" id="lngbox" placeholder="Qty Store"  required/>';

                    //y.innerHTML = '<input type="text" id="fname" name="barcode[]" onkeypress="return noenter()">';
                    g.innerHTML = '<INPUT type="text" class="form-control" name="min_qty_var[]" id="lngbox" placeholder="Min Qty"  required/>';
                    h.innerHTML = '';
                    i.innerHTML = '<input type="button" value="Delete" class="btn btn-danger" onclick="deleteRowTab(this,1);">'
                    //k.innerHTML = n;
                    // document.getElementById("myTable").rows[1].hidden=true

                }


            </script>

            <script>

                function del_varity(o) {
                    id = o;
                    drug = document.getElementById('drug_id').value;


                    $.ajax({

                        type: 'GET',

                        url: "{{ route('delete_drug_varity') }}",

                        data: {id: id, drug: drug},

                        success: function (data) {


                            document.getElementById('varities_body').innerHTML = data.edited_varities
                            console.log(data.edited_varities)

                        }
                    });
                }

                function default_varity_value() {
                    variant_id = Id
                    freq = document.getElementById('freq').value;
                    default_dosage = document.getElementById('default_dosage').value;
                    default_uom = document.getElementById('default_uom').value;
                    defualt_duration_day = document.getElementById('defualt_duration_day').value;
                    default_duration = document.getElementById('default_duration').value;
                    default_route = document.getElementById('default_route').value;
                    // alert(variant_id)


                    $.ajax({

                        type: 'GET',

                        url: "{{ route('default_varity') }}",

                        data: {
                            id: variant_id,
                            freq: freq,
                            default_dosage: default_dosage,
                            default_uom: default_uom,
                            defualt_duration_day: defualt_duration_day,
                            default_duration: default_duration,
                            default_route: default_route
                        },

                        success: function (data) {

                            console.log(data.edited_varities)

                        }
                    });

                    document.getElementById('id01').style.display = 'none'
                }


                let Id = 0

            </script>


@endsection
