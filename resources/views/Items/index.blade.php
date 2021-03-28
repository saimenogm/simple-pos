@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">


<div class="box">
                                <div class="box-header">

                                <div>
                                    <h3>Items List</h3>
                                    <br/>
                                </div>


                                <div class="pull-right">
                                    <a class="btn btn-primary" role="button" href="{{ route('new_item') }}">
                                    <span><i class="fa fa-fw fa-plus-square"></i> New Item</span></a>
                                </div>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">

                               <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>item Name</th>
                                            <th>Item Code</th>
                                            <th>Item Cost</th>
                                            <th>Item Price</th>
                                            <th>Current Qty</th>
                                            <th>Inventory Valuation</th>
                                            <th>Item Order</th>
                                            <th>Owner</th>
                                            <th>Variants</th>
                                            <th>Open</th>
                                            <th>History</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $items as $item )
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->item_code }}</td>
                        <td>{{ $item->unit_cost }}</td>
                        <td>{{ $item->unit_price }}</td>                        
                        <td>{{ $item->current_amount }}</td>
                        <td>{{ $item->total_valuation }}</td>
                          <td>{{ $item->item_order }}</td>
                          <td>{{ $item->owner }}</td>
                          <td>{{ $item->variants }}</td>

                        <td><a class="hollow button btn btn-primary btn-sm" href="{{ route('show_item', ['item_id' => $item->id ]) }}">
                        <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>       
              
                        <td><a class="hollow button btn btn-success btn-sm" href="{{ route('inventory_record_item', ['item_id' => $item->id ]) }}">
                        <i class="fa fa-fw fa-book"></i> History</a></td>       
                      
                    </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection