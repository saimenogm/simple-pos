


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
                                    <strong>Receipts Report</strong>
                                </div>
                                <br/>

                                <div class="sub_header">
                                    Receipts Report <br/>
                                From: {{ $start_date }} &nbsp; To: {{ $end_date }}
                                </div>
                                <br/>
                            </div>

                                <table id="t1" class="collapsed auto-layout stretched" >
                                    <thead>
                                        <tr>
                                        <th>S.N</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>
                  
                   <?php $style_class="odd"; 
$counter=0;
$total=0.00;
?>

                  @foreach( $receipts as $receipt )
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
    					<td>{{ $receipt->date }} </td>
						<td>{{ $receipt->amount }}</td>
                        <?php $total=$total+$receipt->amount; ?>
                        <td>{{ $receipt->id }}</td>
                      </tr>
                  @endforeach
                  <tr>
                  <td></td>
                  <td><u><b>Total</b></u></td>
                  <td><u><b> {{ $total }} </b></u></td>
                  </tr>
                  
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               
