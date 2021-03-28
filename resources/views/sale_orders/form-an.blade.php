
<html style="height: auto; min-height: 100%;" id="main_html">

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Alpha PharmaA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

    <script src="{{ asset('js/angular.min.js')}}"></script>
    <script src="{{ asset('js/angular-route.js')}}"></script>


    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{ asset('bootstrap1.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.css')}}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.css.map')}}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css.map')}}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{ asset('css/alpha.css')}}">

        <script type="text/javascript" src="{{ asset('js/jquery-2.1.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-3.1.0.js')}}"></script>
        {{--<script type="text/javascript" src="{{ asset('js/vue.js')}}"></script>--}}
        <script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.scannerdetection.js')}}"></script>


  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;box-sizing: content-box;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}
</style>
</head>

<script>

    var app = angular.module('myApp', []);

    app.controller('myCtrl',['$scope', '$http', function($scope,$http) {

        $scope.model = "";

        $scope.names = ["Emil", "Tobias", "Linus"];
        $scope.items_list = [];

        $scope.addItem = function (item_name,item_id,barcode_main,barcode,barcode_id,unit_price,
                                   package_tracking,unit_price_variant,variants,main_item_name,
                                   package_id,package_name)
        {
            console.log("Heeeeeellllllooooo");

            console.log("Item name: "+item_name)
            console.log("item_id: "+item_id)
            console.log("barcode_main: "+barcode_main)
            console.log("barcode: "+barcode)
            console.log("barcode_id: "+barcode_id)
            console.log("unit_price: "+unit_price)
            console.log("unit_price_variant: "+unit_price_variant)
            console.log("Variants "+variants)
            console.log("package tracking "+package_tracking)

            console.log(item_name);

            if(variants==true){
                console.log("hi variants")
                var item_price = unit_price_variant
            }else{
                console.log("hi no variants")
                var item_price = unit_price
            }

            $scope.new_item = {
                item:item_name,
                item_id:item_id,
                qty:1,
                unit_price:item_price,
                discount:0.00,
                barcode_id:barcode_id,
                sub_total:unit_price*1,
                main_item_name:main_item_name,
                package_tracking:package_tracking,
                barcode:barcode,
                variants:variants,
            };

            console.log("Hellloooo");
            console.log($scope.new_item);

//            var len = $scope.items_list.length;

//            console.log('Length: '+len);

            data={'product':$scope.new_item}

            $http.post("{{route('new_sale_item_add')}}",data)
                .then(function(response) {
                    $scope.myWelcome = response.data;
                    console.log("Siiiii");
                    console.log($scope.myWelcome);

                    var len = $scope.myWelcome['success'].length;
                    console.log("Hiii");
                    console.log($scope.myWelcome['success'].length);
                    $scope.items_list = [];

                    for (var i = 0; i < len; i++)
                    {
                        console.log("Hiii");
                        console.log($scope.myWelcome['success'][i]['barcode']);

                        $scope.new_item = {
                            item:$scope.myWelcome['success'][i]['item_name'],
                            item_id:$scope.myWelcome['success'][i]['item_id'],
                            qty:$scope.myWelcome['success'][i]['qty'],
                            unit_price:$scope.myWelcome['success'][i]['unit_price'],
                            discount:0.00,
                            barcode_id:$scope.myWelcome['success'][i]['barcode_id'],
                            sub_total:$scope.myWelcome['success'][i]['unit_price']*$scope.myWelcome['success'][i]['qty'],
                            main_item_name:$scope.myWelcome['success'][i]['main_item_name'],
                            package_tracking:$scope.myWelcome['success'][i]['package_tracking'],
                            barcode:$scope.myWelcome['success'][i]['barcode'],
                            variants:$scope.myWelcome['success'][i]['variants'],
                        };
                            $scope.items_list.push($scope.new_item);
                    }

                });

            // Let it return back the list of items in transaction
            // Let it return back the list of packages if available

            // Search for sale items & fill it in z browser

            // foreach sale item: if z item have pkg & still it is not registerd call the pkg finder

            // if(len>0){
            //
            //     var flag =false;
            //     var item_index = -1;
            //
            //     for (var i = 0; i < len; i++)
            //     {
            //
            //         if($scope.items_list[i].item_id==$scope.new_item.item_id && $scope.items_list[i].barcode_id==$scope.new_item.barcode_id){
            //             console.log('It exists');
            //             flag = true;
            //             item_index = i;
            //         }else{
            //             console.log('It doesnt exists');
            //         }
            //     }
            //
            //     if(flag==false)
            //     {
            //         $scope.items_list.push($scope.new_item);
            //         $scope.sub_total = $scope.unit_price *1;
            //     }else{
            //         $scope.items_list[item_index].qty +=1;
            //         $scope.items_list[item_index].sub_total = $scope.items_list[item_index].qty * $scope.items_list[item_index].unit_price;
            //     }
            //
            // }else{
            //     console.log('no items')
            //     $scope.items_list.push($scope.new_item);
            // }

            console.log($scope.items_list);

  //          $scope.calculate_sum();

            // Check ajax from server

//            console.log('package tracking: '+$scope.new_item.package_tracking)

  //          console.log('item_id: '+$scope.new_item.item_id+'variant_id: '+$scope.new_item.barcode_id+'package_tracking: '+$scope.new_item.package_tracking+'index: '+($scope.items_list.length-1));

            var data = {};


//            $scope.find_package($scope.new_item.item_id,$scope.new_item.barcode_id,$scope.new_item.package_tracking,($scope.items_list.length-1),package_id);
//            $scope.after_addition();

        }

        $scope.find_package = function(item_id,barcode_id,package_tracking,item_index,package_id){
            data={item_id:$scope.new_item.item_id,'variant_id':$scope.new_item.barcode_id,
                'package_tracking':$scope.new_item.package_tracking,
                'index':($scope.items_list.length-1)}

            if(package_id=="-"){
                $http.post("{{route('find_item_packages')}}",data)
                    .then(function(response) {
                        $scope.myWelcome = response.data;
                        console.log($scope.myWelcome);

                        if($scope.myWelcome['select_count']>0)
                        {
                            document.getElementById('package_'+$scope.new_item.item_id+'_'+$scope.new_item.barcode_id).innerHTML=$scope.myWelcome['select_options'];
                        }
                    });
            }else{

                $http.post("{{route('find_item_packages')}}",data)
                    .then(function(response) {

                        $scope.myWelcome = response.data;
                        console.log($scope.myWelcome);

                        if($scope.myWelcome['select_count']>0)
                        {
                            if(package_tracking==1){
                                current_index = ($scope.items_list.length-1);
                                // document.getElementById('package_'+$scope.new_item.item_id+'_'+$scope.new_item.barcode_id).innerHTML=$scope.myWelcome['select_options'];
                                document.getElementById('package_'+$scope.new_item.item_id+'_'+$scope.new_item.barcode_id).innerHTML="<select id='pkg_"+current_index+"' name='hi' class='form-control'> <option value='"+package_id+"'>"+package_name+"</option></select>";
                                //"<select id='pkg_"+($scope.items_list.length-1)+"> <option value="+package_id+">"+package_id+"</option></select>";
                            }
                        }
                    });
            }
        }

        $scope.after_addition = function(){

            // Finding interactions
            var data = {};

            data={items_list:$scope.items_list}

            // console.log("-------------------------------");
            //
            // console.log(data);
            //
            // console.log("-------------------------------");

            $http.post("{{route('find_item_interactions')}}",data)
                .then(function(response) {
                    $scope.myWelcome = response.data;
                    console.log($scope.myWelcome);
                    document.getElementById('interaction_warning').innerHTML = $scope.myWelcome['datas'];
                });

        }

        $scope.get_all_sales_items = function (){

            data = {}

            $http.post("{{route('get_all_sales_items')}}")
                .then(function(response) {
                    $scope.myWelcome = response.data;
                    console.log("Siiiii");
                    console.log($scope.myWelcome);

                    var len = $scope.myWelcome['success'].length;
                    console.log("Hiii");
                    console.log($scope.myWelcome['success'].length);
                    $scope.items_list = [];

                    for (var i = 0; i < len; i++)
                    {
                        console.log("Reffressssh");
                        console.log($scope.myWelcome['success'][i]['barcode']);

                        $scope.new_item = {
                            item:$scope.myWelcome['success'][i]['item_name'],
                            item_id:$scope.myWelcome['success'][i]['item_id'],
                            qty:$scope.myWelcome['success'][i]['qty'],
                            unit_price:$scope.myWelcome['success'][i]['unit_price'],
                            discount:0.00,
                            barcode_id:$scope.myWelcome['success'][i]['barcode_id'],
                            sub_total:$scope.myWelcome['success'][i]['unit_price']*$scope.myWelcome['success'][i]['qty'],
                            main_item_name:$scope.myWelcome['success'][i]['main_item_name'],
                            package_tracking:$scope.myWelcome['success'][i]['package_tracking'],
                            barcode:$scope.myWelcome['success'][i]['barcode'],
                            variants:$scope.myWelcome['success'][i]['variants'],
                        };
                        $scope.items_list.push($scope.new_item);
                    }
                });

        }

        $scope.removeItem = function (x) {

            console.log("ksdfklsjfklsdjfkl");
            console.log($scope.items_list[x]);


            data = {item_id:$scope.items_list[x]['item_id'],barcode_id:$scope.items_list[x]['barcode_id']};

            $http.post("{{route('delete_transaction_bro')}}",data)
                .then(function(response) {
                    $scope.myWelcome = response.data;
                    console.log("Wousdoisdofj");
                    console.log($scope.myWelcome);

                });

            $scope.items_list.splice(x, 1);

            data={items_list:$scope.items_list}

            console.log("-------------------------------");

            console.log(data);

            console.log("-------------------------------");

            $http.post("{{route('find_item_interactions')}}",data)
                .then(function(response) {

                    $scope.myWelcome = response.data;
                    console.log($scope.myWelcome);

                    document.getElementById('interaction_warning').innerHTML = $scope.myWelcome['datas'];

                });

        }

        $scope.setSuccessMessage = function () {
            document.getElementById('success-message').innerHTML='Data Saved Successfully';
        }

        $scope.clearSuccessMessage = function () {
            document.getElementById('success-message').innerHTML='';
        }

        $scope.saveAll = function () {

            var error = 0;

            console.log('Hiiiiii');


            var len = $scope.items_list.length;

            console.log('Length: '+len);

            if(len>0) {

                var flag = false;
                var item_index = -1;

                for (var i = 0; i < len; i++) {

                    $scope.items_list[i].freq = 10;// document.getElementById('freq_' + i).value;
                    $scope.items_list[i].dosage = document.getElementById('dosage_' + i).value;
                    $scope.items_list[i].uom = document.getElementById('uom_' + i).value;
                    $scope.items_list[i].uod = document.getElementById('uod_' + i).value;
                    $scope.items_list[i].route = document.getElementById('route_' + i).value;
                    $scope.items_list[i].duration = document.getElementById('duration_' + i).value;

                    if ($scope.items_list[i].package_tracking == 1 || $scope.items_list[i].package_tracking == '1') {
                        item_index = i;
                        $scope.items_list[i].package = Number(document.getElementById('pkg_' + i).value);
                        console.log($scope.items_list[i].package);

                    } else {
                        console.log('It doesnt exists');
                        $scope.items_list[i].package = "-";
                    }

                }
            }

                // Send the sales details to the backend

            var customer = document.getElementById('customer').value;
            var payment_method= document.getElementById('payment').value;
            var sale_date = document.getElementById('sale_date').value;


            var data = {};

            data={'items_list':$scope.items_list,'customer':customer,'payment_method':payment_method,'sale_date':sale_date}

            $http.post("{{route('create_pos_sale_post')}}",data)
                .then(function(response) {

                    $scope.myWelcome = response.data;
                    console.log($scope.myWelcome);

                    console.log($scope.myWelcome['success']);
                    if($scope.myWelcome['success']=='DONE'){
                        console.log('helloowww')
                        $counts = $scope.items_list.length;
                        $scope.items_list.splice(0, $counts);
                        setTimeout(setSuccessMessage, 100);
                        setTimeout(clearSuccessMessage, 1500);

 //                     document.getElementById('success-message').innerText="Successfully saved"

                    }


                    // if($scope.myWelcome['select_count']>0)
                    // {
                    //     document.getElementById('package_'+$scope.new_item.item_id+'_'+$scope.new_item.barcode_id).innerHTML=$scope.myWelcome['select_options'];
                    // }

                });


        }

        $scope.update_item_package = function (x) {

            console.log('hiii: '+document.getElementById(x).value());

            $scope.items_list[x].package=document.getElementById(x).value();

        }

        $scope.calculate_sum = function () {

            $scope.total_amount = 0.00;

            var len = $scope.items_list.length;

            console.log(len);

            for (var i = 0; i < len; i++)
            {
                    $scope.total_amount+=Number($scope.items_list[i].sub_total);
            }

            $scope.total_amount = (Number($scope.total_amount)).toFixed(2);


            document.getElementById("total").innerHTML=
                "<B><u>"+$scope.total_amount.toString()+"</u><BR/>";
        }

    }]);

