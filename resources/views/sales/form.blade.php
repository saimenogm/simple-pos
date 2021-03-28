
@extends('layouts.app')

@section('content')



<SCRIPT language="javascript">

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

	</SCRIPT>



<SCRIPT language="javascript">

		function addRow(tableID) {

			var table = document.getElementById(tableID);

			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);

			var colCount = table.rows[0].cells.length;

			for(var i=0; i<colCount; i++) {

				var newcell	= row.insertCell(i);

				newcell.innerHTML = table.rows[0].cells[i].innerHTML;
				//alert(newcell.childNodes);
				switch(newcell.childNodes[0].type) {
					case "text":
							newcell.childNodes[0].value = "Heljskfjsdlf";
							//newcell.childNodes[0].value = "";
							break;
					case "checkbox":
							newcell.childNodes[0].checked = false;
							break;
					case "select-one":
							newcell.childNodes[0].selectedIndex = 0;
							break;
				}
			}
		}

	function addRowItem(tableID,item,price) 
	{

	var table = document.getElementById(tableID);

	var rowCount = table.rows.length;
	//var row = table.insertRow(rowCount);
	//row.innerHTML = "<td>" + item +"</td><td>"+ price +"</td>"

	var row = table.insertRow(rowCount);

	var colCount = table.rows[0].cells.length;
	//alert(colCount);
	for(var i=0; i<colCount; i++) {

		var newcell	= row.insertCell(i);

		//newcell.innerHTML = table.rows[1].cells[i].innerHTML;
		//alert(newcell.childNodes);
		
		switch(newcell.childNodes[0].type) {
			alert("hello");
			case "text":
			if(i==0){
				newcell.innerHTML =item;
					newcell.childNodes[0].innerHTML = item;
					alert(newcell.innerHTML);
				}
					//newcell.childNodes[0].value = "";
					break;
			case "checkbox":
					newcell.childNodes[1].checked = false;
					break;
			case "select-one":
					newcell.childNodes[1].selectedIndex = 0;
					break;
		}
	}
//var colCount = table.rows[0].cells.length;



/*
var newcell	= row.insertCell(0);
newcell.type = "select-one";
newcell.name = "items[]";
newcell.innerHTML = item ;
	//newcell.innerHTML = table.rows[0].cells[i].innerHTML;
	//alert(newcell.childNodes);
				 
	//			newcell.childNodes[0].value = "Heljskfjsdlf";
				//newcell.childNodes[0].value = "";
var newcell	= row.insertCell(1);
newcell.name = "prices[]";
newcell.innerHTML = price;


//newcell.type = "text";
//newcell.childNodes[0].value = "Test12313";
	
	*/
	}



//row.innerHTML = "<td>Hello </td><td>World</td>"
//var colCount = table.rows[0].cells.length;

//for(var i=0; i<colCount; i++) {

  //var newcell	= row.insertCell(i);

  //newcell.innerHTML = table.rows[0].cells[i].innerHTML;
  //alert(newcell.childNodes);
  //switch(newcell.childNodes[0].type) {
    /*
    case "text":
        newcell.childNodes[0].value = "";
        newcell.childNodes[0].value = "";
        break;
    case "checkbox":
        newcell.childNodes[0].checked = false;
        break;
    case "select-one":
        newcell.childNodes[0].selectedIndex = 0;
        break;
        */

//  }
//}
//}

		function deleteRow(tableID) {
			try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					if(rowCount <= 1) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
			}catch(e) {
				alert(e);
			}
		}

	</SCRIPT>


<div class="row">
      <div class="medium-12 large-12 columns">
        <form action="{{route('new_sale')}}" method="post">
          <div class="medium-4  columns">
            <label>Customer</label>
            <select name="customer">
            @foreach($customers as $customer )
            <option value="{{ $customer->id}}">{{$customer->first_name}}</option>
            @endforeach            
            </select>
          </div>

          <div class="medium-8  columns">
            <label>Reference</label>
            <input name="ref" type="text" value="">
          </div>

          <div class="medium-8  columns">
            <label>Date</label>
            <input name="date" type="date" value="">
          </div>


          <div class="items">
          @foreach($products as $product )
          <input type="button" value="{{$product->product_name}}" onclick="addRowItem('salesItems','{{$product->product_name}}','{{$product->selling_price}}')" />
          @endforeach            
          </div>


          <INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />

        	<INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" />


  <Table id="salesItems" border="1">
  <thead>
	<TR>
    <th>Item</th>
    <th>Quantity</th>
    <th>Price</th>
		<th>Tax</th>
		<th>Discount</th>
		<th>Sub totals</th>

  </TR>
	</thead>

	<TR hidden=True>
              <TD><INPUT type="text" disabled name="items[]"/></TD>
              <TD><INPUT type="text" disabled name="unit_prices[]"/></TD>
              <TD><INPUT type="text" disabled name="qtys[]"/></TD>
							<TD><INPUT type="text"  name="taxes[]"/></TD>
							<TD><INPUT type="text"  name="discounts[]"/></TD>
							<TD><INPUT type="text"  name="sub_total[]"/></TD>
              <TD><INPUT type="checkbox" name="chk[]"/></TD>
            </TR>
  </Table>


          <TABLE id="dataTable" width="350px" border="1">
            <TR hidden=True>
              <TD><INPUT type="checkbox" name="chk[]"/></TD>
              <TD><INPUT type="text" disabled name="items[]"/></TD>
              <TD><INPUT type="text" disabled name="unit_prices[]"/></TD>
              <TD><INPUT type="text" disabled name="qtys[]"/></TD>
							<TD><INPUT type="text"  name="taxes[]"/></TD>
            </TR>
          </TABLE>
        <div class="medium-12  columns">
            <input value="SAVE" class="button success hollow" type="submit" />
          </div>

        </form>
      </div>
    </div>

