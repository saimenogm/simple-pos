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
      <div class="medium-4 large-4 columns">
       
     <table class="table">   
<tr><td>
            <label>Beginning Balance</label></td><td>
            <label>{{$session->beginning_bal}}</label>
           
</td></tr>

                


    <tr><td>
            <label>Ending Balance</label></td><td>
            <label>{{$session->ending_bal}}</label>
         
        </td>
    </tr>

    <tr><td>
            <label>Total Amount Sold</label></td><td>
            <label>{{$session->sales_total}}</label>
           
        </td></tr>

   

<tr><td>
            <label>User</label></td><td>
            <label>{{$session->name}}</label>
           
           
</td></tr>

<tr><td>
            <label>Reciver</label>
            </td><td>
            <label>{{$session->accepted_by}}</label>
            </td>

</tr>
        <tr><td></td><td><a role='button' class="btn btn-primary " href="{{ route('session_index') }}"><span >Close</span></a></td>
                        </tr>
            </table>
     

    </div>
    </div> 
    
</div>

    @endsection
