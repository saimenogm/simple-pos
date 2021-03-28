@extends('layouts.app')

@section('content')

                            
<div>                                
<div class="block block-condensed">

<div class="box">
                                <div class="box-header">

                                <div>
                                    <h3>Suppliers List</h3>
                                    <br/>
                                </div>


                                <div class="pull-right">
                                    <a class="btn btn-primary" role="button" href="{{ route('new_supplier') }}">
                                    <span><i class="fa fa-fw fa-plus-square"></i> New</span></a>
                                </div>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>supplier Name</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Telephone</th>
                                            <th>Open</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $suppliers as $supplier )
                      <tr>
                      <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->supplier_name }} </td>
                        <td>{{ $supplier->mobile }}</td>
                          <td>{{ $supplier->address }}</td>
                        <td>{{ $supplier->telephone }}</td>

                        <td><a class="hollow button btn btn-primary btn-sm" href="{{ route('show_supplier', ['supplier_id' => $supplier->id ]) }}">
                        <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>       


                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection