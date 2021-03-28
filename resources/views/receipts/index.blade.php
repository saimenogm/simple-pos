@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">

<div class="box">
                                <div class="box-header">

                                <div>
                                    <h3>Receipts List</h3>
                                    <br/>
                                </div>


                                <div class="pull-right">
                                    <a class="btn btn-primary" role="button" href="{{ route('new_receiptSales') }}">
                                    <span><i class="fa fa-fw fa-plus-square"></i> New</span></a>
                                </div>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Date</th>
											<th>Detail</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $receipts as $receipt )
                      <tr>
                      <td>{{ $receipt->id }}</td>
                        <td>{{ $receipt->customer_name}}</td>
                        <td>{{ $receipt->amount }}</td>
                        <td>{{ $receipt->date }}</td>
                       
                         <td><a class="hollow button btn btn-primary btn-sm" href="{{ route('show_reciept', ['receipt_id' => $receipt->id ]) }}">
                        <i class="fa fa-fw fa-folder-open-o"></i> Edit</a></td>       

                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection