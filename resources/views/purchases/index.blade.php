@extends('layouts.app')

@section('content')

<div>                                
<div class="block block-condensed">

<div class="box">
                                <div class="box-header">

                                <div>
                                    <h3>Purchases List</h3>
                                    <br/>
                                </div>


                                <div class="pull-right">
                                    <a class="btn btn-primary" role="button" href="{{ route('add_purchase') }}">
                                    <span><i class="fa fa-fw fa-plus-square"></i> New</span></a>
                                </div>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                            <th>Supplier</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $purchases as $purchase )
                      <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->supplier_name }}</td>
                        <td>{{ $purchase->total_amount }}</td>
                        <td>{{ $purchase->date }}</td>
                        <td>{{ $purchase->status }}</td>
                        <td><a class="hollow button btn btn-primary btn-sm" href="{{ route('show_purchase', ['purchase_id' => $purchase->id ]) }}">
                        <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>       
                        </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection