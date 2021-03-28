
@extends('layouts.app')

@section('content')

<div class="row">

<div class="col-md-6 col-sm-6">

<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Supplier Detail</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
<table class="table">

<form action="{{ $modify == 1 ? route('update_supplier', [ 'supplier_id' => $supplier_id ]) : route('create_supplier') }}" method="post">
@csrf

<tr><td>
            <label>Supplier Name</label></td><td>
            <input name="supplier_name" type="text" value="{{ old('supplier_name') ? old('supplier_name') : $supplier_name }}" required class="form-control">
            <small class="error">{{$errors->first('supplier_name')}}</small>


</td></tr>
<tr><td>
            <label>Address</label></td><td>
            <input name="address" type="text" value="{{ old('address') ? old('address') : $address }}" class="form-control">
            <small class="error">{{$errors->first('address')}}</small>

</td></tr>
</td></tr><tr><td>
            <label>Telephone</label></td><td>
            <input name="telephone" type="text" value="{{ old('telephone') ? old('telephone') : $telephone }}" class="form-control">
            <small class="error">{{$errors->first('telephone')}}</small>

</td></tr>


{{--<tr><td>--}}
            {{--<label>Account No</label></td><td>--}}
            {{--<input name="account_number" type="text" value="{{ old('account_number') ? old('account_number') : $account_number }}" class="form-control">--}}
            {{--<small class="error">{{$errors->first('account_number')}}</small>--}}

{{--</td></tr>--}}
    <tr><td>
            <label>Mobile</label></td><td>
            <input name="mobile" type="text" value="{{ old('mobile') ? old('mobile') : $mobile }}" class="form-control">
            <small class="error">{{$errors->first('mobile')}}</small>

</td></tr>

</td></tr><tr><td>
            <label>Remark</label></td><td>
            <input name="remark" type="text" value="{{ old('remark') ? old('remark') : $remark }}" class="form-control">
            <small class="error">{{$errors->first('remark')}}</small>

</td></tr>

<tr>
        <td><label>Supplier Balance</label></td>
        <td>	
    <select class='form-control' name="balance_type">                                                
            <option value="{{ old('balance_type') ? old('balance_type') : $balance_type }}">{{ old('balance_type') ? old('balance_type') : $balance_type }}</option>
            <option value="unpaid">Unpaid</option>
            <option value="overpaid">Overpaid</option>
    </select>
    <input type="text" class='form-control' name="balance_amount" value="{{ old('balance_amount') ? old('balance_amount') : $balance_amount }}"  required/>

</td>
</tr>

<tr><td>
            <input value="SAVE" class="btn btn-primary" type="submit"></td>

            <td><a href="{{ route('del_supplier_get', [ 'supplier_id' => $supplier_id ]) }}"class="btn btn-danger">DELETE</a></td> 
            </tr>
</div>
</form>
</table>
</div>
    </div>
    </div>

@endsection