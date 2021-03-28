@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>accounts List</h5>
                                </div>
                            </div>


                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>account Name</th>
                                            <th>account Code</th>
                                            <th>account Type</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $accounts as $account )
                      <tr>
                        <td>{{ $account->account_name }}</td>
                        <td>{{ $account->account_code }}</td>
                        <td>{{ $account->type }}</td>
                        <td>{{ $account->description }}</td>   
                        <td><a class="hollow button" href="{{ route('show_account', ['account_id' => $account->id ]) }}"><span class="icon-pen"></span></a></td>       
                     
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection