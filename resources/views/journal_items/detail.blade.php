
@extends('layouts.app')

@section('content')


<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Edit Item</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
<table class="table">
<form role='form' action="{{ $modify == 1 ? route('update_item', [ 'item_id' => $item_id ]) : route('create_client') }}" method="post">
@csrf

<tr><td>
            <label>Item Name</label></td><td>
            <input name="item_name" type="text" value="{{ old('item_name') ? old('item_name') : $item_name }}">
            <small class="error">{{$errors->first('item_name')}}</small>
</td></tr>


<tr><td>
            <label>Item Code</label></td><td>
            <input name="item_code" type="text" value="{{ old('item_code') ? old('item_code') : $item_code }}">
            <small class="error">{{$errors->first('item_code')}}</small>
</td></tr>

<tr><td>
            <label>Min Qty</label></td><td>
            <input name="min_qty" type="text" value="{{ old('min_qty') ? old('min_qty') : $min_qty }}">
            <small class="error">{{$errors->first('min_qty')}}</small>
</td></tr>

<tr><td>
            <label>Unit Price</label></td><td>
            <input name="unit_price" type="text" value="{{ old('unit_price') ? old('unit_price') : $unit_price }}">
            <small class="error">{{$errors->first('unit_price')}}</small>
</td></tr>

<tr><td>
            <label>Unit Cost</label></td><td>
            <input name="unit_cost" type="text" value="{{ old('unit_cost') ? old('unit_cost') : $unit_cost }}">
            <small class="error">{{$errors->first('unit_cost')}}</small>
</td></tr>

<tr><td>
            <label>Description</label></td><td>
            <input name="description" type="text" value="{{ old('description') ? old('description') : $description }}">
            <small class="error">{{$errors->first('description')}}</small>
</td></tr>

<tr><td>
            <input value="SAVE" class="button success hollow" type="submit">
</td></tr>
</table>
</form>
</div>
</div>
</div>
</div>
@endsection