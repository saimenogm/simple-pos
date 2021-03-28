
@extends('layouts.app')

@section('content')


<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Edit location</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
<table class="table">
<form role='form' action="{{ $modify == 1 ? route('update_location', [ 'location_id' => $location_id ]) : route('create_location') }}" method="post">

@csrf
<tr><td>
            <label>location Name</label></td><td>
            <input name="location_name" type="text" value="{{ old('location_name') ? old('location_name') : $location_name }}" required>
            <small class="error">{{$errors->first('location_name')}}</small>
</td></tr>

<tr><td>
            <label>Address</label></td><td>
            <input name="address" type="text" value="{{ old('address') ? old('address') : $address }}">
            <small class="error">{{$errors->first('address')}}</small>
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