function together(){

    //setInterval(setSuccessMessage, 600)
    var scope = angular.element(document.getElementById('every_body')).scope();
    var retrunValue = scope.get_all_sales_items();
}

    function init() {
        setInterval(together, 2000)
    }

    window.onload =init;

</script>


<body class="skin-blue sidebar-mini" id="every_body" style="height: auto; min-height: 100%;" ng-app="myApp" ng-controller="myCtrl">

  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>-PO</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="float:left;"><b>Alpha POS</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <ul class="dropdown-menu">
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  
</div>

<div class="container" style=" width:95%; padding: 10px; margin-left:20px; margin-right:-10px;">
<div class="row">

<div class="col-sm-7 col-md-5 col-lg-5" style="background-color:#ddd; padding-top:20px; height:800px; overflow: scroll;">

<script>

function searchItem()
{


$doc_item = document.getElementById('select_category');

if($doc_item.value!="")
{
$(".item").hide();
$(".cat_"+$doc_item.value).show();
}else{
  $(".item").show();
}


}
</script>
<div class="row">

<div class="top-search col-sm-5 col-md-5 col-lg-5" style="float:left;" > 
<div class="input-group input-group-sm">
 <select class="form-control" id="select_category" class="categories" onClick="searchItem();">

 <option value=""> Select Category</option>

