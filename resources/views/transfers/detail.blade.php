

@extends('layouts.app')

@section('content')

<div class="container">

<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                        
                            
                                <div class="app-heading app-heading-small">                                
                                    <div class="title">
                                        <h2>Transfer Detail</h2>
                                       <br/>
                                       <div class="form-group">
                                            <label class="col-md-3 control-label">Source: </label>
                                            
                                            <label class='col-md-3 control-label'>{{$transfers->source_location}}</label>
                                                           
                                                 
                                    </div> 
                                    <div class="form-group">
                                            <label class="col-md-3 control-label">Destination:  </label>
                                            
                                            <label class='col-md-3 control-label'>{{$transfers->destination_location}}</label>
                                                           
                                                 
                                    </div>  

                                    <div class="form-group">
                                            <label class="col-md-3 control-label">Date: </label>
                                            
                                            <label class='col-md-3 control-label'>{{$transfers->date}}</label>
                                                           
                                                 
                                    </div>  
                                    
                                       
                                     
                                    </div>                                
                                </div>

                            </div>


       </div>                        
                                                                          
                                    <table class="table" id="POITable" onclick="calculate()">
                                            <thead class="thead-inverse">
                                              <tr>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Barcode </th>


                                              </tr>
                                            </thead>
                                    <tbody> 
                                        {{-- do not touch this first <tr> element is it just a template  --}}
                                        @foreach( $transfer_items as $transfer_item )
                      <tr>
                        <td>{{ $transfer_item->item_name }}</td>
                        <td>{{ $transfer_item->amount }}</td>
                        <td>{{  $transfer_item->barcode }}</td>

                        </tr>
                  @endforeach


                                    </tbody>  
                                    
                                    </TABLE>

    <form class="form-horizontal" name="transfer_form" id="transfer_form" action="{{route('del_transfer')}}" method="post">
        @csrf
<input type="hidden" value="{{$transfer_id}}" name="transfer_id"/>
        <input value="Cancel Transfer" class="btn btn-danger" type="submit">

    </form>
                                
                            </div>


                            </div>
                            <div>
                            <br/>
                            <br/>

                        </div>
                     </div>
                            
                    </div>

               </div>


@endsection

