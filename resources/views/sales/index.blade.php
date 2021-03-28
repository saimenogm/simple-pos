@extends('layouts.app')

@section('content')

<div>                                
<div class="block block-condensed">


                            <div class="box">
                                <div class="box-header">

                                <div>
                                    <h3>Sales List</h3>
                                    <br/>
                                </div>


                                <div class="pull-right">
                                    <a class="btn btn-primary" role="button" href="{{ route('create_normal_pos') }}">
                                    <span><i class="fa fa-fw fa-plus-square"></i> New</span></a>
                                </div>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">
                                                                <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Customer Name</th>
                                            <th>Date</th>
                                            <th>Total amount</th>
                                            <th>Status</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $sales as $sale )
                      <tr>
                       <td>{{ $sale->id }}</td>
                        <td>{{ $sale->customer_name }}</td>
                        <td>{{ $sale->date }}</td>
                        <td>{{ $sale->total_amount }}</td>
                        <td>{{ $sale->status }}</td>
                        <td><a class="hollow button btn btn-primary btn-sm" href="{{ route('show_sale', ['sales_id' => $sale->id ]) }}">
                        <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>       

                        </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection