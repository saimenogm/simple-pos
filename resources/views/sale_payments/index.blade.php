@extends('layouts.app')

@section('content')

    <div>
        <div class="block block-condensed">


            <div class="box">
                <div class="box-header">

                    <div>
                        <h3>Payments List</h3>
                        <br/>
                    </div>


                    <div class="pull-right">
                        <a class="btn btn-primary" role="button" href="{{ route('new_paymentPOS') }}">
                            <span><i class="fa fa-fw fa-plus-square"></i> New Payment</span></a>
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="example1" class="table table-bordered table-striped">

                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                            <th>Supplier</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Show</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $payments as $payment )
                      <tr>
                       <td>{{ $payment->id }}</td>
                        <td>{{ $payment->supplier_name }}</td>
                          <td>{{ $payment->date }}</td>
                        <td>{{ $payment->amount }}</td>
                          <td><a class="hollow button btn btn-primary btn-sm" href="{{ route('show_payment', ['payment_id' => $payment->id ]) }}">
                                  <i class="fa fa-fw fa-folder-open-o"></i> Open</a></td>

                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               

@endsection