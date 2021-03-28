
@extends('layouts.app')

@section('content')

<div class="col-md-6 col-sm-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Edit expense</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
<table class="table">
<form role='form' action="{{ $modify == 1 ? route('update_expense', [ 'expense_id' => $expense_id ]) : route('create_client') }}" method="post">

@csrf
<tr><td>
            <label>Expense Name</label></td><td>
            <input name="expense_name" type="text" value="{{ old('expense_name') ? old('expense_name') : $expense_name }}" class="form-control" required>
            <small class="error">{{$errors->first('expense_name')}}</small>
</td></tr>
<tr><td>
            <label>Amount</label></td><td>
            <input name="amount" type="text" value="{{ old('amount') ? old('amount') : $amount }}" class="form-control" required>
            <small class="error">{{$errors->first('amount')}}</small>
</td></tr>


<tr><td>
            <label>date</label></td><td>
            <input name="date" type="date" value="{{ old('date') ? old('date') : $date }}" class="form-control" required>
            <small class="error">{{$errors->first('date')}}</small>
</td></tr>

<tr><td>
            <label>Remark</label></td><td>
            <input name="remark" type="text" value="{{ old('remark') ? old('remark') : $remark }}" class="form-control" >
            <small class="error">{{$errors->first('remark')}}</small>
</td></tr>


<tr><td>
            <input value="SAVE" class="btn btn-primary hollow" type="submit">
</td></tr>
</table>
</form>
</div>
</div>
</div>
</div>
@endsection