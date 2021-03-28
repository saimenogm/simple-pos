@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="panel panel-primary">

                            <div class="panel panel-heading">
                                <div class="title">
                                    Categories List
                                </div>
                            </div>

                            <div class="pull-right">
                                <a class="btn btn-info btn-sm" role="button" href="{{ route('new_itemCategory') }}"><span class="icon-plus"></span> New</a>
                            </div>

                            <table id='example1' class="table table-bordered table-striped">
                                     <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $itemCategorys as $itemCategory )
                      <tr>
                        <td>{{ $itemCategory->category_name }}</td>
                        <td>{{ $itemCategory->itemCategory_code }}</td>
                        <td>{{ $itemCategory->description }}</td>
                        <td><a class="hollow button" href="{{ route('show_itemCategory', ['itemCategory_id' => $itemCategory->id ]) }}"><i class="fa fa-edit"> Edit </i></a></td>       

                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection