@extends('layouts.app')

@section('content')

<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>purchases List</h5>
                                </div>
                            </div>

                            <div class="pull-right">
                                <a class="btn btn-primary btn-sm" role="button" href="{{ route('add_purchase') }}"><span class="icon-pencil5"></span> New</a>
                            </div>

                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>Supplier</th>
                                            <th>ref</th>
                                            <th>amount</th>
                                            <th>date</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $purchases as $purchase )
                      <tr>
                        <td>{{ $purchase->supplier }}</td>
                        <td>{{ $purchase->ref }}</td>
                        <td>{{ $purchase->amount }}</td>
                        <td>{{ $purchase->date }}</td>
                        </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection