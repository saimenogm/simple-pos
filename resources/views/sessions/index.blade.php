@extends('layouts.app')

@section('content')

<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>Session</h5>
                                </div>
                            </div>

  
                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                            <th>Beginning Balance</th>
                                            
                                            <th>Ending Balance</th>
                                            <th>User</th>
                                            <th>detail</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $sessions as $session )
                      <tr>
                        <td>{{ $session->id }}</td>
                        <td>{{ $session->beginning_bal }}</td>
                        <td>{{ $session->ending_bal }}</td>
                        <td>{{ $session->name }}</td>
                        <td><a class="hollow button" href="{{ route('show_sessions', ['session_id' => $session->id ]) }}"><span class="icon-pencil5"></span></a></td>
                        </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection