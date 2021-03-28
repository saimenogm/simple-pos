
@extends('layouts.app')

@section('content')
<div class="row">

<div class="col-md-6 col-sm-6">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">Session</h3>
</div>
<div class="panel-body">

      <div class="row">
      <div class="medium-7 large-7 columns">

          <button  id='new_session' class="btn btn-info" onclick="window.location.href = 'http://127.0.0.1:8000/sales/session/new';"><span> New Session</span></button>
           <button class="btn btn-info" id='continue_session' onclick="window.location.href = 'http://127.0.0.1:8000/sales/session/continue';" ><span > Continue Session</span> </button>
  <button class="btn btn-info" id='close_session' onclick="window.location.href = 'http://127.0.0.1:8000/sales/session/close';"><span >Close Session</span> </button>
            
        

    </div>
    </div> 
    </div>
    <script>
    
    if ( {{ $check }})
    {
      
        document.getElementById('new_session').disabled=true

    }
    else
    {

      document.getElementById('continue_session').disabled=true
      document.getElementById('close_session').disabled=true

    }
  </script>


    @endsection
