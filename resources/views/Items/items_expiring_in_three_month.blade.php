@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div>
                                    <h3>Items On Expire Worning</h3>
                                    <br/>
                                </div>
                            </div>


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

                 @foreach( $items as $item )
                      <tr>
                        <td>{{ $item->item}}
                        <td>{{ $item->item_name}}</td>
                        <td>{{ $item->qty }}</td>     
                        <td>{{ $item->expire_date }}</td>                        
                        
                    </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection