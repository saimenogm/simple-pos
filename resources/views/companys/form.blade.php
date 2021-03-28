
@extends('layouts.app')

@section('content')

<div class="row">

<div class="col-md-6 col-sm-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Company</h3>
</div>
<div class="panel-body">

      <div class="row">
      <div class="medium-7 large-7 columns">
        <form action="{{route('create_company')}}" method="post">
        @csrf  
            <table class="table">
          <tr><td>
            <label>Company Name</label></td><td>
            <input name="company_name"  type="text" value="" class="form-control" required>
        </td></tr>
        <tr><td>
            <label>Company Code</label></td><td>
            <input name="company_code" type="text" value="" class="form-control">
        </td></tr>
        <tr><td>
            <label>Description</label></td><td>
            <input name="description" type="text" value="" class="form-control">
        </td></tr>
        
        <tr><td>
            <button type='Submit' role='button' class='btn btn-info'> <i class='fa fa-fw fa-save'></i> Save </button>
            </td></tr>

        </form>
</table>
    </div>
    </div> 
    
</div>
    @endsection
