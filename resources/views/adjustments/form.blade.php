
@extends('layouts.app')

@section('content')

    <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>

        <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        </script>

    <div class="row">

<div class="col-md-9 col-sm-9">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Register Adjustment</h3>
</div>
<div class="panel-body">

      <div class="row">
      <div class="col-md-9 col-sm-9">
        <form action="{{route('new_adjustment2')}}" method="post">
        @csrf  
            <table class="table">
            
          <tr><td>
            <label>Product</label></td><td>
            <select class="form-control" name="item" id="item" onclick="get_packages();">
            <option value="" name="item_name"></option>
                                                        
                @foreach ($items as $item)
                <?php 
                if($item->color!=null){
                    $item_variety = " (".$item->color.", ".$item->size.")";
                }else{
                    $item_variety="";
                }
                ?>
                    <option value="{{$item->id}}-{{$item->barcode_id}}" name="{{$item->id}}">{{$item->item_name}} {{$item_variety}}</option>
                @endforeach
            </select>

        </td></tr>
        <tr><td>
            <label>Date</label></td><td>
            <input name="date" type="date" class="form-control" value="">
        </td></tr>
        <tr><td>
            <label>Reason/Description</label></td><td>
            <input name="reason" type="text" class="form-control" value="">
        </td></tr>

        <tr><td>
            <button type='Submit' role='button' class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Save </button>
            </td></tr>

            </table>

                <table id='table_receipts' class="table">
                    <thead>
                    <tr>
                        <th>Package ID</th>
                        <th>Item</th>
                        <th>Purchase Date</th>
                        <th>Ideal Qty Shop</th>
                        <th>Real Qty Shop</th>
                        <th>Ideal Qty Store</th>
                        <th>Real Qty Store</th>
                    </tr>
                    </thead>
                    <tbody id="table-data">

                    </tbody>
                </table>

        </form>
</table>
    </div> 
    
</div>
</div>
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
                url: "{{route('find_adjustment_packages')}}",
                data: {'item_id': item_id},
                success:function(data){
                    if (data.success == "DONE") {
                        console.log("Fuck yes");
                    }
                    console.log(data)
                    $('#table-data').html(data.data);
                }
            });
        }

    </script>

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>


@endsection

