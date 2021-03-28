@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>locations List</h5>
                                </div>
                            </div>

                            <div class="pull-right">
                                <a class="btn btn-info btn-sm" role="button" href="{{ route('new_location') }}"><span class="icon-plus"></span> New</a>
                            </div>

                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>Location</th>
                                            <th>Address</th>
                                            <th>Description</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $locations as $location )
                      <tr>
                        <td>{{ $location->location_name }}</td>
                        <td>{{ $location->address }}</td>
                        <td>{{ $location->description }}</td>
                        <td><a class="hollow button" href="{{ route('show_location', ['location_id' => $location->id ]) }}"><span class="icon-pen"></span></a></td>       
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection