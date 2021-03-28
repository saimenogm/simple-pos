@extends('layouts.app')

@section('content')

<div>                                
<div class="panel panel-primary">

                            <div class="panel panel-heading">
                                <div class="title">
                                  Expenses List
                                </div>
                                </div>
                                <form action="" method="post" name="">
        @csrf

                                <label class="col-md-1 control-label">Date :</label>
                                <div class="row">
                                            <div class="col-md-3">
                                            From:
                                            
                                                    <div class="input-group date">
                                                            <input type="date" class="form-control"  name="start_date">
                                                            <div class="input-group-addon">
                                                                <i  class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                    To:
                                                        <div class="input-group date">
                                                            <input type="date" class="form-control"   name="end_date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>

                                            </div>

                                            <div class="col-md-2">
                                            Employee:

                                            <select class="form-control" name="user" id="user">
                                            <option value=""></option>

                                            @foreach($users as $user )
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                            </select>
                                            </div>
                                            <div class="col-md-2">
                                            <br/>
                                            <button type='Submit' role='button' class='btn btn-info'> <i class='fa fa-fw fa-save'></i> Search </button>
                                            </div>

                                            </div>
</form>
  <?php if(isset($start_date) && isset($end_date))
  {
      ?>
<form action="" method="post" name="">
@csrf
<input type='hidden' name='start_date' value='{{$start_date}}' />
<input type='hidden' name='end_date' value='{{$end_date}}' />
<input type='hidden' name='print' value='print' />
<button type='Submit' role='button' class='btn btn-info'> <i class='fa fa-fw fa-save'></i> Print </button>


<div class='panel panel-body'>

<table id='example1' class="table table-bordered table-striped">
<thead>
                                        <tr>
                                            <th>Expense Name</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>User</th>

                                        </tr>
                                    </thead>                                    
                                    <tbody>
      <?php
  }    
?>
                               

                            

                             
                                  


<?php if(isset($expenses)){
?>
               @foreach( $expenses as $expense )
                      <tr>
                        <td>{{ $expense->expense_name }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>{{ $expense->amount }}</td>
						<td>{{ $expense->name }}</td>
                        </tr>

                  @endforeach

  <?php
}else{

}
?>

                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection