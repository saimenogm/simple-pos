@extends('layouts.app')

@section('content')

    <div>
        <div class="panel panel-primary">

            <div class="panel panel-heading">
                <div class="title">
                    <h2>Receipts List </h2>
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
<button type='Submit' role='button' class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Print </button>

      <?php
  }    
?>
                                  </div>


                            <table class="table table-striped table-bordered datatable-extended">
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

 <?php if(isset($receipts)){
?>

                 @foreach( $receipts as $receipt )
                      <tr>
                        <td>{{ $receipt->customer_name }}</td>
                        <td>{{ $receipt->amount }}</td>
                        <td>{{ $receipt->date }}</td>
                        <td>{{ $receipt->type }}</td>
                        <td>{{ $receipt->activity }}</td>
                     
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