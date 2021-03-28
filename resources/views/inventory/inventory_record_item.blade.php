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
                                            <th>Date</th>
                                            <th>Activity</th>
                                            <th>Unit Cost</th>
                                            <th>Previous Cost</th>
                                            <th>Received Amt</th>
                                            <th>Sold Amt</th>
                                            <th>Qty at hand (Balance)</th>
                                            <th>Employee</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $items as $item )
                      <tr>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->activity }}</td>
                        <td>{{ $item->unit_cost }}</td>
                        <td>{{ $item->previous_cost }}</td>
                        <td>{{ $item->units_received }}</td>
                        <td>{{ $item->units_sold }}</td>
                        <td>{{ $item->qty_on_hand }}</td>
                        <td> Simon O. Mana</td>

                        </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection