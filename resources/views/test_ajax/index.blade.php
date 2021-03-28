

<!Doctype html>
<html>
<head>
<meta name="_token" content="{{ csrf_token() }}">

<script type="text/javascript" src="{{ asset('jqujquery1.js}}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-2.1.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-3.1.0.js')}}"></script>

</head>

<body>


           <div class="form-group row add">   
 <div class="col-md-8">        
 
 <input type="text" class="form-control" id="name" name="name"  placeholder="Enter some name" required>
         <p class="error text-center alert alert-danger hidden"></p>   
 </div>    
 
 <div class="col-md-4">        
 <button class="btn btn-primary" type="submit" id="add">            
 <span class="glyphicon glyphicon-plus"></span> ADD        </button>    </div></div>



<div class="table-responsive text-center">    
<table class="table table-borderless" id="table">       
 <thead>            
 <tr>                
 <th class="text-center">#</th>                
 <th class="text-center">Name</th>                
 <th class="text-center">Actions</th>            
 </tr>        
 </thead>        
 @foreach($data as $item)        
 <tr class="item{{$item->id}}">            
 <td>{{$item->id}}</td>            
 <td>{{$item->name}}</td>            
 <td><button class="edit-modal btn btn-info" data-id="{{$item->id}}"                    
 data-name="{{$item->name}}">                    
 <span class="glyphicon glyphicon-edit"></span> Edit                </button>                <button class="delete-modal btn btn-danger" data-id="{{$item->id}}"                    data-name="{{$item->name}}">                    <span class="glyphicon glyphicon-trash"></span> Delete                </button></td>        </tr>        @endforeach    </table></div>


 <script type="text/javascript">

$("#add").click(function() {$.ajax ({

//alert("helll");

    type: 'post',        
    url: '/addItem',
    data: {            
        '_token': $('input[name=_token]').val(),
        'name': $('input[name=name]').val()
                },        
            success: function(data) {
            if ((data.errors)) {               
                 $('.error').removeClass('hidden');                
                 $('.error').text(data.errors.name);            
                 } else {                
                     $('.error').remove();                
                     $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

         }
    },
});

$('#name'.val(''));

});
</script>


