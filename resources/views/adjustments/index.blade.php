@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">


<div class="box">
                                <div class="box-header">

                                <div>
                                    <h3>Adjustments List</h3>
                                    <br/>
                                </div>


                                <div class="pull-right">
                                    <a class="btn btn-primary" role="button" href="{{ route('new_adjustment') }}">
                                    <span><i class="fa fa-fw fa-plus-square"></i> New</span></a>
                                </div>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $adjustments as $adjustment )
                      <tr>
                        <td>{{ $adjustment->item_name }}</td>
                        <td>{{ $adjustment->date }}</td>
                        <td>{{ $adjustment->real_amount }}</td>
                        <td><a class="hollow button btn btn-primary btn-sm" href="{{ route('show_adjustment', ['adjustment_id' => $adjustment->id ]) }}">
                        <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>       
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection