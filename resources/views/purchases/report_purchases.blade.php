@extends('layouts.app')

@section('content')

<div>                                
<div class="panel panel-primary">

                            <div class="panel panel-heading">
                                <div class="title">
                                    Purchases Report 
                                </div>
                                </div>
                                <form action="" method="post" name="">
        @csrf

                                <label class="col-md-1 control-label">Date :</label>
                                <div class="row">
                                            <div class="col-md-2">
                                            From:
                                                    <div class="input-group date">
                                                            <input type="date" class="form-control" name="start_date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                    To:
                                                        <div class="input-group bs-datepicker">
                                                            <input type="date" class="form-control" name="end_date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>

                                            </div>
                                            <div class="col-md-2">
                                            Owner:
                                                    <select class="form-control" id="owner" name="owner" >  
                                                            <option></option>  
                                                            <option value="Saleh">Saleh</option>
                                                            <option value="Mensur">Mensur</option>
                                                            <option value="Both">Both</option>
                                                            </select>
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
                                            <th>Supplier Name</th>
                                            <th>Date</th>
                                            <th>Total Amount</th>
                                            <th>Amount Paid</th>
                                            <th>Status</th>
                                            <th>Ref</th>
                                            <th>User</th>

                                        </tr>
                                    </thead>                                    
                                    <tbody>

      <?php
  }    
?>
                                

                            

                               

<?php if(isset($purchases)){
?>
               @foreach( $purchases as $purchase )
                      <tr>
                        <td>{{ $purchase->supplier_name }}</td>
                        <td>{{ $purchase->date }}</td>
                        <td>{{ $purchase->total_amount }}</td>
                        <td>{{ $purchase->amount_paid }}</td>
						<td>{{ $purchase->status }}</td>
						<td>{{ $purchase->ref }}</td>
						<td>{{ $purchase->name }}</td>
						
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