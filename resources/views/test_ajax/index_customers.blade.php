


        <!-- CSS INCLUDE -->        


<div>                                
<div>

                            <div>
                                <div>
                                    <h5 class="header">Customers List</h5>
                                </div>
                            </div>

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Mobile</th>
                                            <th>Telephone</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                  @foreach( $customers as $customer )
                      <tr>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->mobile }}</td>
                        <td>{{ $customer->address }}</td>
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>

</div>
