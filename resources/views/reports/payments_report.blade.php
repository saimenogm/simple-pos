


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
                                    <strong>Cash Flow Report</strong>
                                </div>
                                <br/>

                                <div class="sub_header">
                                Cash Flow Report <br/>
                                From: {{ $start_date }} &nbsp; To: {{ $end_date }}
                                </div>
                                <br/>
                            </div>

                                <table id="t1" class="collapsed auto-layout stretched" >
                                    <thead>
                                        <tr>
                                        <th>S.N</th>
                                            <th>Customer/Supplier</th>
                                            <th>Date</th>
                                            <th>Ref #</th>
                                            <th>Amount</th>
                                            <th>Move</th>
                                            <th>Activity</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>
                   {{ $total_payment=0.00 }}
                   {{ $total_received=0.00 }}
                   <?php $style_class="odd"; 
$counter=0;
?>

                  @foreach( $payments as $payment )
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
                        <td>{{ $payment->customer_name }} </td>
    					<td>{{ $payment->date }} </td>
						<td>{{ $payment->ref }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->type }}</td>
                        <td>{{ $payment->activity }}</td>
                        {{$total_payment=$total_payment + $payment->amount}}
                      </tr>
                  @endforeach

                  <?php $total_payment = number_format($total_payment,2); ?>

                  <?php $counter=0; ?>

<tr><td></td><td></td><td></td><td><U><B>Total Cash Out:</B></U></td><td><U><B>{{$total_payment}}</B></U></td></tr>
                  @foreach( $receipts as $payment )
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
                        <td>{{ $payment->customer_name }} </td>
    					<td>{{ $payment->date }} </td>
						<td>{{ $payment->ref }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->type }}</td>
                        <td>{{ $payment->activity }}</td>
                        {{$total_received=$total_received + $payment->amount}}
                      </tr>
                  @endforeach
                  <tr><td></td><td></td><td></td><td><U><B>Total Cash In:</B></U></td><td><U><B>{{$total_received}}</B></U></td></tr>

                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               
