
@extends('layouts.app')

@section('content')

<div class="col-md-6 col-sm-6">

<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">Edit adjustment</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
<table class="table">
<form role='form' action="{{ $modify == 1 ? route('update_adjustment', [ 'adjustment_id' => $adjustment_id ]) : route('create_adjustment') }}" method="post">

@csrf
<tr><td>
            <label>Product</label>
            </td><td><input name="item_selected" type="text" value="{{ old('real_item_selected_name') ? old('item_selected_name') : $items->item_name }}" class="form-control"  disabled>
            <small class="error">{{$errors->first('item_selected_name')}}</small>
</td></tr>
<input name="item_selected_name" type="hidden" value="{{ $items->id }}" >
            
</td></tr>


<tr><td>
            <label>Real Amount</label></td><td>
            <input name="real_amount" type="text" value="{{ old('real_amount') ? old('real_amount') : $real_amount }}" class="form-control" >
            <small class="error">{{$errors->first('real_amount')}}</small>
</td></tr>

<tr><td>
            <label>Date</label></td><td>
            <input name="date" type="text" value="{{ old('date') ? old('date') : $date }}" class="form-control">
            <small class="error">{{$errors->first('date')}}</small>
</td></tr>

    <tr><td>
            <label>Location</label></td><td>
            <label>{{ old('location') ? old('location') : $loc }}</label>
            <small class="error">{{$errors->first('location')}}</small>
            <input type=hidden name="location" value="{{$location}}">
            <input name="item_location" type="hidden" value="{{ $location }}" >

        </td>
    </tr>

    <tr><td>
            <label>Barcode</label></td><td>
            <label>{{ old('barcode') ? old('barcode') : $barcode }} </label>
            <small class="error">{{$errors->first('barcode')}}</small>
            
            <input type=hidden name="barcode" value="{{$barcode}}">
        </td></tr>

    <tr><td>
            <label>Reason</label></td><td>
            <input name="reason" type="text" value="{{ old('reason') ? old('reason') : $reason }}" class="form-control">
            <small class="error">{{$errors->first('reason')}}</small>
</td></tr>
<tr><td>
            <input value="SAVE" class="button btn-success btn-sm" type="submit">
</td></tr>
</table>
</form>
</div>
</div>
</div>
</div>
@endsection