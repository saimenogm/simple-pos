
@extends('layouts.app')
<link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
@section('content')


                    
                                                                    

 <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$items}}</h3>

              <p>Items</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
              <a href="{{ route('item_index') }}"  class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$customers}}</h3>

              <p>Customers</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>4</h3>

              <p>Regular Patients</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>20</h3>

              <p>Expiring Packages Medicines</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

<div class="home-content" style="margin-left:1%; margin-right:5%;">

<a href="{{ route('create_pos_sale') }}">

                                   <div  class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/btn-pos.svg')}}" width=70 height=30 class="" />
                                      
                                      <div style="margin-top:10%;text-align:center;">
                                          POS
                                      </div>
                                   </div>
</a>  


<a href="{{ route('sales_index') }}">
                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/btn-invoice.svg')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Sales
                                      </div>
                                   </div>
</a>


<a href="{{ route('add_purchase') }}">
                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/purchase_2.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          New Purchase
                                      </div>
                                   </div>
</a>


<a href="{{ route('item_index') }}">

<div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/product.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Products
                                      </div>
                                   </div>
</a>

<a href="{{ route('item_indexCategory') }}">

                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/product_category.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Categories
                                      </div>
                                   </div>
</a>

<a href="{{ route('index_sales_receipt') }}">
                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/btn-money.svg')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Receipts
                                      </div>
                                   </div>
</a>

<a href="{{ route('new_transfer') }}">
                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/transfer.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          New Transfer
                                      </div>
                                   </div>
</a>

<a href="{{ route('new_damage') }}">
                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/damage.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          New Damage
                                      </div>
                                   </div>
</a>

<a href="{{ route('customer_index_app') }}">

                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/btn-add-customer.svg')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Customers
                                      </div>
                                   </div>
</a>

 <a href="{{ route('supplier_index') }}">

                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/btn-add-supplier.svg')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Suppliers
                                      </div>
                                   </div>
</a>

    <a href="{{ route('index_sales_payment') }}">
<div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/cash_payment.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Payments
                                      </div>
                                   </div>
    </a>
 <a href="{{ route('adjustment_index') }}">
                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/adjustment.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Inventory Adjustment
                                      </div>
                                   </div>
</a>

<a href="{{ route('new_return') }}">

                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/return.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Ruturn
                                      </div>
                                   </div>
</a>

    <a href="{{ route('item_threshold') }}">

                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/notification.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                         Min Quantity Alert
                                      </div>
                                   </div>
    </a>



                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/increase.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Sales Report
                                      </div>
                                   </div>



    <a href="{{ route('inventory_record') }}">
                                   <div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; 
                                   margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> 
                                      <img src="{{asset('images/inventory_record.png')}}" width=70 height=30 class="" />
                                      <div style="margin-top:10%;text-align:center;">
                                          Inventory Record
                                      </div>
                                   </div>

    </a>
                                   {{--<div class="item thumbnail" style="width:170px; height:150px; float:left; font-family:Cambria; --}}
                                   {{--margin-left:2%; font-size:12.5pt; border:2px ridge green; width=120 height=130; margin-top:3px; padding-top:18px;"> --}}
                                      {{--<img src="{{asset('images/settings.png')}}" width=70 height=30 class="" />--}}
                                      {{--<div style="margin-top:10%;text-align:center;">--}}
                                          {{--Settings--}}
                                      {{--</div>--}}
                                   {{--</div>--}}



                        </div>


                </div>
                <!-- END APP CONTENT -->
                                
            </div>

            <!-- Merhawis code -->
            <script src="{{asset('js/adminlte.min.js')}}"></script>
            @endsection