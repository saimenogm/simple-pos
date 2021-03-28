@extends('layouts.app')

@section('content')

<div>                                


<div class="box">
                                <div class="box-header">

                                <div>
                                    <h3>Transfers List</h3>
                                    <br/>
                                </div>


                                <div class="pull-right">
                                    <a class="btn btn-primary" role="button" href="{{ route('new_transfer') }}">
                                    <span><i class="fa fa-fw fa-plus-square"></i> New</span></a>
                                </div>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Date</th>
                                            <th>Source</th>
                                            <th>Destination</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $transfers as $transfer )
                      <tr>
                        <td>{{ $transfer->id }}</td>
                        <td>{{ $transfer->date }}</td>
                        <td>{{ $transfer->source_location }}</td>
                        <td>{{ $transfer->destination_location }}</td>
                        <td><a class="hollow button btn btn-primary btn-sm" href="{{ route('show_transfer', ['$transfer_id' => $transfer->transfer_id ]) }}">
                        <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>       
                        </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection