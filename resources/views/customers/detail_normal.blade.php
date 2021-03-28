
@extends('layouts.app')

@section('content')


    <script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>

    <script>

        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        $("#vital_signs_but").click(function(e){

//alert('sigmen');
            console.log('shkdflsjd');
        })

    </script>

    <div class="col-md-8 col-sm-8">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Customer Details</h3>
            </div>
            <div class="panel-body">
                <div class="block-content">
                    <!-- purchuse section -->
                    <!-- BASIC SELECT -->


                    <div class="row">
                        <div class="col-md-10 col-sm-10">
                            <form role='form' action="{{ $modify == 1 ? route('update_customer', [ 'customer_id' => $customer_id ]) : route('create_customer') }}" method="post"  enctype="multipart/form-data">

                                <table class="table">
                                    @csrf
                                    <input id='customer_id' hidden=true value='{{ $customer_id }}'/>
                                    <tr><td>
                                            <label>Customer Name</label></td><td>
                                            <input name="customer_name" type="text" value="{{ old('customer_name') ? old('customer_name') : $customer_name }}" class="form-control" required>
                                            <small class="error">{{$errors->first('customer_name')}}</small>
                                        </td></tr>

                                    <tr><td> <label>Contact Person</label></td><td>
                                            <input name="contact_person" type="text" value="{{ old('contact_person') ? old('contact_person') : $contact_person }}" class="form-control">
                                            <small class="error">{{$errors->first('contact_person')}}</small>
                                        </td></tr>

                                    <tr><td>
                                            <label>Telephone(Mobile)</label></td><td>
                                            <input name="mobile" type="text" value="{{ old('mobile') ? old('mobile') : $mobile }}" class="form-control">
                                            <small class="error">{{$errors->first('mobile')}}</small>
                                        </td></tr>

                                    <tr><td>
                                            <label>Remark</label></td><td>
                                            <input name="remark" type="text" value="{{ old('remark') ? old('remark') : $remark }}" class="form-control">
                                            <small class="error">{{$errors->first('remark')}}</small>
                                        </td></tr>


                                    <tr>
                                        <td><label>Customer Balance</label></td>
                                        <td>
                                            <select class="form-control" name="balance_type">
                                                <option value="{{ old('balance_type') ? old('balance_type') : $balance_type }}">{{ old('balance_type') ? old('balance_type') : $balance_type }}</option>
                                                <option value="unpaid">Unpaid</option>
                                                <option value="overpaid">Overpaid</option>
                                            </select>
                                            <input type="text" class="form-control" name="balance_amount" value="{{ old('balance_amount') ? old('balance_amount') : $balance_amount }}" required />

                                        </td></tr>

                                    <tr>
                                        <td></td>
                                        <td><button type='Submit' role='button' class='btn btn-primary'>
                                                <i class='fa fa-fw fa-save'></i> Update </button>
                                        </td>
                                    </tr>

                                </table>
                        </div>

            </div>
        </div>
    </div>
@endsection
