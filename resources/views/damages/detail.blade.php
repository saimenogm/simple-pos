
@extends('layouts.app')

@section('content')

<div class="col-md-6 col-sm-6">

<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Damage Detail</h3>
</div>
<div class="panel-body">
<div class="block-content">
                        <div class="block">


      <div class="row">
      <div class="medium-12 large-12 columns">
<table class="table">
<form role='form' action="{{ $modify == 1 ? route('update_damage', [ 'damage_id' => $damage_id ]) : route('create_damage') }}" method="post">

@csrf
<tr><td>
            <label>Product</label></td><td>
            <select class="form-control" name="item" id="lngbox" disabled>
                                                        @foreach ($items as $item)
                                                        <?php
                                                        if($item->id==$item_id){
                                                              ?>
                                                            <option value="{{$item->id}}" name="item_name" selected=true>{{$item->item_name}}</option>

                                                              <?php
                                                        }else
                                                        {
                                                              ?>
                                                            <option value="{{$item->id}}" name="item_name">{{$item->item_name}}</option>

                                                              <?php
                                                        }
                                                        
                                                        ?>
                                                            @endforeach
            </select>

            <small class="error">{{$errors->first('damage')}}</small>
</td></tr>

<tr><td>
            <label>Amount</label></td><td>
            <label>{{ old('amount') ? old('amount') : $amount }}</label>
            <small class="error">{{$errors->first('amount')}}</small>
</td></tr>

<tr><td>
            <label>Date</label></td><td>
            <label>{{ old('date') ? old('date') : $date }}</label>
            <small class="error">{{$errors->first('date')}}</small>
</td></tr>

    <tr><td>
            <label>Location</label></td><td>
            <label>{{ old('date') ? old('date') : $date }}</label>
            <small class="error">{{$errors->first('date')}}</small>
        </td></tr>
<tr><td>
            <label>Reason</label></td><td>
            <label>{{ old('reason') ? old('reason') : $reason }}</label>
            <small class="error">{{$errors->first('reason')}}</small>
</td></tr>

<tr><td>
            <label>Status</label></td><td>
            <label>{{ old('status') ? old('status') : $status }}</label>
            <small class="error">{{$errors->first('status')}}</small>
</td></tr>

</table>
</form>

<form class="form-horizontal" name="transfer_form" id="transfer_form" action="{{route('del_damage')}}" method="post">
        @csrf
<input type="hidden" value="{{$damage_id}}" name="damage_id"/>
        <input value="Delete Damage" class="btn btn-danger" type="submit">

    </form>

</div>
</div>
</div>
</div>
@endsection