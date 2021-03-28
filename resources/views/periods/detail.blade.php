
@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title">New period</h3>
</div>
<div class="panel-body">
<div class="block-content">
                                <!-- purchuse section --> 
                                <!-- BASIC SELECT -->
                        <div class="block">                                                  


      <div class="row">
      <div class="medium-12 large-12 columns">
<table class="table">
<form action="{{ $modify == 1 ? route('update_period', [ 'period_id' => $period_id ]) : route('create_period') }}" method="post">
@csrf

<tr><td>
            <label>period Name</label></td><td>
            <input name="period_name" type="text" value="{{ old('period_name') ? old('period_name') : $period_name }}">
            <small class="error">{{$errors->first('period_name')}}</small>


</td></tr>
<tr><td>
            <label>Start Date</label></td><td>
            <input name="start_date" type="text" value="{{ old('start_date') ? old('start_date') : $start_date }}">
            <small class="error">{{$errors->first('start_date')}}</small>

</td></tr><tr><td>
            <label>End Date</label></td><td>
            <input name="end_date" type="text" value="{{ old('end_date') ? old('end_date') : $end_date }}">
            <small class="error">{{$errors->first('end_date')}}</small>

</td></tr>
<tr><td>
            <input value="SAVE" class="button success hollow" type="submit">
</div>
</form>
</table>
</div>
    </div>
    </div>

@endsection