@foreach($categories as $category)    

<option value="{{$category->id}}">{{$category->category_name}} </option>

@endforeach
 </select>

              <br/>
 </div>
 </div>


<div class="top-search col-sm-5 col-md-5 col-lg-5" style="float:right;" > 
<div class="input-group input-group-sm">
                <input type="text" placeholder="Search" class="form-control" onclick="searchItem();">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat"><i class="fa fa-fw fa-search"></i></button>
                    </span>
                    <br/>
              </div>
              <br/>
 </div>

 <br/>

</div>

<div class="items" style="width:100%; padding-left: -3px; margin-right:3px; padding-right: -30px;">
        @foreach($products as $product )
            <?php
            $product->item_name;

            if($product->image!=null)
            {
            // there is image
            $variables =asset('images/products/')."/".$product->image;
            ?>

            <div id="cat_{{$product->category}}" class="item thumbnail cat_{{$product->category}}"
                 style="width:100px; height:100px; float:left; border:1px green; font-family:Cambria;
                 margin-left:3px; font-size:11pt;border:0.1px solid green;">
                <div class="item-image"><img src="{{$variables }}" id="{{$product->barcode}}" width=160 height=120
                                             ng-click= "
    addItem('{{$product->item_name}} {{$product->size}} {{$product->route}}', {{$product->id}}, '{{$product->barcode_main}}',
     @if($product->variants=='false')
                                                     '-','-',{{$product->unit_price}},
            @else
                                                     '{{$product->barcode}}',{{$product->barcode_id}},{{$product->unit_price_variant}},
            @endif
                                             {{$product->package_tracking}},
@if($product->variants=='false')0.00,
@else
                                             {{$product->unit_price_variant}},
@endif{{$product->variants}},'{{$product->item_name}}','-','-');"
                    >
                    <div class="item-footer" style="text-align:center;">{{$product->item_name}} [{{$product->size}} {{$product->route}}]</div>
                    <div class="item-footer" style="text-align:center;">

            @if($product->variants=='false')
              {{$product->unit_price}}
            @endif
            @if($product->variants=='true')
            {{$product->unit_price_variant}} 
            @endif
                        Nkf</div>
                </div>
            </div>
            <?php
            }else{
            ?>
            <div id="cat_{{$product->category}}" class="item item_icon thumbnail cat_{{$product->category}}" name="{{$product->id}}"
                 style="width:100px; height:100px; float:left; margin-left:2px; background-color:#0f74a8; font-family:Cambria; color:white;
                 font-size:11pt;border:0.1px solid green; vertical-align: text-top;"
                 id="{{$product->barcode}}"
                 ng-click="
            addItem('{{$product->item_name}} {{$product->size}} {{$product->route}}', {{$product->id}},
            '{{$product->barcode_main}}',
@if($product->variants=='false')
                         '-','-',{{$product->unit_price}},
            @else
                         '{{$product->variant_barcode}}',{{$product->barcode_id}},{{$product->unit_price_variant}},
            @endif
                 {{$product->package_tracking}},
{{--@if($product->variants=='false')--}}
                         <?php
                         if($product->variants=='false'){
                             echo"0.00,";
                         }else{
                             echo $product->unit_price_variant.",";
                         }
                         ?>
{{--@else--}}
                 {{--{{$product->unit_price_variant}},--}}
{{--@endif--}}
                 {{$product->variants}},'{{$product->item_name}}','-','-')"
            >
                <div style="margin-top:10%; text-align:center;">{{$product->item_name}}
                    {{$product->size}} {{$product->route}}</div>
                <div style="text-align:center;">
            @if($product->variants=='false')
            {{$product->unit_price}}
            @else
              {{$product->unit_price_variant}}
            @endif
            Nkf</div>
            </div>
            <?php
            }
            ?>

        @endforeach
    </div>
