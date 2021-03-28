@extends('layouts.app')

@section('content')

<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>Inventory Record</h5>
                                </div>
                            </div>

                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Barcode</th>
                                            <th>Expire Date</th>
                                            <th>Qty at hand (Balance)</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $items as $item )
                      <tr>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->barcode }}</td>
                        <td>{{ $item->expire_date }}</td>
                        <td>{{ $item->current_qty }}</td>
                        </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection