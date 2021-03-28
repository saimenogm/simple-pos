
@extends('layouts.app')

@section('content')


<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">

                        <div class="box-header">

                            <div>
                                <h2>Regular Patients</h2>
                                <br/>
                            </div>


                            <div class="pull-right">
                                <a class="btn btn-primary" role="button" href="{{ route('new_customer') }}">
                                    <span><i class="fa fa-fw fa-plus-square"></i> New</span></a>
                            </div>

                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                    <tr>
                                            <th>Id</th>
                                            <th>Customer Name</th>
                                            <th>Age</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Open</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                 @foreach( $customers as $customer )
                      <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->age }}</td>
                          <td>{{ $customer->mobile }}</td>
                        <td>{{ $customer->city }}</td>
                          <td><a class="hollow button btn btn-success btn-sm" href="{{ route('show_customer', ['customer_id' => $customer->id ]) }}">
                                  <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>
                      </tr>
                  @endforeach

                                    </tbody>                                </table>
                            </div>

                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>

            @endsection
