
@extends('layouts.app')

@section('content')

<div class="row">

<div class="col-md-6 col-sm-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Register location</h3>
</div>
<div class="panel-body">

      <div class="row">
      <div class="medium-7 large-7 columns">
        <form action="{{route('create_location')}}" method="post">
        @csrf  
            <table class="table">
            
        <tr><td>
            <label>Location</label></td><td>
            <input class='form-control' name="location_name" type="text" value="">
        </td></tr>
        <tr><td>
            <label>Address</label></td><td>
            <input class='form-control' name="address" type="text" value="">
        </td></tr>
        <tr><td>
            <label>Description</label></td><td>
            <input class='form-control' name="description" type="text" value="">
        </td></tr>
       
        <tr><td>
            <button type='Submit' role='button' class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Save </button>
            </td></tr>

        </form>
</table>
    </div>
    </div> 
    
</div>
    @endsection
