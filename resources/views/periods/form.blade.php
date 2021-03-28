@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New Period</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
        <form action="" method="post">

        @csrf
        <table class="table">

        <tr><td>
            <label>Period Name</label></td><td>
            <input name="period_name" type="text" value="">
          </td></tr>
          <tr><td>
            <label>Strat Date</label></td><td>
            <input name="start_date" type="text" value="">
        </td></tr>
        
        <tr><td>
            <label>End Date</label></td><td>
            <input name="end_date" type="text" value="">
        </td></tr>

        <tr><td>
            <label>Description</label></td><td>
            <input name="description" type="text" value="">
        </td></tr>
        <tr><td>
        <div class="medium-12  columns">
        <button type='Submit' role='button' class='btn btn-primary'> <i class='fa fa-fw fa-save'></i> Save </button>
            
          </div>
        </td>
</tr>

        </form>
      </div>
    </div>
    </div>
    @endsection