</div>

<script>

var checker=false;

var check= new Array();

    $(document).scannerDetection({timeBeforeScanTest: 200, avgTimeByChar: 40,preventDefault: false, endChar: [13], 
    onComplete: function(barcode, qty){ validScan = true; $('#scannerInput').val (barcode);
    console.log(barcode);

    $.ajax({

        type:'GET',

        url:"{{ route('new_sale_ajaxs')}}",

        data:{item_barcode:barcode},

        success:function(data)
        {
        console.log(data.success);
            console.log("item name"+data.item_name);
            console.log("item variant_barcode"+data.variant_barcode);
            console.log("item unit_price_variant"+data.unit_price_variant);
            console.log("item unit_price"+data.unit_price);
            console.log("item package_tracking"+data.package_tracking);
            console.log("item variants"+data.variants);
            console.log("item main_item_name"+data.main_item_name);
            console.log("item item_name"+data.item_name);
            console.log("item item_id"+data.item_id);
            console.log("item barcode_main"+data.barcode_main);
            console.log("item barcode_id"+data.barcode_id);
            console.log("item barcode"+data.barcode);
            console.log("item unit_price"+data.unit_price);
            console.log("item package"+data.package);
            console.log("item package"+data.package_name);

            //myCtrl.addItem("wonder",1,'12333','barcode',1,100.00,1,10.00,8,'wonderfulll')

            //                function (item_name,item_id,barcode_main,barcode,barcode_id,unit_price,
//                          package_tracking,unit_price_variant,variants,main_item_name)


            var scope = angular.element(document.getElementById('every_body')).scope();
           var retrunValue = scope.addItem(data.item_name,data.item_id,data.barcode_main,
               data.barcode,data.barcode_id,data.unit_price,data.package_tracking,
               data.unit_price_variant,data.variants,data.item_name,data.package,data.package_name);

            //            alert (retrunValue);

            // app.addItem(item_name,item_id,barcode_main,barcode,barcode_id,unit_price,
            //     package_tracking,unit_price_variant,variants,main_item_name)
//        console.log(data.success+" "+data.unit_price+" "+data.item_id+" "+ data.item_name+ " "+data.package_name);

        // if(data.package!=null || data.package>0){
        //   addToListBarcode(data.item_name, data.item_id,barcode,data.barcode_main,data.barcode_variant,data.variant,data.unit_price,0,data.package,'barcode_scanned',data.package_name,data.unit_price_variant);
        // }else{
        //   addToListBarcode(data.item_name, data.item_id,barcode,data.barcode_main,data.barcode_variant,data.variant,data.unit_price,1,data.package,'barcode_scanned',data.package_name,data.unit_price_variant);
        // }
        
        //addToListBarcode(item_name_passed, item_id_passed,barcode_passed,barcode_main_passed, barcode_variant_passed,barcode_id_passed,unit_price_passed,package_tracking_passed,unit_price_variant_passed)

        // console.log(data.item_name+'*'+data.item_id,barcode+'*'+data.barcode_main+'*'+data.barcode_variant+'*'+data.variant+'*'+data.unit_price+'*'+data.unit_price_variant)
        
        //this.calc_subtotal();
        // this.app.check_qty_all();
        // this.calculateTotalAmount();
        }
        });
     } , 
    onError: function(string, qty) { $('#userInput').val ($('#userInput').val() + string); } 
});

</script> 

<div class="col-md-7">

<div class="row">

<!-- The Modal -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'"
class="close" title="Close Modal">&times;</span>

  <!-- Modal Content -->
  <div class="modal-content animate" action="#">

    <div class="container" style='width:100%;'>
    <table class='table table-striped' id='POITable'>
    <tr><td>item: <input type="text" class="form-control" v-model="sale.item_name" name="item_name" id="item_name" disabled></td>  
    <input type=hidden id="item_id" v-model="sale.item">
    </td> </tr>
    <tr><td>Qty:<input type="text" name="item_name" class="form-control"></td>
    <td>Price:
    <input type="text" v-model="sale.unit_price" class="form-control" name="unit_price" id="unit_price" disabled></td>
    </table>
    <div>
      <button @click="addNote();showItems();">Submit</button>       
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
    </div>
  </div>
</div>



<form class="form-horizontal" action="{{route('new_sale')}}" method="post">
@csrf

<br/>
    <div class="col-md-4 col-md-4 col-lg-4">

    <label for="name">Customer</label>

    <select class="form-control" name="customer" id="customer">   
                                                @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                                                @endforeach
    </select>
</div>

<div class="col-md-3 col-md-3 col-lg-3">
<label for="name">Payment</label>
<select class="form-control" id="payment" name="payment">
     <option value="Cash">Cash</option>
     <option value="Credit">Credit</option>                                          
</select>
</div>
<div class="col-md-5 col-md-5 col-lg-">
<label for="name">Date</label>
<input type="date" id="sale_date" name="date" class="form-control" >
<br/><br/>
</div>
</div>

<div id="apper">
<?php 
echo "
  <table class='table' id='POITable'>

  <tr>
  <th>Item</th>
  <th>Freq</th>
  <th>Dosage</th>
  <th>Duration</th>
  <th>Route</th>
  <th>Qty</th>
  <th>Price</th>
  <th>Total</th>
  <th>Pkg</th>
  <th>Del</th>
  </tr>
";

                echo'
 <tr ng-repeat="x in items_list" style="margin-left:0px;margin-right:0px; padding-left:0px; margin-left:0px;">
            <td>{{ x.item }}</td>
<td>
    <select name="freq" class="form-control" v-model="sale.freq" id="freq_{{$index}}">
    <option value="Once a day(QD)">Once a day(QD)</option>
    <option value="Twice a day(BID)">Twice a day(BID)</option>
    <option value="Trice a day(TID)">Trice a day(TID)</option>
    <option value="Four times a day(QID)">Four times a day(QID)</option>
    <option value="Q 4 hours">Q 4 hours</option>
    <option value="Every other day">Every other day</option>
    <option value="Weekly">Weekly</option>
    <option value="Monthly">Monthly</option>
    <option value="Every 2 month">Every 2 month</option>
    <option value="Every 3 month">Every 3 month</option>
    <option value="Others">Others</option>
    </select>
</td>
<td style="padding-right:-10px; padding-left:0px; margin-right:-10px; ">
<div class="row" style="width:115%; padding-right: 0px; padding-left: 0px;">
<div class="col-md-7" style="margin:0px;padding:0px;">
<input type="text" class="form-control" style="margin:0px; padding:0px;" name="dosage" v-model="sale.dosage" id="dosage_{{$index}}" width=20 size=20>
</div>

<div class="col-md-5" style="width:40%; margin:0px;margin-left: -7px; margin-right:-10px; padding-right:0px; padding-left:0px;">
<select name="uom" class="form-control" id="uom_{{$index}}" v-model="sale.uom">
    <option value="mg">mg</option>
    <option value="ml">ml</option>
    </select>
</div>
</div>

</td>

<td style="padding-right:0px; margin-right:-35px; padding-left: 0px; margin-left:-10px;">

<div class="row" style="width:110%; margin-left:-10px;">
<div class="col-md-7">
  <input type="text" class="form-control" width=13 size=20 name="duration" id="duration_{{$index}}"  v-model="sale.duration">
</div>

<div class="col-md-5" style="width:40%; margin:0px;margin-left: -20px; margin-right:-40px; padding-right:0px; padding-left:0px;" >
<select name="uod" class="form-control" id="uod_{{$index}}" v-model="sale.duration_length">
    <option value="days">days</option>
    <option value="weeks">weeks</option>
    <option value="months">months</option>
    </select>
    </div>
</div>

</td>

<td>

    <select name="route" class="form-control" id="route_{{$index}}" v-model="sale.route">
    <option value="tablet">Tablet</option>
    <option value="syrup">Syrup</option>
    <option value="injectable">Injectable</option>
    <option value="wrap">Wrap</option>
    <option value="other">Other</option>
    </select>

</td>

            <td>{{ x.qty }}</td>
            <td>{{ x.unit_price }} </td>
            <td>{{ x.sub_total}} </td>
            <td><div id="package_{{x.item_id}}_{{x.barcode_id}}" name="package_{{x.item_id}}_{{x.barcode_id}}"></div></td>
            <td>
            <button class="btn btn-sm btn-danger" ng-click="removeItem($index);calculate_sum()">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
            </td>
        </tr>
';

echo "
  </table>";
?>
</div>


</div>

<div style="background-color:#ddd; display:block; width:40%; float:right;">

<span  style="font-size:18px; float:right; background-color:#ddd; margin-right:160px;" id="total">0.00</span>

<span style="font-size:18px; background-color:#ddd; float:right;">Total: &nbsp;&nbsp;&nbsp;</span>

<br/>

</div>

</form>

    <div style="display:block;float: right; width:50%">

        <br/>

        <div style="float: right;">

            <br/><br/>
            <button ng-click="saveAll()" class="btn btn-success submit_test" id="submit_test" style="display:block;">
                <i class="fa fa-fw fa-money"></i>
                Check Out
            </button>

        </div>

        <br/>
        <br/>

    </div>

<br/>
    <br/>
        <div id="success-message" style="color:green;"></div>
    <br/>

    <div class="panel panel-danger" style="background-color:; display:block; width:57%; float:right; margin-top: 10px;">
        <div class="panel-heading">
            <h3 class="panel-title">Drug Interactions</h3>
        </div>
        <div class="panel-body"  id="interaction_warning">
      </div>
    </div>

    <div class="panel panel-info" style="background-color:; display:block; width:57%; float:right; margin-top: 10px;">
        <div class="panel-heading">
            <h3 class="panel-title">Pregnancy Interactions</h3>
        </div>
        <div class="panel-body"  id="pregnancy_warning">
        </div>
    </div>

