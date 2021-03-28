
@extends('layouts.app')

@section('content')


<div class="panel panel-info">
<div class="panel-heading">
<h3 class="panel-title">Edit account</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
<table class="table">
<form role='form' action="{{ $modify == 1 ? route('update_account', [ 'account_id' => $account_id ]) : route('create_client') }}" method="post">
@csrf

<tr><td>
            <label>account Name</label></td><td>
            <input name="account_name" type="text" value="{{ old('account_name') ? old('account_name') : $account_name }}">
            <small class="error">{{$errors->first('account_name')}}</small>
</td></tr>


<tr><td>
            <label>account Code</label></td><td>
            <input name="account_code" type="text" value="{{ old('account_code') ? old('account_code') : $account_code }}">
            <small class="error">{{$errors->first('account_code')}}</small>
</td></tr>

<tr><td>
            <label>Account Type</label></td><td>
            <input name="account_type" type="text" value="{{ old('account_type') ? old('account_type') : $account_type }}">
            <small class="error">{{$errors->first('account_type')}}</small>
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