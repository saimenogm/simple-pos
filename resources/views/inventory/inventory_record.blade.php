@extends('layouts.app')

@section('content')

<div class='panel panel-primary'>            
<div class="panel panel-heading">

<div>
    Inventory Record
    
</div>
</div>
<div class="row">
<form action="" method="post" name="">
                  
@csrf

              
              
<div class="form-group col-md-2">
                    <label>Start Date:</label>

                    <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" name="start_date" >
                    </div>
              </div>
   
                
         


              <div class="form-group col-md-2">
                    <label>End Date:</label>

                    <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" name="end_date" >
                    </div>
             
</div>

<div class="form-group col-md-3">
                <label>Date range button:</label>

                <div class="input-group">
                  <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                    <span>October 1, 2019 - October 31, 2019</span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
              </div>            
                    <div class="col-md-2">  
                    <label>Owner</label>
                                                                                  
                   <select class="form-control" id="owner" name="owner" >  
                              <option></option>  
                              <option value="Saleh">Saleh</option>
                              <option value="Mensur">Mensur</option>
                              <option value="Both">Both</option>
                           </select>
                          </div>
                 


                                                    <div class="col-md-2">
                                                    <br>
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

      <?php
  }    
?>
                                          


                                <!-- /.box-header -->
                                <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">
        
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Item</th>
                                            <th>Date</th>
                                            <th>Activity</th>
                                            <th>Previous Cost</th>
                                            <th>New Unit Cost</th>
                                            <th>Previous Qty</th>
                                            <th>Received Qty</th>
                                            <th>Out Qty</th>
                                            <th>Qty at hand (Balance)</th>
                                            <th>Owner</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $items as $item )
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->activity }}</td>
                        <td>{{ $item->previous_cost }}</td>
                        <td>{{ $item->unit_cost }}</td>
                        <td>{{ $item->qty_previous }}</td>
                        <td>{{ $item->units_received }}</td>
                        <td>{{ $item->units_sold }}</td>
                        <td>{{ $item->qty_on_hand }}</td>
                        <td>{{ $item->owner}}</td>
                        </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                  
@endsection