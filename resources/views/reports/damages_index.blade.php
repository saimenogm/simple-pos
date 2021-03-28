@extends('layouts.app')

@section('content')

<div>                                
<div class="panel panel-primary">

                            <div class="panel panel-heading">
                                <div class="title">
                                    <h2>Damages List </h2>
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
                                                        <div class="input-group date">
                                                            <input type="date" class="form-control" name="end_date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
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
</form>
<div class='panel panel-body'>
<table id='example1' class="table table-bordered table-striped">
<thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Item Cost</th>
                                            <th>Reason</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>                                    
                                    <tbody>


      <?php
  }    
?>

<?php if(isset($damages)){
?>
               @foreach( $damages as $damage )
                      <tr>
                        <td>{{ $damage->item_name }}</td>
                        <td>{{ $damage->date }}</td>
                        <td>{{ $damage->amount }}</td>
                        <td>{{ $damage->unit_cost }}</td>
						<td>{{ $damage->reason }}</td>
						<td>{{ $damage->status }}</td>
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