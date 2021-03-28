
@extends('layouts.app')

@section('content')


<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Edit Customer</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
<table class="table">
<form role='form' action="{{ $modify == 1 ? route('update_customer', [ 'customer_id' => $customer_id ]) : route('create_client') }}" method="post">

@csrf
<tr><td>
            <label>Customer Name</label></td><td>
            <input name="customer_name" type="text" value="{{ old('customer_name') ? old('customer_name') : $customer_name }}">
            <small class="error">{{$errors->first('customer_name')}}</small>
</td></tr>

<tr><td>
            <label>Address</label></td><td>
            <input name="address" type="text" value="{{ old('address') ? old('address') : $address }}">
            <small class="error">{{$errors->first('address')}}</small>
</td></tr>

<tr><td>
            <label>Account No</label></td><td>
            <input name="account_number" type="text" value="{{ old('account_number') ? old('account_number') : $account_number }}">
            <small class="error">{{$errors->first('account_number')}}</small>
</td></tr>

<tr><td>
            <label>Mobile</label></td><td>
            <input name="mobile" type="text" value="{{ old('mobile') ? old('mobile') : $mobile }}">
            <small class="error">{{$errors->first('mobile')}}</small>
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