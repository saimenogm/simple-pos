
@extends('layouts.app')

@section('content')


<div>
<div class="block block-condensed">


<div class="panel panel-primary">
                                <div class="panel panel-heading">

                                  Expenses List
                                    <br/>
                                </div>
    <div>

        <div class="pull-right">
            <a class="btn btn-primary" role="button" href="{{ route('new_expense') }}"> New Expense</a>
        </div>



    </div>
                            

                            <div class="panel panel-body">
                                <table id='example1' class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Expense Name</th>
                                            <th>Mobile</th>
                                            <th>Telephone</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $expenses as $expense )
                      <tr>
                        <td>{{ $expense->id }}</td>
                        <td>{{ $expense->expense_name }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>{{ $expense->amount }}</td>
                          <td><a class="hollow button btn btn-success btn-sm" href="{{ route('show_expense', ['expense_id' => $expense->id ]) }}">
                                  <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>

                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection