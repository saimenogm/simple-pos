
<html style="height: auto; min-height: 100%;" id="main_html">

<script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>

<style>

    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5px auto; /* 15% from the top and centered */
        border: 1px solid #888;
        width: 50%; /* Could be more or less, depending on screen size */
    }

</style>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Alpha POS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <script src="{{ asset('js/angular.min.js')}}"></script>
    <script src="{{ asset('js/angular-route.js')}}"></script>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('bootstrap1.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.css.map')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css.map')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('css/alpha.css')}}">
    <link rel="stylesheet" href="{{ asset('css/extra.css')}}">

    <script type="text/javascript" src="{{ asset('js/jquery-2.1.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.1.0.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.scannerdetection.js')}}"></script>

    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />


  {{--<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->--}}
  {{--<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->--}}
  {{--<!--[if lt IE 9]>--}}
  {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>--}}
  {{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
  {{--<![endif]-->--}}

  <!-- Google Font -->
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;box-sizing: content-box;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}
</style>
</head>

<script>

    var app = angular.module('myApp', []);

    app.controller('myCtrl',['$scope', '$http', function($scope,$http) {

        $scope.model = "";

        $scope.names = ["",""];
        $scope.items_list = [];

        $scope.addItem = function (item_name,item_id,barcode_main,barcode,barcode_id,unit_price,
                                   package_tracking,unit_price_variant,variants,main_item_name,
                                   package_id,package_name)
        {

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
                freq:"",
            };

            data={'product':$scope.new_item}

            $http.post("{{route('new_sale_item_add')}}",data)
                .then(function(response)
                {
                    $scope.myWelcome = response.data;

                    var len = $scope.myWelcome['success'].length;
                    $scope.items_list = [];

                    for (var i = 0; i < len; i++)
                    {
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
                        // $scope.find_package($scope.myWelcome['success'][i]['item_id'],$scope.myWelcome['success'][i]['barcode_id'],
                        //     $scope.myWelcome['success'][i]['package_tracking'],
                        //     i,$scope.myWelcome['success'][i]['package_tracking']);
//                        item_id,barcode_id,package_tracking,item_index,package_id
                    }
                });

            // Let it return back the list of items in transaction
            // Let it return back the list of packages if available

            // Search for sale items & fill it in z browser

            // foreach sale item: if z item have pkg & still it is not registerd call the pkg finder

            len = $scope.items_list.length;

            if(len>0)
            {
                var flag =false;
                var item_index = -1;

                for (var i = 0; i < len; i++)
                {
                    if($scope.items_list[i].item_id==$scope.new_item.item_id && $scope.items_list[i].barcode_id==$scope.new_item.barcode_id){
                        console.log('It exists');
                        flag = true;
                        item_index = i;
                    }else{
                        console.log('It doesnt exists');
                    }
                }

                if(flag==false)
                {
                    $scope.items_list.push($scope.new_item);
                    $scope.sub_total = $scope.unit_price *1;
                }else{
                    $scope.items_list[item_index].qty +=1;
                    $scope.items_list[item_index].sub_total = $scope.items_list[item_index].qty * $scope.items_list[item_index].unit_price;
                }
            }else{
                console.log('no items')
                $scope.items_list.push($scope.new_item);
            }

            console.log($scope.items_list);

            // Check ajax from server

//            console.log('package tracking: '+$scope.new_item.package_tracking)

  //          console.log('item_id: '+$scope.new_item.item_id+'variant_id: '+$scope.new_item.barcode_id+'package_tracking: '+$scope.new_item.package_tracking+'index: '+($scope.items_list.length-1));

//            var data = {};

            //$scope.after_addition();
            $scope.search_packages();
            $scope.calculate_sum();

        }


        $scope.add_customer = function(){

            $scope.customer_name = document.getElementById('customer_name').value;
            $scope.telephone = document.getElementById('telephone').value;
            $scope.address = document.getElementById('address').value;
            $scope.remark = document.getElementById('remark').value;

            console.log(customer_name);
            console.log(telephone);
            // console.log(address);
            // console.log(remark);

//            console.log(data.success);

            //alert("Are u there")

                data={customer_name: $scope.customer_name,
                    telephone:$scope.telephone,
                    address:$scope.address,
                    remark:$scope.remark
                    // telephone: telephone,
                    // address: address,
                    // contact_person: contact_person,
                    // regular_customer_check: regular_customer_check,
                    // remark,remark
                }

//            data={items:$scope.items_list}

            //alert("Yes I am there 0");

            $http.post("{{route('add_new_customer')}}",data)
                .then(function(response) {
                    //alert("Yes I am there 1");
                    $scope.myWelcome = response.success;
                    alert("Customer Saved Successfully")
                    document.getElementById('id01').style.display='none';
                    //alert(response.success);
//                    document.getElementById('pregnancy_warning').innerHTML =$scope.myWelcome.data
                });
        }


        $scope.search_packages = function(){
            len = $scope.items_list.length;
            for(i=0;i<len;i++){
                // $scope.find_package($scope.myWelcome['success'][i]['item_id'],$scope.myWelcome['success'][i]['barcode_id'],
                //     $scope.myWelcome['success'][i]['package_tracking'],
                //     i,$scope.myWelcome['success'][i]['package_tracking']);

                // $scope.find_package($scope.items_list[i].item_id,$scope.items_list[i].barcode_id,$scope.items_list[i].package_tracking,i,$scope.items_list[i].package_tracking);
                // console.log("Itemssss "+$scope.items_list[i].item_id);
            }
        }

        $scope.find_package = function(item_id,barcode_id,package_tracking,item_index,package_id){

            data={item_id:item_id,'variant_id':barcode_id,
                'package_tracking':package_tracking,
                'index':item_index}

                //alert('Item Id: '+item_id+' variant'+barcode_id);

            if(package_id=="-"){
                $http.post("{{route('find_item_packages')}}",data)
                    .then(function(response) {

                        console.log("lskjdklsdjfklXXXXXXXXXXXXXXXXX");

                        $scope.myWelcome = response.data;
                        console.log($scope.myWelcome);

                        if($scope.myWelcome['select_count']>0)
                        {
                            alert("heeyyyy")
                            document.getElementById('package_'+item_index).innerHTML=$scope.myWelcome['select_options'];
//                            document.getElementById('package_'+$scope.new_item.item_id+'_'+$scope.new_item.barcode_id).innerHTML=$scope.myWelcome['select_options'];
                        }
                    });
            }else{
                $http.post("{{route('find_item_packages')}}",data)
                    .then(function(response) {

                        $scope.myWelcome = response.data;
                        console.log($scope.myWelcome);

                        console.log("lskjdklsdjfklsdjflsdjfljsf");
                        console.log($scope.myWelcome['select_options']);

                        console.log("Item Data: "+$scope.myWelcome['item_data']);

//                      alert("Item Data: "+$scope.myWelcome['item_data']);

                        // if($scope.myWelcome['select_count'].length>0)
                        // {
                        if(package_tracking==1){
                            current_index = ($scope.items_list.length-1);
                            console.log("Insidddddeeee")
                            // document.getElementById('package_'+$scope.new_item.item_id+'_'+$scope.new_item.barcode_id).innerHTML=$scope.myWelcome['select_options'];
//item_id,barcode_id,package_tracking,item_index,package_id
                            console.log("The select options are: ");
//                                console.log($scope.myWelcome['select_options']);
//                                alert("woooowwww")
                            document.getElementById('pkg_'+item_index).innerHTML=$scope.myWelcome['select_options'];
                            //"<select id='pkg_"+($scope.items_list.length-1)+"> <option value="+package_id+">"+package_id+"</option></select>";
                        }
//                        }
                    });
            }
        }

        $scope.update_freq = function(x,freq){

           // alert("hiiii "+x);

            selected_item = $scope.items_list[x];

            item_id = $scope.items_list[x].item_id;
            barcode_id = $scope.items_list[x].barcode_id;
            $scope.items_list[x].freq=freq;

           // alert("Freq is "+freq);

            data={item_id:item_id, barcode_id:barcode_id,freq:freq}

            $http.post("{{route('update_freq')}}",data)
                .then(function(response) {
                    console.log("Freq Update");
                    $scope.myWelcome = response.data;
                    //document.getElementById('pregnancy_warning').innerHTML =$scope.myWelcome.data
                });
        }

        $scope.update_dosage = function(x,dosage){

            //alert("Dosage "+x);

            selected_item = $scope.items_list[x];

            item_id = $scope.items_list[x].item_id;
            barcode_id = $scope.items_list[x].barcode_id;
            $scope.items_list[x].dosage=dosage;

            //alert("dosage is "+dosage);

            data={item_id:item_id, barcode_id:barcode_id,dosage:dosage}

            $http.post("{{route('update_dosage')}}",data)
                .then(function(response) {
                    console.log("Dosage Update");
                    $scope.myWelcome = response.data;
                    //document.getElementById('pregnancy_warning').innerHTML =$scope.myWelcome.data
                });
        }

        $scope.update_duration = function(x,duration){

//            alert("Dosage "+x);

            selected_item = $scope.items_list[x];

            item_id = $scope.items_list[x].item_id;
            barcode_id = $scope.items_list[x].barcode_id;
            $scope.items_list[x].duration=duration;

  //          alert("dosage is "+duration);

            data={item_id:item_id, barcode_id:barcode_id,duration:duration}

            $http.post("{{route('update_duration')}}",data)
                .then(function(response) {
                    console.log("Dosage Update");
                    $scope.myWelcome = response.data;
                    //document.getElementById('pregnancy_warning').innerHTML =$scope.myWelcome.data
                });
        }

        $scope.update_uom = function(x,uom){

          //  alert("UOM "+x);

            selected_item = $scope.items_list[x];

            item_id = $scope.items_list[x].item_id;
            barcode_id = $scope.items_list[x].barcode_id;
            $scope.items_list[x].uom=uom;

            //alert("dosage is "+uom);

            data={item_id:item_id, barcode_id:barcode_id,uom:uom}

            $http.post("{{route('update_uom')}}",data)
                .then(function(response) {
                    console.log("uom Update");
                    $scope.myWelcome = response.data;
                    //document.getElementById('pregnancy_warning').innerHTML =$scope.myWelcome.data
                });
        }

        $scope.update_uod = function(x,uod){

          //  alert("UOM "+x);

            selected_item = $scope.items_list[x];

            item_id = $scope.items_list[x].item_id;
            barcode_id = $scope.items_list[x].barcode_id;
            $scope.items_list[x].uod=uod;

            //alert("dosage is "+uod);

            data={item_id:item_id, barcode_id:barcode_id,uod:uod}

            $http.post("{{route('update_uod')}}",data)
                .then(function(response) {
                    console.log("uod Update");
                    $scope.myWelcome = response.data;
                    //document.getElementById('pregnancy_warning').innerHTML =$scope.myWelcome.data
                });
        }

        $scope.update_route = function(x,route){

          //  alert("UOM "+x);

            selected_item = $scope.items_list[x];

            item_id = $scope.items_list[x].item_id;
            barcode_id = $scope.items_list[x].barcode_id;
            $scope.items_list[x].route=route;

            //alert("dosage is "+route);

            data={item_id:item_id, barcode_id:barcode_id,route:route}

            $http.post("{{route('update_route')}}",data)
                .then(function(response) {
                    console.log("route Update fff");
                    $scope.myWelcome = response.data;
                    //document.getElementById('pregnancy_warning').innerHTML =$scope.myWelcome.data
                });
        }

        $scope.update_package = function(x,package){

             // alert("Package: "+package);

            selected_item = $scope.items_list[x];

            item_id = $scope.items_list[x].item_id;
            barcode_id = $scope.items_list[x].barcode_id;
            $scope.items_list[x].route=package;

            //alert("dosage is "+route);

            data={item_id:item_id,barcode_id:barcode_id, package:package}

            $http.post("{{route('update_package')}}",data)
                .then(function(response) {
                    console.log("Update Pkg");
                    $scope.myWelcome = response.data;
                    //document.getElementById('pregnancy_warning').innerHTML =$scope.myWelcome.data
                });
        }

        $scope.update_qty = function(x,qty){

           // alert("Dosage "+x);

            selected_item = $scope.items_list[x];

            item_id = $scope.items_list[x].item_id;
            barcode_id = $scope.items_list[x].barcode_id;
            $scope.items_list[x].qty=qty;
            $scope.items_list[x].sub_total=(qty)*($scope.items_list[x].unit_price);

            data={item_id:item_id, barcode_id:barcode_id,qty:qty}

            $http.post("{{route('update_qty')}}",data)
                .then(function(response) {
              //      console.log("Dosage Update");
                    $scope.myWelcome = response.data;
                    //document.getElementById('pregnancy_warning').innerHTML =$scope.myWelcome.data
                });
            $scope.calculate_sum();
        }

        $scope.get_all_sales_items = function (){

            data = {}

            $http.post("{{route('get_all_sales_items_browser')}}")
                .then(function(response) {
                    $scope.myWelcome = response.data;
                    console.log("Siiiiixx");
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
                            barcode:$scope.myWelcome['success'][i]['barcode'],
                            variants:$scope.myWelcome['success'][i]['variants'],
                            freq: $scope.myWelcome['success'][i]['freq'],
                            dosage: $scope.myWelcome['success'][i]['dosage'],
                            duration: $scope.myWelcome['success'][i]['duration'],
                            uod: $scope.myWelcome['success'][i]['uod'],
                            uom: $scope.myWelcome['success'][i]['uom'],
                            route: $scope.myWelcome['success'][i]['route'],

                        };
                        $scope.items_list.push($scope.new_item);
                    }
                });

            //$scope.after_addition();
            $scope.search_packages();
            $scope.calculate_sum();

            //setTimeout ($scope.calculate_sum(),500);
            //$scope.calculate_sum();
           // $scope.calculate_sum();

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

            $http.post("{{route('find_item_interactions')}}",data)
                .then(function(response) {

                    $scope.myWelcome = response.data;
                    console.log($scope.myWelcome);

                    document.getElementById('interaction_warning').innerHTML = $scope.myWelcome['datas'];

                });

            $scope.search_packages();
            $scope.calculate_sum();

        }

        $scope.setSuccessMessage = function () {
            document.getElementById('success-message').innerHTML='Data Saved Successfully';
        }

        $scope.clearSuccessMessage = function () {
            document.getElementById('success-message').innerHTML='';
        }

        $scope.saveAll = function () {

            var date_given = document.getElementById('sale_date').value;

            if(date_given==null || date_given=="")
            {
                alert("Please Fill Date");
                return false;
            }

            var error = 0;

            var len = $scope.items_list.length;

            if(len>0) {

                var flag = false;
                var item_index = -1;

                // for (var i = 0; i < len; i++) {
                //
                //     $scope.items_list[i].freq = 10;// document.getElementById('freq_' + i).value;
                //     $scope.items_list[i].dosage = document.getElementById('dosage_' + i).value;
                //     $scope.items_list[i].uom = document.getElementById('uom_' + i).value;
                //     $scope.items_list[i].uod = document.getElementById('uod_' + i).value;
                //     $scope.items_list[i].route = document.getElementById('route_' + i).value;
                //     $scope.items_list[i].duration = document.getElementById('duration_' + i).value;
                //
                //     if ($scope.items_list[i].package_tracking == 1 || $scope.items_list[i].package_tracking == '1') {
                //         item_index = i;
                //         //id=package_x.item_id_x.barcode_id
                //         $scope.items_list[i].package = Number(document.getElementById('package_' + $scope.items_list[i].item_id+"_"+$scope.items_list[i].barcode_id).value);
                //         console.log("Package "+$scope.items_list[i].package);
                //
                //     } else {
                //         console.log('It doesnt exists');
                //         $scope.items_list[i].package = "-";
                //         console.log("Package "+$scope.items_list[i].package);
                //     }
                // }
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

             //           printDiv("apper");

                        $counts = $scope.items_list.length;
                        $scope.items_list.splice(0, $counts);
                        setTimeout(setSuccessMessage, 100);
                        setTimeout(clearSuccessMessage, 1500);
                        document.getElementById('total').innerText="0.00";

                        // Dont Delete

                        //alert("Saved");
                    }
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
                    $scope.total_amount+=Number($scope.items_list[i].qty * $scope.items_list[i].unit_price);
            }

            $scope.total_amount = (Number($scope.total_amount)).toFixed(2);


            document.getElementById("total").innerHTML=
                "<B><u>"+$scope.total_amount.toString()+"</u><BR/>";
        }

    }]);

    function printDiv(divID) {
        // //Get the HTML of div
        // var divElements = document.getElementById(divID).innerHTML;
        // //Get the HTML of whole page
        // var oldPage = document.body.innerHTML;
        //
        // //Reset the page's HTML with div's HTML only
        // document.body.innerHTML =
        //     "<html><head><title></title></head><body>" +
        //     divElements + "</body>";
        //
        // //Print Page
        // window.print();
        //
        // //Restore orignal HTML
        // document.body.innerHTML = oldPage;


        var printContents = document.getElementById(divID).innerHTML;
        w=window.open()
        w.document.write(printContents);
        w.print()
        w.close()

    }

    function together(){

    //setInterval(setSuccessMessage, 600)
    var scope = angular.element(document.getElementById('every_body')).scope();
    var retrunValue = scope.get_all_sales_items();
        // alert('weee');

    }

    function init() {
        //together()
        //setInterval(together, 500)
        setTimeout(together, 800)
        setTimeout(refresh_page_content, 2500)
        //setInterval(refresh_page_content(), 3000)
        // alert('Hiiii');
        // together();
 //       refresh_page_content();
    }

    window.onload =init;

    function refresh_page_content()
    {
        //setInterval(together, 500)
        //together();

        var scope = angular.element(document.getElementById('every_body')).scope();
        var retrunValue = scope.calculate_sum();
        //var retrunValue1 =scope.after_addition();
        var retrunValue3 =scope.search_packages();

        // var retrunValue4 =$scope.calculate_sum();
        // alert('wsdjlksdjf');

    }

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

<div class="col-sm-7 col-md-6 col-lg-6" style="background-color:#ddd; padding-top:20px; height:700px; overflow: scroll;">

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


<div class="top-search col-sm-6 col-md-6 col-lg-6" style="float:right;" >
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

<div class="items" style="width:100%; padding-left: -3px; margin-right:3px; padding-right: -30px; margin-bottom: -10px;">
        @foreach($products as $product )
            <?php
            $product->item_name;

            if($product->image!=null)
            {
            // there is image
            $variables =asset('images/products/')."/".$product->image;
            ?>

            <div id="cat_{{$product->category}}" class="item thumbnail cat_{{$product->category}}"
                 style="width:100px; height:110px; float:left; border:1px green; font-family:Cambria;
    margin-left:3px; font-size:9pt;border:0.1px solid green; margin-bottom: -15px; padding-bottom: -10px;">
                <div class="item-image"><img src="{{$variables }}" id="{{$product->barcode}}" width=88 height=65
                                             ng-click= "
               addItem('{{$product->item_name}} {{$product->variant_name}}', {{$product->id}},
            '{{$product->barcode_main}}',
@if($product->variants=='false')
                                                     '0','0',{{$product->unit_price}},0,
            @else
                                                     '{{$product->variant_barcode}}',{{$product->barcode_id}},{{$product->unit_price_variant}},
            @endif
                                             {{$product->package_tracking}},
{{--@if($product->variants=='false')--}}
                                             <?php
                                             if($product->variants=='false'){
                                                 //echo"0.00,";
                                             }else{
                                                 echo $product->unit_price_variant.",";
                                             }
                                             ?>
                                             {{--@else--}}
                                             {{--{{$product->unit_price_variant}},--}}
                                             {{--@endif--}}
                                             {{$product->variants}},'{{$product->item_name}}','-','-')"
                    >
                    <div class="item-footer" style="text-align:center; width: 110%;">{{$product->item_name}}-{{$product->variant_name}}</div>
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
                 style="width:100px; height:110px; float:left; margin-left:2px; background-color:#0f74a8; font-family:Cambria; color:white;
                 font-size:11pt;border:0.1px solid green; vertical-align: text-top; margin-bottom: 2px; "
                 id="{{$product->barcode}}"
                 ng-click="
            addItem('{{$product->item_name}} {{$product->variant_name}}', {{$product->id}},
            '{{$product->barcode_main}}',
@if($product->variants=='false')
                         '0','0',{{$product->unit_price}},0,
            @else
                         '{{$product->variant_barcode}}',{{$product->barcode_id}},{{$product->unit_price_variant}},
            @endif
                 {{$product->package_tracking}},
{{--@if($product->variants=='false')--}}
                         <?php
                         if($product->variants=='false'){
                             //echo"0.00,";
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
                    {{$product->variant_name}}</div>
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

            // $scope.addItem = function (item_name,item_id,barcode_main,barcode,barcode_id,unit_price,
            //                            package_tracking,unit_price_variant,variants,main_item_name,
            //                            package_id,package_name)

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

$(".insert_customer").click(function(e) {

//    get_customer_form();
    customer_name = document.getElementById('customer_name').value;
    age = document.getElementById('age').value;
    zone = document.getElementById('zone').value;
    telephone = document.getElementById('telephone').value;
    address = document.getElementById('address').value;
    contact_person = document.getElementById('contact_person').value;
    regular_customer_check = document.getElementById('regular_customer_check').value;
    remark = document.getElementById('remark').value;

    console.log(customer_name);
    console.log(age);
    console.log(zone);
    console.log(telephone);
    console.log(address);
    console.log(contact_person);
    console.log(regular_customer_check);
    console.log(remark);

//    console.log(data.success);

    $.ajax({
        type: 'GET',
        url: "{{ route('add_new_customer') }}",
        data: {
            customer_name: customer_name,
            age: age,
            zone: zone,
            telephone: telephone,
            address: address,
            contact_person: contact_person,
            regular_customer_check: regular_customer_check,
            remark,remark
        },
        success: function (data) {
            console.log(data.success)
            alert(data.success);
        }
    });

    document.getElementById('id01').style.display = 'none'

});
function insert_customer()
{
    customer_name = document.getElementById('customer_name').value;
    age = document.getElementById('age').value;
    zone = document.getElementById('zone').value;
    telephone = document.getElementById('telephone').value;
    address = document.getElementById('address').value;
    contact_person = document.getElementById('contact_person').value;
    regular_customer_check = document.getElementById('regular_customer_check').value;
    remark = document.getElementById('remark').value;
    //gender = document.getElementsByName('gender');
    //alert(gender);

    // if(document.getElementById('male')==true){
    //     var gender= 'male';
    // }else{
    //     var gender= 'female';
    // }

    // console.log(customer_name);
    // console.log(age);
    // console.log(zone);
    // console.log(telephone);
    // console.log(address);
    // console.log(contact_person);
    // console.log(regular_customer_check);
    // console.log(remark);

//    console.log(data.success);

    $.ajax({
        type: 'GET',
        url: "{{ route('add_new_customer') }}",
        data: {
            customer_name: customer_name,
            age: age,
            zone: zone,
            telephone: telephone,
            address: address,
            contact_person: contact_person,
            regular_customer: regular_customer_check,
            remark:remark,
      //      gender:gender,
        },
        success: function (data) {
            console.log(data.success)
            alert(data.success);

            document.getElementById('customer').innerText=data.success;
            document.getElementById('customer').innerHTML=data.success;

        }
    });

    document.getElementById('id01').style.display = 'none'
}
</script> 

<script type="text/javascript">

    function update_freq_js(o)
    {
       // alert(o.name);

        let sub_types=new Array();
        for (var i=0; i < o.options.length;i++){
            if(o.options[i].selected==true){
                sub_types.push(o.options[i].value)
            }
        }

        if(sub_types[0]!=null)
        {
            var scope = angular.element(document.getElementById('every_body')).scope();
            var retrunValue = scope.update_freq(o.name,sub_types[0]);
        }
}

    function update_duration_js(o)
    {
        //alert("Name"+ o.name);
        //alert(o.value);

        if(o.value!=null)
        {
            var scope = angular.element(document.getElementById('every_body')).scope();
            var retrunValue = scope.update_duration(o.name,o.value);
        }
    }

    function update_dosage_js(o)
    {
    //    alert("Name"+ o.name);
    //    alert(o.value);
        //
        // let sub_types=new Array();
        // for (var i=0; i < o.options.length;i++){
        //     if(o.options[i].selected==true){
        //         sub_types.push(o.options[i].value)
        //     }
        // }


        if(o.value!=null)
        {
            var scope = angular.element(document.getElementById('every_body')).scope();
            var retrunValue = scope.update_dosage(o.name,o.value);
        }
    }

    function update_uom_js(o)
    {
    //    alert("Name"+ o.name);

        let sub_types=new Array();
        for (var i=0; i < o.options.length;i++){
            if(o.options[i].selected==true){
                sub_types.push(o.options[i].value)
            }
        }

        if(sub_types[0]!=null)
        {
            var scope = angular.element(document.getElementById('every_body')).scope();
            var retrunValue = scope.update_uom(o.name,sub_types[0]);
        }
    }

    function update_uod_js(o)
    {
        //alert("Name"+ o.name);

        let sub_types=new Array();
        for (var i=0; i < o.options.length;i++){
            if(o.options[i].selected==true){
                sub_types.push(o.options[i].value)
            }
        }

        if(sub_types[0]!=null)
        {
            var scope = angular.element(document.getElementById('every_body')).scope();
            var retrunValue = scope.update_uod(o.name,sub_types[0]);
        }
    }

    function update_route_js(o)
    {
       // alert("Name"+ o.name);

        let sub_types=new Array();
        for (var i=0; i < o.options.length;i++){
            if(o.options[i].selected==true){
                sub_types.push(o.options[i].value)
            }
        }

        if(sub_types[0]!=null)
        {
            var scope = angular.element(document.getElementById('every_body')).scope();
            var retrunValue = scope.update_route(o.name,sub_types[0]);
        }
    }

    function update_package_js(o)
    {
        // alert("Name"+ o.name);

        let sub_types=new Array();

        for (var i=0; i < o.options.length;i++)
        {
            if(o.options[i].selected==true){
                sub_types.push(o.options[i].value)
            }
        }

        //alert("Selected Pkg: "+sub_types[0]);

        if(sub_types[0]!=null)
        {
            var scope = angular.element(document.getElementById('every_body')).scope();
            var retrunValue = scope.update_package(o.name,sub_types[0]);
        }
    }

    function update_qty_js(o)
    {
        if(o.value!=null)
        {
            var scope = angular.element(document.getElementById('every_body')).scope();
            var retrunValue = scope.update_qty(o.name,o.value);
            //alert(retrunValue);
        }
    }

    function get_pos_list_items(){
        $.ajax({

            type:'GET',

            url:"{{ route('get_pos_list')}}",

            data:{item_barcode:""},

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

            }
        });

    }

</script>

<div class="col-md-6">

<div class="row">

<!-- The Modal -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'"
class="close" title="Close Modal">&times;</span>

  <!-- Modal Content -->
  <div class="modal-content animate" action="#">

      <div class="imgcontainer" >
          <h3> <u>New Customer</u></h3>
      </div>

    <div class="container" style='width:70%;'>

        <table class="table">
            <tr><td>
                    <label>Customer Name</label></td><td>
                    <input name="customer_name"  type="text"
                           value="" class="form-control" id="customer_name" required>
                </td></tr>

            <tr><td>
                    <label>Telephone</label></td><td>
                    <input name="telephone" type="text"
                           value="" id="telephone" class="form-control">
                </td></tr>
            <tr><td>
                    <label>Address</label></td><td>
                    <input name="address" type="text"
                          id="address" value="" class="form-control">
                </td></tr>
            <tr><td>
                    <label>Remark</label></td><td>
                    <input name="remark" id="remark" type="text" value="" class="form-control">
                </td></tr>

        </table>

    <div>
      <button class="btn btn-primary" onclick="insert_customer();" ng-click="add_customer()">Submit</button>
      <button  type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn btn btn-danger">Cancel</button>
    </div>
    <br/><br/>
    </div>
  </div>
</div>



<form class="form-horizontal" action="{{route('new_sale')}}" method="post">
@csrf

<br/>
    <div class="col-md-4 col-md-4 col-lg-4">

    <label for="name">Customer</label>

    <div class="row">

    <select class="form-control col-md-5 col-md-5 col-lg-5" name="customer" id="customer">
                                                @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                                                @endforeach
    </select>

</div>
    </div>

    <div class="col-md-1 col-sm-1" style="margin-top: 8px; margin-left: -5px;">
<br/>
        <a href="#" class="btn btn-primary" role="button" onclick="get_customer_form();">
            <i class="fa fa-plus"></i>
        </a>

    </div>



    <div class="col-md-2 col-md-2 col-lg-2">
<label for="name">Payment</label>
<select class="form-control" id="payment" name="payment">
     <option value="Cash">Cash</option>
     <option value="Credit">Credit</option>                                          
</select>
</div>
<div class="col-md-3 col-md-3 col-lg-3">
<label for="name">Date</label>
<input type="date" id="sale_date" name="date" class="form-control" >
<br/><br/>
</div>

    <div class="col-md-2 col-sm-2 col-lg-2">
<br/>
        <a href="#" class="btn btn-sm btn-primary" role="button" onclick="refresh_page_content();">
            <i class="fa fa-refresh"></i> Refresh
        </a>
    </div>

</div>

<div id="apper">
<?php 
echo "
  <table class='table table-bordered table-responsive' style='width:110%;' id='POITable'>

  <tr>
  <th>Item</th>
  <th>Qty</th>
  <th>Price</th>
  <th>Total</th>
  <th></th>
  <th>Del</th>
  </tr>
  <tbody class='table_details'>
";

                echo'
 <tr ng-repeat="x in items_list" style="margin-left:0px;margin-right:0px; padding-left:0px; margin-left:0px;">
            <td>{{ x.item }}</td>

            <td><input type="text" value="{{ x.qty }}"  name="{{$index}}" onchange="update_qty_js(this);" onkeyup="update_qty_js(this);" style="width:40px;" /></td>
            <td>{{ x.unit_price }} </td>
            <td>{{ x.sub_total}} </td>
            <td> <div id="pkg_{{$index}}"></div></td>
            <td>
            <button class="btn btn-sm btn-danger" ng-click="removeItem($index);calculate_sum()">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
            </td>
        </tr>
';

echo "
</tbody>
  </table>";
?>
</div>


</div>

<div style="background-color:#ddd; display:block; width:46%; float:right;">

<span  style="font-size:18px; float:right; background-color:#ddd; margin-right:160px;" id="total">0.00</span>

<span style="font-size:18px; background-color:#ddd; float:right;">Total: &nbsp;&nbsp;&nbsp;</span>

<br/><br/>
    <div id="success-message" style="color:green;float:right; font-weight: bold;"></div>
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

// $(".submit_test").click(function(e) {
//     //get_customer_form();
// });

$(".submit_test").click(function(e)
{
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

});


function clearData()
{
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
  document.getElementById('interaction_warning').innerHTML="";
  document.getElementById('pregnancy_warning').innerHTML="";

  calculateTotalAmount();
}


function update_item_package(index){

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
}

$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});


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

<script type="text/javascript">
    function get_customer_form() {
        document.getElementById('id01').style.display='block';
    }
</script>
<script>

    // Data tables
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


</script>

<div class="jvectormap-label"></div>


</body>
</html>
