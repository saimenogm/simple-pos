

@extends('layouts.app')

@section('content')

<div class="container">

<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                        
                            
                                <div class="app-heading app-heading-small">                                
                                    <div class="title">
                                        <h2>Return Detail  </h2>
                                        <p>Return</p>
                                    </div>                                
                                </div>


                   @csrf
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Product : </label>
                                        <div class="col-md-4">
                                        <input type="text" class="form-control" name="customer" id="customer" disabled value="{{$returns->item_name}}" disabled/>
                                   
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                            <label class="col-md-2 control-label">Amount :</label>
                                            <div class="col-md-4">
                                        <input type="text" class="form-control" name="ref" id="ref" disabled value="{{$returns->amount}}" disabled/>
                                    </div>
                                    </div>  
                             
                             <div class="form-group">
                                    <label class="col-md-2 control-label">Barcode :</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="ref" id="ref" disabled value="{{$returns->barcode_main}}" disabled/>
                                    </div>
                            </div>   
                             

                            <div class="form-group">
                                    <label class="col-md-2 control-label">Date :</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="ref" id="ref" disabled value="{{$returns->date}}" disabled/>
                                    </div>
                            </div>   
                            <div class="form-group">
                                    <label class="col-md-2 control-label">reason :</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="ref" id="ref" disabled value="{{$returns->reason}}"  disabled/>
                                    </div>
                            </div>   

@endsection

