
@extends('layouts.app')

@section('content')

<div class="row">

<div class="col-md-6 col-sm-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Customer</h3>
</div>
<div class="panel-body">

      <div class="row">
      <div class="medium-7 large-7 columns">
        <form action="{{route('create_customer')}}" method="post">
        @csrf  
            <table class="table">
          <tr><td>
            <label>Customer Name</label></td><td>
            <input name="customer_name"  type="text" value="" class="form-control" required>
        </td></tr>
                {{--<tr><td>--}}
                        {{--<label>Age</label></td><td>--}}
                        {{--<input name="age" type="text" value="" class="form-control">--}}
                    {{--</td></tr>--}}
                {{--<tr>--}}
                    {{--<td><label>Gender</label></td>--}}
                    {{--<td>--}}
                        {{--<label>Male </label> <input id='male' name="gender" type="radio" value="male"> &nbsp;--}}
                        {{--<label>Female </label> <input id='female' name="gender" type="radio" value="female"></td>--}}
                {{--</tr>--}}
        <tr><td>
            <label>Telephone</label></td><td>
            <input name="telephone" type="text" value="" class="form-control">
        </td></tr>
        {{--<tr><td>--}}
                        {{--<label>Zone</label></td><td>--}}
                        {{--<select class="form-control" name="zone" required>--}}
                            {{--<option value=""></option>--}}
                            {{--<option value="Zoba Maekel">Maekel</option>--}}
                            {{--<option value="Zoba Anseba">Anseba</option>--}}
                            {{--<option value="Gash Barka">Gash Barka</option>--}}
                            {{--<option value="Debub">Debub</option>--}}
                            {{--<option value="Debubawi K. Bahri">Debubawi K. Bahri</option>--}}
                            {{--<option value="Semenawi K. Bahri">Semenawi K. Bahri</option>--}}
                        {{--</select>--}}
                    {{--<td></tr><tr><td> <label>City</label></td><td>--}}
                        {{--<input name="city" type="text" value="" class="form-control">--}}
                    {{--</td></tr>--}}
        <tr><td>
            <label>Contact Person</label></td><td>
            <input name="contact_person" type="text" value="" class="form-control">
        </td></tr>
                {{--<tr><td>--}}
                        {{--<label>Regular Customer</label></td><td>--}}
                        {{--<input id='regular_customer_check' name="regular_customer_check" type="checkbox" value="yes">--}}
                    {{--</td></tr>--}}

                {{--<tr><td>--}}
            {{--<label>Account number</label></td><td>--}}
            {{--<input name="account_number" type="text" value="" class="form-control" >--}}
        {{--</td></tr>--}}
        <tr><td>
            <label>Mobile</label></td><td>
            <input name="mobile" type="text" value="" class="form-control">
        </td></tr>
        {{--<tr><td>--}}
            {{--<label>Email</label></td><td>--}}
            {{--<input name="email" type="text" value="" class="form-control">--}}
        {{--</td></tr>--}}
		<tr><td>
            <label>Remark</label></td><td>
            <input name="remark" type="text" value="" class="form-control">
        </td></tr>

        <tr>
        <td><label>Customer Balance</label></td>
        <td>
    <select class="form-control" name="balance_type" required>
            <option value="unpaid">Unpaid</option>
            <option value="overpaid">Overpaid</option>
    </select>
    <input type="text" class="form-control" name="balance_amount" required />

</td>

        </tr>

        <tr><td>
            <button type='Submit' role='button' class='btn btn-info'> <i class='fa fa-fw fa-save'></i> Save </button>
            </td></tr>

        </form>
</table>
    </div>
    </div> 
    
</div>
    @endsection
