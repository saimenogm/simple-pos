
@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-md-6 col-sm-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Account</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
        <form action="" method="post" name="new_account">
        @csrf
      
            <table class="table">
          <tr><td>
            <label>Account Name</label></td><td>
            <input name="account_name" type="text" value="">
        </td></tr>
        <tr><td>
            <label>Account Code</label></td><td>
            <input name="account_code" type="text" value="">
        </td></tr>
        <tr><td>
            <label>Account type</label></td><td>
            <input name="account_type" type="text" value="">
        </td></tr>
        <tr><td>
            <label>Account Description</label></td><td>
            <input name="description" type="text" value="">
        </td></tr>

        <tr><td>
            <button type='Submit' role='button' class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Save </button>
            </td></tr>

        </form>
</table>
    </div>
    </div> 
</div>
</div>
</div>
    @endsection
