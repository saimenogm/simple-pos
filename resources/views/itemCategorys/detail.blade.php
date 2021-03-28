
@extends('layouts.app')

@section('content')

<div class="col-md-6 col-lg-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Edit itemCategory</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
<table class="table">
<form role='form' action="{{ $modify == 1 ? route('update_itemCategory', [ 'itemCategory_id' => $itemCategory_id ]) : route('create_itemCategory') }}" method="post">
@csrf
<tr><td>
            <label>Category Name</label></td><td>
            <input name="category_name" type="text" value="{{ old('category_name') ? old('category_name') : $category_name }}" class="form-control" required>
            <small class="error">{{$errors->first('category_name')}}</small>
</td></tr>

<tr><td>
            <label>Category Code</label></td><td>
            <input name="itemCategory_code" type="text" value="{{ old('itemCategory_code') ? old('itemCategory_code') : $itemCategory_code }}" class="form-control">
            <small class="error">{{$errors->first('itemCategory_code')}}</small>
</td></tr>


<tr><td>
            <label>Description</label></td><td>
            <input name="description" type="text" value="{{ old('description') ? old('description') : $description }}" class="form-control">
            <small class="error">{{$errors->first('description')}}</small>
</td></tr>

<tr><td>
            <input value="SAVE" class="btn btn-primary" type="submit">
</td></tr>
</table>
</form>
</div>
</div>
</div>
</div>
@endsection