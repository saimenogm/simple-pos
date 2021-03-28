@extends('layouts.app')

@section('content')

<div>
<div class="block block-condensed">

<div class="box">
                                <div class="box-header">

                                <div>
                                    <h5>paymentsjfhadjk List</h5>
                                </div>
                            </div>


                            <div class="pull-right">
                                    <a class="btn btn-primary" role="button" href="{{ route('new_receiptSales') }}">
                                    <span><i class="fa fa-fw fa-plus-square"></i> New</span></a>
                                </div>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                 @foreach( $payments as $payment )
                      <tr>
                      <td>{{ $payment->id }}</td>
                        <td>{{ $payment->supplier}}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->date }}</td>

                      </tr>
                  @endforeach

                                    </tbody>
                                </table>

                            </div>
</div>

@endsection