</div>

    <div id='success-message' style='color:green'>
</div>
<div id="test102">
</div>
</div>
</div>
</div>
</div>

</body>


<script type="text/javascript">

// update the view
// For loop

var all_sales;
var item_sales;

function calc_subtotal()
{
  index_id = 1;
  var variable_qty = document.getElementById(index_id).value;
  var variable_unit_price = document.getElementById('unit_price'+index).value;
  var variable_discount = document.getElementById('discount'+index).value;
  var subtotal = (variable_qty*variable_unit_price)-variable_discount;
  document.getElementById('subtotal'+index).value=subtotal;
}

function calculateTotalAmount()
{
  total = 0.00;
  for(var i=0;i<this.app.sales.length;i++)
  {
    subtotal=this.app.sales[i].qty*this.app.sales[i].unit_price-this.app.sales[i].discount;
    total += Number(subtotal);
  }
  document.getElementById('total').innerHTML = total.toString();
  
}


function calculateTotalAmount_test(index)
{
  total = 0.00;
  for(var i=0;i<=this.app.sales.length;i++)
  {
    subtotal=this.app.sales[i].qty*this.app.sales[i].unit_price-this.app.sales[i].discount;
    total += Number(subtotal);
  }
  subtotal=this.app.sales[index].qty*this.app.sales[index].unit_price-this.app.sales[index].discount;
  total -= Number(subtotal);
  document.getElementById('total').innerHTML = total.toString();
}

//addToListBarcode(data.item_name, data.item_id,barcode,data.barcode_main,data.barcode_variant,data.variant,data.unit_price,data.package,'barcode_scanned',data.package_name,data.unit_price_variant);

function addToListBarcode(item_name_passed, item_id_passed,barcode_passed,barcode_main_passed, barcode_variant_passed,barcode_id_passed,unit_price_passed,package_tracking_passed,package_id_passed,barcode_type,package_name_passed,unit_price_variant_passed)
{
  console.log('edit package id:'+package_id_passed);
  console.log('edit barcode type:'+barcode_type);
  console.log('edit package type:'+package_name_passed);
flag = false;

item_index = 0;

  if(!all_sales){
    console.log('no sales')
  }else{
    for (var i = 0; i < this.app.sales.length; i++) {
      if(this.app.sales[i].barcode==barcode_passed && this.app.sales[i].item==item_id_passed && this.app.sales[i].item==item_id_passed && this.app.sales[i].barcode_id == barcode_id_passed){
        //console.log('hekljlkfdsj')
        flag = true;
        item_index = i;
      }
   } 
  }

if (flag == false) {  
  //console.log('inside false');
  this.app.addToList(item_name_passed, item_id_passed,barcode_passed,barcode_main_passed, barcode_variant_passed,barcode_id_passed,unit_price_passed,unit_price_variant_passed,package_tracking_passed,barcode_type,package_name_passed);
  addItemToList(item_name_passed,item_id_passed,barcode_passed,barcode_main_passed, barcode_variant_passed,barcode_id_passed,unit_price_passed,unit_price_variant_passed,package_tracking_passed,barcode_type,package_name_passed);
  setTimeout(this.app.check_qty(1), 100);
  this.calculateTotalAmount();
  //check_qty(1);
  
var subtotal = (1*unit_price_passed)-0.00;

document.getElementById('subtotal1').value=subtotal;

}

  if (flag == true) 
  {  
      this.app.increase_qty(item_index);
      getChangedResults(item_index);
      var x=document.getElementById('POITable');
      var first_row = x.rows[0];
      first_row.hidden=true;
  }
}


function addItemToList(item_name_passed,item_id_passed,barcode_passed,barcode_main_passed, barcode_variant_passed,barcode_id_passed,unit_price_passed,unit_price_variant_passed,package_tracking_passed,barcode_type,package_name_passed)
{
  console.log("add to list type: "+barcode_type)
  console.log("add to list package name: "+package_name_passed)
  index_id = this.app.sales.length-1;
  index=index_id;

  var x=document.getElementById('table_row0');
  x.hidden=true;

  if(unit_price_variant_passed==null){
    document.getElementById('unit_price'+index_id).value=unit_price_variant_passed;
  }else{
    document.getElementById('unit_price'+index_id).value=unit_price_passed;
  }
    document.getElementById('qty_id'+index_id).value=1;
    document.getElementById('discount'+index_id).value=0.00;
    document.getElementById('subtotal'+index_id).value=unit_price_passed;

//    console.log("wonderful to see u 01001");

if(barcode_type="barcode_scanned"){
  console.log("wonderful to see u");
} 

 
}



function setSuccessMessage(){
  document.getElementById('success-message').innerHTML='Data Saved Successfully';
}

function clearSuccessMessage()
{
  document.getElementById('success-message').innerHTML='';
}

$.ajaxSetup({

headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}

});



$(".submit_test").click(function(e){
  date1=document.getElementById('date').value;
  
  if (date1==""){
    // alert('in')
    // return(false);
    
  }
  else{
   

var customer = document.getElementById('customer');
customer_id = customer.value;

// Get payment
var payment = document.getElementById('payment');
payment_id = payment.value;

// Get Date
var date_sale_id = document.getElementById('date');
date_sale = date_sale_id.value;

  }

})

function clearData(){
  all_sales =[];
  this.app.sales=[
		{
    item_name:'',
    item:'',
    qty:'',
    unit_price:'',
    barcode:'',
    barcode_id:'',
    discount:'',
    package_tracking:'',
    package:''
		}
		];
  calculateTotalAmount();
}


function update_item_package(index){

console.log("lskdjklsdjflsdfj"+index);


if(this.app.sales[index].barcode_id!=null)
{
  console.log('package_'+this.app.sales[index].item+'_'+this.app.sales[index].barcode_id);
  console.log(document.getElementById(index).value);
  this.app.sales[index].package = document.getElementById(index).value;
  console.log(this.app.sales[index].package);
}else{
  //console.log('package_'+item_id+'_'+'wonder');
  //document.getElementById('package_'+item_id+'_').value="hey";
}

//console.log(document.getElementById('package_'+item_id+'_'+variant_id).value);


}

function getPackages(item_id,package_tracking,variant_id){

 // alert('be4track')
 
//  setTimeout(getPackagestimed(item_id,package_tracking,variant_id,index), 100);
 
}

function getPackagestimed(item_id,package_tracking,variant_id,index)
{
console.log(item_id);
console.log(package_tracking);
console.log(variant_id);
console.log('index: '+index);

// Get packages list from item and variant id

//alert('be4track')

if(package_tracking==1){

  //alert('track')

if(variant_id!=null)
{
  //alert('sjdkldsfsdsdfsfsd')

  console.log('package_'+item_id+'_'+variant_id);
  document.getElementById('package_'+item_id+'_'+variant_id).value="helow";
}else{

  //alert('sjdkldsf')

  console.log('package_'+item_id+'_'+'wonder');
  document.getElementById('package_'+item_id+'_').value="hey";

}
}
//document.getElementById('package_'+item_id+'_'+variant_id).value="<option>";

$.ajax({

type:'GET',

url:"{{ route('find_item_packages') }}",

data:{item_id:item_id,variant_id:variant_id,package_tracking:package_tracking,index:index},

success:function(data)
{  
  console.log(data.success);
  console.log(data.select_options);
  console.log(data.variant_id);

  console.log('Package id '+'package_'+item_id+'_'+variant_id);
  console.log('count '+data.select_count);

  if(data.select_count>0)
  {
  document.getElementById('package_'+item_id+'_'+variant_id).innerHTML=data.select_options;
  }
}
});
}

</script>


<div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap  -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('bower_components/chart.js/Chart.js')}}"></script>

<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard2.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })



  function getPackagestimed(item_id,package_tracking,variant_id,index)
  {
      console.log(item_id);
      console.log(package_tracking);
      console.log(variant_id);
      console.log('index: '+index);

// Get packages list from item and variant id

//alert('be4track')

      if(package_tracking==1){

          //alert('track')

          if(variant_id!=null)
          {
              //alert('sjdkldsfsdsdfsfsd')

              console.log('package_'+item_id+'_'+variant_id);
              document.getElementById('package_'+item_id+'_'+variant_id).value="helow";
          }else{

              //alert('sjdkldsf')

              console.log('package_'+item_id+'_'+'wonder');
              document.getElementById('package_'+item_id+'_').value="hey";

          }
      }
//document.getElementById('package_'+item_id+'_'+variant_id).value="<option>";

      $.ajax({

          type:'GET',

          url:"{{ route('find_item_packages') }}",

          data:{item_id:item_id,variant_id:variant_id,package_tracking:package_tracking,index:index},

          success:function(data)
          {
              console.log(data.success);
              console.log(data.select_options);
              console.log(data.variant_id);

              console.log('Package id '+'package_'+item_id+'_'+variant_id);
              console.log('count '+data.select_count);

              if(data.select_count>0)
              {
                  document.getElementById('package_'+item_id+'_'+variant_id).innerHTML=data.select_options;
              }
          }
      });
  }

</script>

<script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>

<div class="jvectormap-label"></div></body></html>