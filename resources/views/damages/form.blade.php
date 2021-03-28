
@extends('layouts.app')

@section('content')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>


    <div class="row">

<div class="col-md-6 col-sm-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Register Damage </h3>
</div>
<div class="panel-body">

      <div class="row">
      <div class="medium-7 large-7 columns">
        <form action="{{route('create_damage')}}" method="post">
        @csrf  
            <table class="table">
            
          <tr><td>
            <label>Product</label></td><td>
            <select class="form-control" name="item" id="item" required onclick="get_packages();">
            <option value="" name=""></option>
            <option value=""></option>

                @foreach ($items as $item)
                <?php 
//                if($item->color!=null){
//                    $item_variety = " (".$item->color.", ".$item->size.")";
//                }else{
//                    $item_variety="";
//                }

                    if($item->variant_name!=null){
                        $item_variety = $item->variant_name;
                    }else{
                        $item_variety="";
                    }
                ?>
                    <option value="{{$item->id}}-{{$item->barcode_id}}" name="{{$item->id}}">{{$item->item_name}} {{$item_variety}}</option>
                @endforeach

            </select>

        </td></tr>
        <tr><td>
            <label>Location</label></td><td>
            <select class="form-control" name="location" id="lngbox" required>
                                                            <option value="" name="item_name"></option>
                                                            <option value="1" name="item_name">Shop</option>
                                                            <option value="2" name="item_name">Store</option>
            </select>

        </td></tr>

        <tr><td>
            <label>Amount Damaged</label></td><td>
            <input name="amount" type="text" class="form-control" value="" required>
        </td></tr>
        <tr><td>
            <label>Date</label></td><td>
            <input type="date" class="form-control" id="iv_date" name="date" required/>
        </td></tr>

        <tr><td>
            <label>Package Name</label></td><td>
            <select class="form-control" name="package" id="package_select" >
            <option value="" name=""></option>
            </select>

        </td></tr>

        {{--<tr><td>--}}
            {{--<label>Barcode</label></td><td>--}}
            {{--<input name="barcode" type="text" class="form-control" value="">--}}
        {{--</td></tr>--}}
        <tr><td>
            <label>Reason/Description</label></td><td>
            <input name="reason" type="text" class="form-control" value="">
        </td></tr>
        <tr><td>
            <label>Remark</label></td><td>
            <input name="remark" type="text" class="form-control" value="">
        </td></tr>

        <tr><td>
            <button type='Submit' role='button' class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Save </button>
            </td></tr>

        </form>
</table>
      </div>
    </div> 
    
</div>

    <script type="text/javascript">

        function get_packages(){

            var item = document.getElementById('item');
            item_id = item.value;

            console.log("hellloowww "+item_id);

            $.ajax({
                type: 'GET',
                url: "{{route('find_damage_packages')}}",
                data: {'item_id': item_id},
                success:function(data){
                    if (data.success == "DONE") {
                        console.log("Fuck yes");
                    }
                    console.log(data)
                    document.getElementById('package_select').innerHTML=data.data;
                    //$('#table-data').html(data.data);
                }
            });
        }

    </script>


    @endsection
