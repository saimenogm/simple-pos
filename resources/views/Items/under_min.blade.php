@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div>
                                    <h3>Items Under Minimum Quantity Threshold </h3>
                                    <br/>
                                </div>
                            </div>


                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Item </th>
                                            <th>Minimum Threshold</th>
                                            <th>Quantity</th>                                      
                                             </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $under_min_items as $item )
                      <tr>
                        <td>{{ $item->id}}
                        <td>{{ $item->item_name}}</td> 
                        <td>{{ $item->min_qty}}</td>                          
                        <td>{{ $item->current_amount }}</td>                        
                        
                    </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection