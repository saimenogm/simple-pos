

@extends('layouts.app')

@section('content')

<div class="container">

<div class="panel panel-primary">
                                                
                            
                                <div class="panel-heading">                                
                                    <div class="title">
                                    Receipt Detail  

                                    </div>      
                                                            
                                </div>
                                      <div class='panel panel-body'>

                   @csrf
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Customer : </label>

                                        <label class="col-md-2 control-label"> {{$receipts->customer_name}}</label>
                                    
                                    </div>
                                          <br/>
                                    
                                    <div class="form-group">
                                            <label class="col-md-2 control-label">Date :</label>
                                            <div class="col-md-4">
                                                    <div class="input-group bs-datepicker">
                                                           <label class="col-md-2 control-label">{{$date}}</label>
                                                        </div>
                                            </div>
                                    </div>
                                          <br/>

                             <div class="form-group">
                                    <label class="col-md-2 control-label">Ref No :</label>
                                    <div class="col-md-4">
                                    <label class="col-md-2 control-label">{{$receipts->ref}}</label>
                                          </div>
                            </div>

                                          <br/>

                            <div class="form-group">
                                    <label class="col-md-2 control-label">Remark :</label>
                                    <div class="col-md-4">
                                    <label class="col-md-2 control-label">{{$remark}}</label>
                                    </div>
                            </div>
                                          <br/>

                                    <table class="table table-striped table-bordered" id="POITable" onclick="calculate()">
                                            <thead class="thead-inverse">
                                              <tr>
                                                <th>Sale Id</th>
                                                <th>Invoice Amount</th>
                                                <th>Previous <br/>Unpaid Amount</th>
                                                <th>Amount Received</th>
                                                <th>Current  <br/>Unpaid Amount</th>
                                                  <th>View Sale</th>
                                              </tr>
                                            </thead>
                                    <tbody> 
                                        {{-- do not touch this first <tr> element is it just a template  --}}
              @foreach( $receipt_items as $receipt_item )
              
                      <tr>
                        <td>{{ $receipt_item->sales_id }}
                        </td>
                        <td>{{ $receipt_item->total_amount }}</td>
                        <td>{{ $receipt_item->total_amount - $receipt_item->amount_paid + $receipt_item->amount}}</td>
                        <td>{{ $receipt_item->amount }}</td>
                        <td>{{ $receipt_item->total_amount - $receipt_item->amount_paid }}</td>
                      <td>    <a class="hollow button btn btn-success btn-sm" href="{{ route('show_sale', ['sales_id' => $receipt_item->sales_id ]) }}">
                              <i class="fa fa-fw fa-folder-open-o"></i> View Sale</a>
                      </td>
                      </tr>

                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td><b>Total Received</b></td>
                                            <td><b><u>{{$receipts->amount}}</u></b></td>
                                        </tr>
                                    </tbody>  
                                    
                                    </TABLE>
                                            
                                    <br/>
                            <br/>
    <table class="table">


    </table>
                        </div>
                     </div>
                            
                    </div>

               </div>


@endsection

