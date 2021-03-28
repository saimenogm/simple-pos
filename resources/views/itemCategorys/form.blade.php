
@extends('layouts.app')

@section('content')

<div class="col-md-6 col-lg-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Category</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
        <form action="" method="post">
        @csrf
            <table class="table">
          <tr><td>
            <label>Category Name</label></td><td>
            <input name="category_name" type="text" value="" class="form-control" required>
        </td></tr>
        <tr><td>
            <label>Category Code</label></td><td>
            <input name="itemCategory_code" type="text" value="" class="form-control">
        </td></tr>
        <tr><td>
            <label>Description</label></td><td>
            <input name="description" type="text" value="" class="form-control">
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
