@extends('layouts.app')

@section('content')

<div class="row">
      <div class="col-md-7 col-lg-7 columns">

<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Supplier</h3>
</div>
<div class="panel-body">


        <form action="" method="post">

        @csrf
        <table class="table">

        <tr><td>
            <label>Supplier Name</label></td><td>
            <input name="supplier_name" type="text" value="" class="form-control" required>
          </td>
        </tr>
            <tr><td>
            <label>Telephone</label></td><td>
            <input name="telephone" type="text" value="" class="form-control">
        </td></tr><tr><td>
            <label>Address</label></td><td>
            <input name="address" type="text" value="" class="form-control">
  
        </td></tr>
            {{--<tr><td>--}}
            {{--<label>Account number</label></td><td>--}}
            {{--<input name="account_number" type="text" value="" class="form-control">--}}
        {{--</td></tr>--}}
            <tr><td>
            <label>Mobile</label></td><td>
            <input name="mobile" type="text" value="" class="form-control">
        </td></tr>
		<tr><td>
            <label>Remark</label></td><td>
            <input name="remark" type="text" value="" class="form-control">
        </td></tr>
        <tr>
        <td><label>Supplier Balance</label></td>
        <td>	
    <select class="form-control" name="balance_type" >                                                
            <option value="unpaid">Unpaid</option>
            <option value="overpaid">Overpaid</option>
    </select>
    <input type="text" class="form-control" name="balance_amount"  required/>

</td>

        </tr>

        <tr><td>
        <div class="medium-12  columns">
        <button type='Submit' role='button' class='btn btn-info'> <i class='fa fa-fw fa-save'></i> Save </button>
            
          </div>
        </td>
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