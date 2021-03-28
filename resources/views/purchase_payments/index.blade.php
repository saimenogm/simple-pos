@extends('layouts.app')

@section('content')
                 
<div>                                
<div class="block block-condensed">

                            <div class="app-heading app-heading-small">
                                <div class="title">
                                    <h5>payments List</h5>
                                </div>
                            </div>
                                <table class="table table-striped table-bordered datatable-extended">
                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                            <th>Supplier</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Cancel</th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                 @foreach( $payments as $payment )
                      <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->supplier_name }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->date }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>
						<a class="hollow button" href="{{ route('cancel_payment', ['payment_id' => $payment->id ]) }}"><span class="icon-pen"></span></a></td>       
                        
                      </tr>
                  @endforeach
                                                              
                                    </tbody>
                                </table>
                                
                            </div>
</div>                                               


@endsection