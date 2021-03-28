@extends('layouts.app')

@section('content')

<div>                                
<div class="panel panel-primary">

                            <div class="panel panel-heading">
                                <div class="title">
                                    <h2>Cash Flow List </h2>
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
                                            <th>S.N.</th>
                                            <th>Date</th>
                                            <th>In</th>
                                            <th>Out</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>


      <?php
  }    
?>
                                  

                            

                               

<?php if(isset($cost_profits)){
?>
               @foreach( $cost_profits as $cost_profit )
                      <tr>
                        <td>{{ $cost_profit->id }}</td>
                        <td>{{ $cost_profit->item_cost }}</td>
                        <td>{{ $cost_profit->item_selling_price }}</td>
						<td>{{ $cost_profit->profit }}</td>
						<td>{{ $cost_profit->date }}</td>
						<td>{{ $cost_profit->status }}</td>
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