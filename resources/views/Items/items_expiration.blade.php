@extends('layouts.app')

@section('content')

<div class='panel panel-primary'>                                

<div class="panel panel-heading">
                                <div>
                                    Items On Expire Worning
                                    <br/>
                                </div>
                            </div>
                            <form action="" method="post" name="">
                    @csrf
<div class='col-md-4'>
                                
                                <div class="form-group col">
                                            
                                            <label>Expire Date:</label>
                                                    <div class="input-group date">
                                                    <div class='input-group-addon'>
                                                    <i class="fa fa-calendar">                                                            
                                                               </i>
                                                               </div>
                                                            <input type="text" class="form-control" id="datepicker" name="start_date">
                                                            
                                                        </div>
                                                    </div>
                                                    

                                                    </div>

                                            <div class="pull-right">
                                            <br/>
                                            <button type='Submit' role='button' class='btn btn-info'> <i class='fa fa-fw fa-save'></i> Search </button>
                                            </div>
                                            
</form>
                                  
<div class='pandel panel-body'>
                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>item </th>
                                            <th>Quantity</th>
                                           <th>Expite Date</th>                                       
                                             </tr>
                                    </thead>                                    
                                    <tbody>
<?php if(isset($items)){?>
                 @foreach( $items as $item )
                      <tr>
                        <td>{{ $item->item}}
                        <td>{{ $item->item_name}}</td>
                        <td>{{ $item->qty }}</td>     
                        <td>{{ $item->expire_date }}</td>                        
                        
                    </tr>
                  @endforeach
<?php }else{
                
                }
                ?>
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                                                                   

@endsection