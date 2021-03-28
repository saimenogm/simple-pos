@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>journals List</h5>
                                </div>
                            </div>


                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>Partner</th>
                                            <th>date</th>
                                            <th>debit</th>
                                            <th>credit</th>
                                            <th>ref</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $journals as $journal )
                      <tr>
                        <td>{{ $journal->first_name }} {{ $journal->middle_name }}</td>
                        <td>{{ $journal->date }}</td>
                        <td>{{ $journal->total_debit }}</td>
                        <td>{{ $journal->total_credit }}</td>                        
                        <td>{{ $journal->ref }}</td>                        
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection