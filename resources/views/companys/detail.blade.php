
@extends('layouts.app')

@section('content')

<div class="row">

<div class="col-md-6 col-sm-6">

<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Edit Company </h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


<table class="table">
<form role='form' action="{{ $modify == 1 ? route('update_company', [ 'company_id' => $company_id ]) : route('create_client') }}" method="post">

@csrf
<tr><td>
            <label>Company Name</label></td><td>
            <input name="company_name" type="text" value="{{ old('company_name') ? old('company_name') : $company_name }}" class="form-control" required>
            <small class="error">{{$errors->first('company_name')}}</small>
</td></tr>
<tr><td>
            <label>Company Code</label></td><td>
            <input name="company_code" type="text" value="{{ old('company_code') ? old('company_code') : $company_code }}" class="form-control">
            <small class="error">{{$errors->first('company_code')}}</small>
</td></tr>


<tr><td>
            <label>Description</label></td><td>
            <input name="description" type="text" value="{{ old('description') ? old('description') : $description }}" class="form-control">
            <small class="error">{{$errors->first('description')}}</small>
</td></tr>



<tr><td>
            <input value="SAVE" class="btn btn-primary" type="submit">
</td><td></td>
</tr>
</table>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection