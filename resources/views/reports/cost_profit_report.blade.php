


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
                                    <strong>Profit Loss Report</strong>
                                </div>
                                <br/>

                                <div class="sub_header">
                                Profit Loss Report <br/>
                                From: {{ $start_date }} &nbsp; To: {{ $end_date }}
                                </div>
                                <br/>
                            </div>

                                <table id="t1" class="collapsed auto-layout stretched" >
                                    <thead>
                                        <tr>
                                        <th>S.N</th>
                                            <th>Item</th>
                                            <th>Item Cost</th>
                                            <th>Item Selling Price</th>
                                            <th>Profit</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>
                  {{ $item_cost=0 }}
                   {{ $item_selling_price=0 }}
                   {{ $total=0 }}
                   <?php $style_class="odd"; 
				   
				    
$counter=0;
?>

                  @foreach( $cost_profits as $cost_profit )
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
                        <td>{{ $cost_profit->item_name }} </td>
    					<td>{{ $cost_profit->item_cost }} </td>
						<td>{{ $cost_profit->item_selling_price }}</td>
                        <td>{{ $cost_profit->profit }}</td>
                        <td>{{ $cost_profit->date }}</td>
                        <td>{{ $cost_profit->status }}</td>
                     
                          {{ $item_cost=$item_cost+ $cost_profit->item_cost }}
                          {{ $item_selling_price=$item_selling_price+ $cost_profit->item_selling_price }}
                      </tr>
                  @endforeach
                  
                  <tr>
                          <td></td>
                          <td><strong><U>Total</U></strong></td	>                        
                          <td><strong><U>{{$item_cost}}</U></strong></td>
                          <td><strong><U>{{ $item_selling_price}}</U></strong></td>	  
						  <td><strong><U>{{ $item_selling_price-$item_cost}}</U></strong></td>
						  <td></td>
                      </tr>
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               
