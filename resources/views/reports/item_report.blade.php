

<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>Items Report</h5>
                                </div>
                            </div>



                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Item Code</th>
                                            <th>Minimum Quality</th>
											<th>Unit Cost</th>
											<th>Unit Price</th>
											<th>Current Amount</th>
                                            
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                  @foreach( $items as $item )
                      <tr>
                        <td>{{ $item->item_name }}</td>
						<td>{{ $item->itme_code}}</td>
             		    <td>{{ $item->min_qty }}</td>
                        <td>{{ $item->unit_cost }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->current_amount }}</td>
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               
