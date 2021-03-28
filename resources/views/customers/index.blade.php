@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">


<div class="box">
                                <div class="box-header">

                                <div>
                                    <h3>Customers List</h3>
                                    <br/>
                                </div>


                                <div class="pull-right">
                                    <a class="btn btn-primary" role="button" href="{{ route('new_customer') }}">
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
                                            <th>Telephone/Mobile</th>
                                            <th>Open</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $customers as $customer )
                      <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->mobile }}</td>
                        <td><a class="hollow button btn btn-success btn-sm" href="{{ route('show_customer', ['customer_id' => $customer->id ]) }}">
                        <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>       
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection