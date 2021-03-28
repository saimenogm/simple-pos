@extends('layouts.app')

@section('content')

<div>                                
<div class="panel panel-primary">

                            <div class="panel panel-heading">
                                <div class="title">
                                   Payments List
                                </div>
                                </div>
                                <form action="" method="post" name="">
        @csrf

                                <label class="col-md-2 control-label">Date :</label>
                                <div class="row">
                                            <div class="col-md-4">
                                                    <div class="input-group bs-datepicker">
                                                            <input type="date" class="form-control"  name="start_date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group bs-datepicker">
                                                            <input type="date" class="form-control" id="iv_date" name="end_date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>

                                            </div>

                                            <button type='Submit' role='button' class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Search </button>

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
<button type='Submit' role='button' class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Print </button>

<div class='panel panel-body'>
<table id='example1' class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Activity</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

      <?php
  }    
?>
                         
 <?php if(isset($payments)){
?>

                 @foreach( $payments as $payment )
                      <tr>
                        <td>{{ $payment->supplier_name }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->date }}</td>
                        <td>{{ $payment->type }}</td>
                        <td>{{ $payment->activity }}</td>
                     
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