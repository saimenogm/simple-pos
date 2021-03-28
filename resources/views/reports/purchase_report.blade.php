


        <style>
.header{
    font-weight:bolder;
    font-weight:900; 
    color:black;
    font: 28px;
    width:260px; left:0; margin-left:auto; right:0; margin-right:auto;
}

.sub_header{
    text-align:center;
    font-weight:bolder;
    width:300px; left:0; margin-left:auto; right:0; margin-right:auto;
}
#ts td { background:white; } /* Background of all cells */
#t1 .odd td { background:#ddd; } /* Alternating Row Background */
#t1 td.c3 { background:darkgreen; color:white; } /* Column Background */
#t1 .odd { background:#eee; }
#t1 {cell-padding:0px; cellspacing:0px;}

.collapsed { border-collapse:collapse; }

.auto-layout { table-layout:auto; }
.stretched { width:100%; }

</style>


<div>                                

<div>
                                <div class="header">
                                    <strong>Purchases Report</strong>
                                </div>
                                <br/>

                                <div class="sub_header">
                                Purchases Report <br/>
                                From: {{ $start_date }} &nbsp; To: {{ $end_date }}
                                </div>
                                <br/>
                            </div>

                                <table id="t1" class="collapsed auto-layout stretched" >
                                    <thead>
                                        <tr>
										<th>S.N</th>
                                        <th>Supplier Name</th>
                                            <th>Date</th>
                                            <th>Total Amount</th>
                                            <th>Amount Paid</th>
                                            <th>Status</th>
                                            <th>Ref</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>
                  {{ $total_amount=0 }}
                   {{ $total_paid=0 }}
                   {{ $total=0 }}
                   <?php $style_class="odd"; 
				   
				    
$counter=0;
?>

                  @foreach( $purchases as $purchase )
                  <tr class="<?php
                      $counter++;
                      if($style_class=="odd")
                      {
                        echo $style_class;
                        $style_class="even";
                      }else{
                        echo $style_class;
                        $style_class="odd";
                      }
 ?>">
                         <td>{{$counter}}</td>
                       <td>{{ $purchase->supplier_name }}</td>
                        <td>{{ $purchase->date }}</td>
                        <td>{{ $purchase->total_amount }}</td>
                        <td>{{ $purchase->amount_paid }}</td>
						<td>{{ $purchase->status }}</td>
						<td>{{ $purchase->ref }}</td>
						<td>{{ $purchase->name }}</td>
                     
                          {{ $total_amount=$total_amount+  $purchase->total_amount}}
                          {{ $total_paid=$total_paid+ $purchase->amount_paid  }}
                      </tr>
                  @endforeach

                  <tr>
                      <td></td><td></td><td></td><td></td><td></td><td></td>
                  </tr>
                  <tr>
                          <td></td>
                          <td></td>
                          <td><strong><U>Total</U></strong></td	>
                          <td><strong><U>{{$total_amount}}</U></strong></td>
                          <td><strong><U>{{ $total_paid}}</U></strong></td>	  
						  <td><strong><U>{{ $total_amount-$total_paid}}</U></strong></td>
						  <td></td>
                      </tr>
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               
