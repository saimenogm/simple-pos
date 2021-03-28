
@extends('layouts.app')

@section('content')

<div class="row">

<div class="col-md-6 col-sm-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Session</h3>
</div>
<div class="panel-body">

      <div class="row">
      <div class="medium-7 large-7 columns">
      <form action="{{route('new_session_create')}}" method="post">
        @csrf  
            
        <tr><td>
            <label>Beginning Balance</label></td><td>
            <input id='beginning_bal' name="beginning_bal" type="number" value="" required>
        </td></tr>
        <tr>
        <td></td><td>
            <button type='Submit'  class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Begin Session </button>
            </td></tr>
        </form>

    </div>
    </div> 
    
</div>

    @endsection
