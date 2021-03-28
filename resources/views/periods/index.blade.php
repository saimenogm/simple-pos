@extends('layouts.app')

@section('content')

                            
<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>periods List</h5>
                                </div>
                            </div>

                            <div class="pull-right">
                                <a class="btn btn-primary btn-sm" role="button" href="{{ route('new_period') }}"><span class="icon-pencil5"></span> New</a>
                            </div>

                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>period Name</th>
                                            <th>Mobile</th>
                                            <th>Telephone</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $periods as $period )
                      <tr>
                        <td>{{ $period->period_name }} </td>
                        <td>{{ $period->start_date }}</td>
                        <td>{{ $period->end_date }}</td>
                        <td><a class="hollow button" href="{{ route('show_period', ['period_id' => $period->id ]) }}"><span class="icon-pen"></span></a></td>       
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection