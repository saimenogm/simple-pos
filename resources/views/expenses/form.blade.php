
@extends('layouts.app')

@section('content')

<div class="row">

<div class="col-md-6 col-sm-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Expense</h3>
</div>
<div class="panel-body">

      <div class="row">
      <div class="medium-7 large-7 columns">
        <form action="{{route('create_expense')}}" method="post">
        @csrf  
            <table class="table">
          <tr><td>
            <label>Expense Name</label></td><td>
            <input name="expense_name"  type="text" value="" class="form-control" required>
        </td></tr>
        <tr><td>
            <label>Date</label></td><td>
            <input name="date" type="date" value="" class="form-control" required>
        </td></tr>
        <tr><td>
            <label>Amount</label></td><td>
            <input name="amount" type="text" value="" pattern="^\[0-9]+.d{2}$" class="form-control"  required>
        </td></tr>
        <tr><td>
            <label>Remark</label></td><td>
            <input name="remark" type="text" value="" class="form-control">
        </td></tr>
        <tr><td>
            <button type='Submit' role='button' class='btn btn-info'> <i class='fa fa-fw fa-save'></i> Save </button>
            </td></tr>

        </form>
</table>
    </div>
    </div> 
    
</div>
    @endsection
