@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div>
                                    <h3>Company List</h3>
                                    <br/>
                                </div>
                            
                            <div class="pull-right">
                                <a class="btn btn-info btn-sm" role="button" href="{{ route('new_company') }}"><span class="icon-plus"></span> New</a>
                            </div>

                            </div>


                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Company Name</th>
                                            <th>Company Code</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $companys as $company )
                      <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->company_name }}</td>
                        <td>{{ $company->company_code }}</td>
                        <td><a class="hollow button" href="{{ route('show_company', ['company_id' => $company->id ]) }}"><span class="icon-pencil5"></span></a></td>       
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection