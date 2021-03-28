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
                                            <th>Account</th>
                                            <th>date</th>
                                            <th>debit</th>
                                            <th>credit</th>
                                            <th>ref</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $journal_items as $journal_item )
                      <tr>
                        <td>{{ $journal_item->account_name }}</td>
                        <td>{{ $journal_item->date }}</td>
                        <td>{{ $journal_item->total_debit }}</td>
                        <td>{{ $journal_item->total_credit }}</td>                        
                        <td>{{ $journal_item->journal_id }}</td>                        
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection