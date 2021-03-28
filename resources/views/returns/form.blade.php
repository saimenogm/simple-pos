
@extends('layouts.app')

@section('content')

<script>


$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

</script>

<div class="row">

<div class="col-md-6 col-sm-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Register Return</h3>
</div>
<div class="panel-body">

      <div class="row">
      <div class="medium-7 large-7 columns">
        <form action="{{route('create_return')}}" method="post">
        @csrf  
            <table class="table">
            
          <tr><td>
            <label>Product</label></td><td>
            <select class="form-control" name="item" id="lngbox">
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
            <label>Amount</label></td><td>
            <input name="real_amount" type="text" class="form-control" value="">
        </td></tr>

        <tr><td>
            <label>Barcode</label></td><td>
            <input name="barcode" type="text" class="form-control" value="">
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

        </form>
</table>
    </div> 
    
</div>
    @endsection
