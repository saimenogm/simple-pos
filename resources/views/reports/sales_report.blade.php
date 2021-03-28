


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
                                    <strong>Sales Report</strong>
                                </div>
                                <br/>

                                <div class="sub_header">
                                Sales Report <br/>
                                From: {{ $start_date }} &nbsp; To: {{ $end_date }}
                                </div>
                                <br/>
                            </div>

                                <table id="t1" class="collapsed auto-layout stretched" >
                                    <thead>
                                        <tr>
                                        <th>S.N</th>
                                            <th>Customer Name Mera</th>
                                            <th>Date</th>
                                            <th>Reference</th>
                                            <th>Total Amount</th>
                                            <th>Amount Paid</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>
                   {{ $total=0 }}
                   {{ $total_payed=0 }}
                   <?php $style_class="odd"; 
$counter=0;
?>

                  @foreach( $sales as $sale )
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
                        <td>{{ $sale->customer_name }} </td>
    					<td>{{ $sale->date }} </td>
						<td>{{ $sale->ref }}</td>
                        <td>{{ $sale->total_amount }}</td>
                        <td>{{ $sale->amount_paid }}</td>
                        <td>{{ $sale->status }}</td>
                          {{ $total=$total+ $sale->total_amount }}
                          {{ $total_payed=$total_payed+ $sale->amount_paid }}
                      </tr>
                  @endforeach
                  <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><strong><U>Total</U></strong></td>
                          <td><strong><U>{{ $total }}</U></strong></td>
                          <td><strong><U>{{ $total_payed }}</U></strong></td>
                      </tr>
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               
