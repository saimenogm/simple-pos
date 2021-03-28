@extends('layouts.app')

@section('content')
                 
<div>                                



<div class="box">
                                <div class="box-header">

                                <div>
                                    <h3>Damages List</h3>
                                    <br/>
                                </div>


                                <div class="pull-right">
                                    <a class="btn btn-primary" role="button" href="{{ route('new_damage') }}">
                                    <span><i class="fa fa-fw fa-plus-square"></i> New</span></a>
                                </div>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $damages as $damage )
                      <tr>
                      <td>{{ $damage->id }}</td>
                        <td>{{ $damage->item_name }}</td>
                        <td>{{ $damage->date }}</td>
                        <td>{{ $damage->amount }}</td>
                        <td>{{ $damage->status }}</td>
                        <td><a class="hollow button btn btn-primary btn-sm" href="{{ route('show_damage', ['damage_id' => $damage->id ]) }}">
                        <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>       
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection