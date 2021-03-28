
@extends('layouts.app')

@section('content')

<div class="form-group row add">   
 <div class="col-md-8">        
 
 <input type="text" class="form-control" id="name" name="name"  placeholder="Enter some name" required>
         <p class="error text-center alert alert-danger hidden"></p>   
 </div>    
 
 <div class="col-md-4">        
 <button class="btn btn-primary" type="submit" id="add">            
 <span class="glyphicon glyphicon-plus"></span> ADD        </button>    </div></div>


<script>

$("#add").click(function() {$.ajax ({

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

    @endsection
