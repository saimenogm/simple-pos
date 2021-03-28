
@extends('layouts.app')

@section('content')


<div class="col-md-12">
						<div class="widget">
							<div class="widget-header transparent">
								<h2><strong>Toolbar</strong> CRUD Table</h2>
								<div class="additional-btn">
									<a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
									<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
									<a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
								</div>
							</div>
							<div class="widget-content">
								<div class="data-table-toolbar">
									<div class="row">
										<div class="col-md-4">
											<form role="form">
											<input type="text" class="form-control" placeholder="Search...">
											</form>
										</div>
										<div class="col-md-8">
											<div class="toolbar-btn-action">
												<a class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
												<a class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
												<a class="btn btn-primary"><i class="fa fa-refresh"></i> Update</a>
											</div>
										</div>
									</div>
								</div>
									
								<div class="table-responsive">
									<table data-sortable="" class="table table-hover table-striped" data-sortable-initialized="true">
										<thead>
											<tr>
												<th>No</th>
												<th style="width: 30px" data-sortable="false"><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></th>
												<th>Full Name</th>
												<th>Location</th>
												<th>Date of birth</th>
												<th>Email</th>
												<th data-sortable="false">Sort : Off</th>
												<th>Status</th>
												<th data-sortable="false">Option</th>
											</tr>
										</thead>
										
										<tbody>
											<tr>
												<td>1</td><td><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td><td><strong>John Doe</strong></td>
												<td>Yogyakarta, Indonesia</td><td>January 01, 1985</td><td><a href="mailto:#">name@domain.com</a></td>
												<td>123</td><td><span class="label label-success">Active</span></td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>2</td><td><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td><td><strong>Rusmanovski</strong></td>
												<td>Bali, Indonesia</td><td>september 21, 1995</td><td><a href="mailto:#">name@domain.com</a></td>
												<td>123</td><td><span class="label label-success">Active</span></td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>3</td><td><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td><td><strong>Annisa</strong></td>
												<td>London, UK</td><td>September 23, 1996</td><td><a href="mailto:#">name@domain.com</a></td>
												<td>123</td><td><span class="label label-success">Active</span></td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>4</td><td><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td><td><strong>Ari Rusmanto</strong></td>
												<td>Jakarta, Indonesia</td><td>January 01, 1990</td><td><a href="mailto:#">name@domain.com</a></td>
												<td>123</td><td><span class="label label-success">Active</span></td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>5</td><td><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td><td><strong>Jenny Doe</strong></td>
												<td>New York, US</td><td>March 11, 1975</td><td><a href="mailto:#">name@domain.com</a></td>
												<td>123</td><td><span class="label label-danger">Suspended</span></td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>6</td><td><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td><td><strong>Hana Sartika</strong></td>
												<td>Semarang, Indonesia</td><td>June 23, 1991</td><td><a href="mailto:#">name@domain.com</a></td>
												<td>123</td><td><span class="label label-success">Active</span></td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>7</td><td><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td><td><strong>Tukimin</strong></td>
												<td>Surakarta, Indonesia</td><td>August 17, 1945</td><td><a href="mailto:#">name@domain.com</a></td>
												<td>123</td><td><span class="label label-success">Active</span></td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>8</td><td><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td><td><strong>Johnny Depp</strong></td>
												<td>Paris, French</td><td>October 30, 1972</td><td><a href="mailto:#">name@domain.com</a></td>
												<td>123</td><td><span class="label label-warning">Deactivated</span></td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>9</td><td><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td><td><strong>Mas Arie</strong></td>
												<td>Boyolali, Indonesia</td><td>January 01, 1990</td><td><a href="mailto:#">name@domain.com</a></td>
												<td>123</td><td><span class="label label-success">Active</span></td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
											<tr>
												<td>10</td><td><div class="icheckbox_square-aero" style="position: relative;" aria-checked="false" aria-disabled="false"><input type="checkbox" class="rows-check" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div></td><td><strong>Rusmanto</strong></td>
												<td>Bandung, Indonesia</td><td>February 28, 1992</td><td><a href="mailto:#">name@domain.com</a></td>
												<td>123</td><td><span class="label label-success">Active</span></td>
												<td>
													<div class="btn-group btn-group-xs">
														<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>
														<a data-toggle="tooltip" title="Edit" class="btn btn-default"><i class="fa fa-edit"></i></a>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
									
								<div class="data-table-toolbar">
									<ul class="pagination">
									  <li class="disabled"><a href="#">«</a></li>
									  <li class="active"><a href="#">1</a></li>
									  <li><a href="#">2</a></li>
									  <li><a href="#">3</a></li>
									  <li><a href="#">4</a></li>
									  <li><a href="#">5</a></li>
									  <li><a href="#">»</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>

<div class="row">
      <div class="medium-12 large-12 columns">
        <h4>Clients</h4>
        <div class="medium-2  columns"><a class="button hollow success" href="{{ route('new_customer') }}">ADD NEW CLIENT</a></div>



        <table class="table table-bordered">
<caption>Striped Table Layout</caption>
<thead>
<tr>
<th>Name</th>
<th>City</th>
<th>Pincode</th>
</tr>
</thead>
<tbody>
<tr>
<td>Tanmay</td>
<td>Bangalore</td>
<td>560001</td>
</tr>
<tr>
<td>Sachin</td>
<td>Mumbai</td>
<td>400003</td>
</tr>
<tr>
<td>Uma</td>
<td>Pune</td>
<td>411027</td>
</tr>
</tbody>
</table>


        <div class="table-responsive">
        
<div id="datatables-4_wrapper" class="dataTables_wrapper form-inline"><div class="DTTT_container"><a class="DTTT_button DTTT_button_copy" id="ToolTables_datatables-4_0"><span>Copy</span><div style="position: absolute; left: 0px; top: 0px; width: 44px; height: 28px; z-index: 99;"><embed id="ZeroClipboard_TableToolsMovie_1" src="./assets/libs/jquery-datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf" loop="false" menu="false" quality="best" bgcolor="#ffffff" name="ZeroClipboard_TableToolsMovie_1" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="id=1&amp;width=44&amp;height=28" wmode="transparent" width="44" height="28" align="middle"></div></a><a class="DTTT_button DTTT_button_csv" id="ToolTables_datatables-4_1"><span>CSV</span><div style="position: absolute; left: 0px; top: 0px; width: 40px; height: 28px; z-index: 99;"><embed id="ZeroClipboard_TableToolsMovie_2" src="./assets/libs/jquery-datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf" loop="false" menu="false" quality="best" bgcolor="#ffffff" name="ZeroClipboard_TableToolsMovie_2" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="id=2&amp;width=40&amp;height=28" wmode="transparent" width="40" height="28" align="middle"></div></a><a class="DTTT_button DTTT_button_xls" id="ToolTables_datatables-4_2"><span>Excel</span><div style="position: absolute; left: 0px; top: 0px; width: 45px; height: 28px; z-index: 99;"><embed id="ZeroClipboard_TableToolsMovie_3" src="./assets/libs/jquery-datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf" loop="false" menu="false" quality="best" bgcolor="#ffffff" name="ZeroClipboard_TableToolsMovie_3" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="id=3&amp;width=45&amp;height=28" wmode="transparent" width="45" height="28" align="middle"></div></a><a class="DTTT_button DTTT_button_pdf" id="ToolTables_datatables-4_3"><span>PDF</span><div style="position: absolute; left: 0px; top: 0px; width: 40px; height: 28px; z-index: 99;"><embed id="ZeroClipboard_TableToolsMovie_4" src="./assets/libs/jquery-datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf" loop="false" menu="false" quality="best" bgcolor="#ffffff" name="ZeroClipboard_TableToolsMovie_4" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="id=4&amp;width=40&amp;height=28" wmode="transparent" width="40" height="28" align="middle"></div></a><a class="DTTT_button DTTT_button_print" id="ToolTables_datatables-4_4" title="View print view"><span>Print</span></a></div><div class="clear"></div><div class="dataTables_length" id="datatables-4_length"><label><select name="datatables-4_length" aria-controls="datatables-4" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records per page</label></div><div id="datatables-4_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" aria-controls="datatables-4"></label></div><table id="datatables-4" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="datatables-4_info" style="width: 100%;" width="100%" cellspacing="0">
									    <thead>
									        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datatables-4" rowspan="1" colspan="1" style="width: 171px;" aria-sort="ascending" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="datatables-4" rowspan="1" colspan="1" style="width: 271px;" aria-label="Position: activate to sort column ascending">Position</th><th class="sorting" tabindex="0" aria-controls="datatables-4" rowspan="1" colspan="1" style="width: 134px;" aria-label="Office: activate to sort column ascending">Office</th><th class="sorting" tabindex="0" aria-controls="datatables-4" rowspan="1" colspan="1" style="width: 48px;" aria-label="Age: activate to sort column ascending">Age</th><th class="sorting" tabindex="0" aria-controls="datatables-4" rowspan="1" colspan="1" style="width: 109px;" aria-label="Start date: activate to sort column ascending">Start date</th><th class="sorting" tabindex="0" aria-controls="datatables-4" rowspan="1" colspan="1" style="width: 109px;" aria-label="Salary: activate to sort column ascending">Salary</th></tr>
									    </thead>
          <tbody>

          @foreach( $customers as $customer )
              <tr>
               <td> <td>
                <td>{{ $customer->first_name }} {{ $customer->middle_name }} {{ $customer->last_name }}</td>
                <td>{{ $customer->telephone }}</td>
                <td>{{ $customer->address }}</td>
                <td><a class="hollow button" href="{{ route('show_customer', ['customer_id' => $customer->id ]) }}">EDIT</a></td>

              </tr>
          @endforeach

              
                      </tbody>
                      </table><div class="dataTables_info" id="datatables-4_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div><div class="dataTables_paginate paging_bootstrap" id="datatables-4_paginate"><ul class="pagination"><li class="prev disabled"><a href="#" title="Previous"><i class="fa fa-angle-left"></i></a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#" title="Next"><i class="fa fa-angle-right"></i></a></li></ul></div></div>
        
      </div>
    </div>

@endsection