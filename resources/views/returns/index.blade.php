@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>Returned List</h5>
                                </div>
                            </div>

                            
                            <div class="pull-right">
                                <a class="btn btn-info btn-sm" role="button" href="{{ route('new_return') }}"><span class="icon-plus"></span> New</a>
                            </div>

                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                             <th>Id</th>
                                            <th>Product</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $returns as $return )
                      <tr>
                      <td>{{ $return->id }}</td>
                        <td>{{ $return->item_name }}</td>
                        <td>{{ $return->date }}</td>
                        <td>{{ $return->amount }}</td>
                        <td><a class="hollow button" href="{{ route('show_return', ['return_id' =>  $return->id ]) }}"><span class="icon-pen"></span></a></td>       
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection