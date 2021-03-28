
@extends('layouts.app')

@section('content')


    <script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>

    <script>

        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        $("#vital_signs_but").click(function(e){

//alert('sigmen');
            console.log('shkdflsjd');
        })

    </script>

    <div class="col-md-12 col-sm-12">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Customer Details</h3>
            </div>
            <div class="panel-body">
                <div class="block-content">
                    <!-- purchuse section -->
                    <!-- BASIC SELECT -->


                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <form role='form' action="{{ $modify == 1 ? route('update_customer', [ 'customer_id' => $customer_id ]) : route('create_customer') }}" method="post"  enctype="multipart/form-data">

                                <table class="table">
                                    @csrf
                                    <input id='customer_id' hidden=true value='{{ $customer_id }}'/>
                                    <tr><td>
                                            <label>Patient Name</label></td><td>
                                            <input name="customer_name" type="text" value="{{ old('customer_name') ? old('customer_name') : $customer_name }}" class="form-control" required>
                                            <small class="error">{{$errors->first('customer_name')}}</small>
                                        </td></tr>
                                    <tr><td>
                                            <label>Age</label></td><td>
                                            <input name="age" type="text" value="{{ old('age') ? old('age') : $age }}" class="form-control">
                                            <small class="error">{{$errors->first('age')}}</small>
                                        </td></tr>

                                    <tr><td> <label>Contact Person</label></td><td>
                                            <input name="contact_person" type="text" value="{{ old('contact_person') ? old('contact_person') : $contact_person }}" class="form-control">
                                            <small class="error">{{$errors->first('contact_person')}}</small>
                                        </td></tr>

                                    <tr hidden=true><td>

                                            <input id='gend' name="gender" type="text" value="{{ old('gender') ? old('gender') : $gender }}" class="form-control">
                                            <input id='preg' name="preg" type="text" value="{{ old('preg') ? old('preg') : $preg }}" class="form-control">
                                            <input id='reg_cust' name="reg_cust" type="text" value="{{ old('regular_customer') ? old('regular_customer') : $regular_customer }}" class="form-control">

                                        </td></tr>


                                    <tr>
                                        <td><label>Gender</label></td>
                                        <td>
                                            <label>Male </label> <input id='male' name="gender" type="radio" value="male" onchange='gen(this);'> &nbsp;
                                        <label>Female </label> <input id='female' name="gender" type="radio" value="female" onchange='gen(this);'></td></tr>

                                    <tr id='pregnancy' hidden><td>
                                            <label>Pregnant</label></td><td>
                                            <input id='pregnant' name="pregnant" type="checkbox" value="yes" onchange='preg_checker(this)'>
                                        </td></tr>
                                    <tr id='tri_tr' hidden><td>
                                            <label>Trimester</label></td><td>
                                            <select name="trimester" value="" class="form-control" >
                                                <option value="{{ old('tri') ? old('tri') : $tri }}">{{ old('tri') ? old('tri') : $tri }}</option>
                                                <option value='first'>First Stage</option>
                                                <option value="second">Second Stage</option>
                                                <option value="third">Third Stage</option>
                                            </select>
                                        </td></tr>
                                    <tr id='blood_type' hidden><td>
                                            <label>Blood type</label></td><td>
                                            <select id='blood_' name="blood_" value="" class="form-control" >
                                                <option  value="{{ old('blood_') ? old('blood_') : $blood_type }}">{{ old('blood_') ? old('blood_') : $blood_type }}</option>
                                                <option value='o+'>O+</option>
                                                <option value="o-">O-</option>
                                                <option value="a+">A+</option>
                                                <option value='a-'>A-</option>
                                                <option value="b-">B-</option>
                                                <option value="b+">B+</option>
                                                <option value='ab+'>AB+</option>
                                                <option value="ab-">AB-</option>


                                            </select>
                                        </td></tr>


                                </table>
                        </div>
                        <div class= "col-md-6 col-sm-6">
                            <table class="table">


                                <tr><td>
                                        <label>Zone</label></td><td>
                                        <select class="form-control" name="zone" required>
                                            <option value="{{ old('zone') ? old('zone') : $zone }}">{{ old('zone') ? old('zone') : $zone }}</option>
                                            <option value="Zoba Maekel">Maekel</option>
                                            <option value="Zoba Anseba">Anseba</option>
                                            <option value="Gash Barka">Gash Barka</option>
                                            <option value="Debub">Debub</option>
                                            <option value="Debubawi K. Bahri">Debubawi K. Bahri</option>
                                            <option value="Semenawi K. Bahri">Semenawi K. Bahri</option>
                                        </select>
                                    <td></tr>
                                <tr><td> <label>City</label></td><td>
                                        <input name="city" type="text" value="{{ old('city') ? old('city') : $city }}" class="form-control">
                                        <small class="error">{{$errors->first('account_number')}}</small>
                                    </td></tr>

                                <tr><td>
                                        <label>Mobile</label></td><td>
                                        <input name="mobile" type="text" value="{{ old('mobile') ? old('mobile') : $mobile }}" class="form-control">
                                        <small class="error">{{$errors->first('mobile')}}</small>
                                    </td></tr>

                                <tr><td>
                                        <label>Remark</label></td><td>
                                        <input name="remark" type="text" value="{{ old('remark') ? old('remark') : $remark }}" class="form-control">
                                        <small class="error">{{$errors->first('remark')}}</small>
                                    </td></tr>

                                <tr><td>
                                        <label>Regular Customer</label></td><td>
                                        <input id='regular_customer_check' name="regular_customer_check" type="checkbox" value="yes">
                                    </td></tr>
                                <tr>
                                    <td><label>Customer Balance</label></td>
                                    <td>
                                        <select class="form-control" name="balance_type">
                                            <option value="{{ old('balance_type') ? old('balance_type') : $balance_type }}">{{ old('balance_type') ? old('balance_type') : $balance_type }}</option>
                                            <option value="unpaid">Unpaid</option>
                                            <option value="overpaid">Overpaid</option>
                                        </select>
                                        <input type="text" class="form-control" name="balance_amount" value="{{ old('balance_amount') ? old('balance_amount') : $balance_amount }}" required />

                                    </td></tr>

                            </table>
                        </div>
                        <div style="float:right;">
                            <input type='submit' class='btn btn-primary' value='Update'/>
                            <a role='button' href="{{route('show_customer_history',
                            [ 'customer_id' => $customer_id ])}}" class='btn btn-success'> <i class="fa fa-print"></i> <i>Print Full Information</i> </a>
                        </div>
                        </form>
                    </div>

                    <br/><br/>


                    <!--     Tab     -->


                    <ul id="myTab" class="nav nav-tabs">
                        <li class="active"><a href="#vital_signs" data-toggle="tab"><B>Daily Vital Signs</B></a></li>
                        <li><a href="#diagnosis" data-toggle="tab"><B>Diagnosis</B></a></li>
                        {{--<li ><a href="#medical_history" data-toggle="tab">Medical History</a></li>--}}
                        <li ><a href="#drug_history" data-toggle="tab"><B>Drug History</B></a></li>
                        <li ><a href="#allergy" data-toggle="tab"><B>Allergy</B></a></li>
                        <li ><a href="#prescription" data-toggle="tab"><B>Prescriptions</B></a></li>
                        <li ><a href="#soap" data-toggle="tab"><B>SOAP(Progress Report)</B></a></li>

                        <?php
                        if ($regular_customer == 'Yes' || $regular_customer == 'yes' )
                        {?>
                        <li ><a href="#appointment" data-toggle="tab"><B>Appointment</B></a></li>
                        <?php
                        }?>
                    </ul>

                    <div id="myTabContent" class="tab-content">





                        <!-- diagnosis -->

                        <div class="tab-pane fade in" id="diagnosis" >

<br/><br/>

                            <table id="table_diagnosis"  style="width:90%;" class="tab-content table-bordered table-striped table-responsive" >

                                <thead class="thead-inverse">
                                <tr>
                                    <th>Date</th>
                                    <th>Diagnosis</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Save</th>

                                </tr>
                                </thead>
                                <tr>

                                    <TD><INPUT type="date" class="form-control" name ="date_diagnosis" id="date_diagnosis"/></TD>
                                    <TD><INPUT type="text" class="form-control" name="disease_diagnosis" id="disease_diagnosis" placeholder="Disease"  /></TD>
                                    <TD><INPUT type="text" class="form-control" name="description_diagnosis"   id="description_diagnosis" placeholder="Description"  /></TD>
                                    <TD><INPUT type="text" class="form-control" name ="status_diagnosis" id="status_diagnosis"  placeholder="Status"  /></TD>

                                <td>
                                        <button id='diagnosis_id' class='btn diagnosis_id btn-primary'> <i>Save</i> </button>
                                    </td></tr>
                            </table>

                            <br/><br/>
                            <table id="table_diagnosis2"  class="table table-form">
                                <thead class="thead-inverse">
                                <tr>
                                    <th>Date</th>
                                    <th>Diagnosis</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>

                                </thead>
                                <tbody id='diagnosis_detail'>
                                @foreach($diagnosis_list as $diagnosis)
                                    <tr >
                                        <TD>{{$diagnosis->date}}</TD>
                                        <TD>{{$diagnosis->diagnosis}}</TD>
                                        <TD>{{$diagnosis->description}}</TD>
                                        <TD>{{$diagnosis->status}}</TD>

                                        <td><button class="btn btn-success btn-sm" onclick='edit_diagnosis(this)' value="{{$diagnosis->id}}"><i class="fa fa-edit"></i> Edit</button></td>
                                        <td><button class="btn btn-danger delete_diagnosis_btn btn-sm"  onclick=' del_diagnosis(this)' value="{{$diagnosis->id}}" >
                                                <i class="fa fa-trash"></i> Delete</button></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        <!-- Drug History -->



                        <div class="tab-pane fade in" id="drug_history" >

<br/>

                            <table id="table_diagnosis"   class="tab-content table-responsive table-bordered table" >
                                <thead class="thead-inverse">
                                <tr>
                                    <th>Drug</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Disease</th>
                                    <th>Drug Taking</th>

                                </tr>
                                </thead>
                                <tr>
                                    <TD><select class="form-control" id="drug_history_drug"  name="drug_history_drug" >
                                            <option></option>
                                            @foreach ($items as $item)
                                                <option value="{{$item->item_name}}" id="item" name="{{$item->id}}">{{$item->item_name}}</option>
                                            @endforeach
                                        </select>
                                    </TD>

                                    <TD><INPUT type="date" class="form-control" name ="from_date" id="from_date"/></TD>
                                    <TD><INPUT type="date" class="form-control" name ="to_date" id="to_date"/></TD>
                                    <TD><INPUT type="text" class="form-control" name="drug_history_disease" id="drug_history_disease" placeholder="Disease"  /></TD>
                                    <TD><select  class="form-control" name="currently_taking"   id="currently_taking">
                                            <option></option>
                                            <option value="Completed">Completed</option>
                                            <option value="Taking">Taking</option>
                                            <option value="Terminated">Terminated</option>
                                            <option value="On rest">On rest</option>
                                    </TD>
                                    <td>
                                        <button id='drug_id' class='btn drug_id btn-primary btn-sm'> <i>Save</i> </button>
                                    </td></tr>
                            </table>

                            <table id="table_diagnosis2"  class="table table-form table-responsive table-bordered">
                                <thead class="thead-inverse">
                                <tr>
                                    <th>Drug</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Disease</th>
                                    <th>Drug Taking</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>

                                </thead>
                                <tbody id='drug_detail'>
                                @foreach($drug_history as $drug_hist)
                                    <tr >
                                        <TD>{{$drug_hist->drug_taken}}</TD>
                                        <TD>{{$drug_hist->from_date}}</TD>
                                        <TD>{{$drug_hist->to_date}}</TD>
                                        <TD>{{$drug_hist->disease}}</TD>
                                        <TD>{{$drug_hist->currently_taking}}</TD>

                                        <td><button class="btn btn-success btn-sm " onclick='edit_drug_history(this)' value="{{$drug_hist->id}}"><i class="fa fa-edit"></i> Edit  </span></button></td>
                                        <td><button class="btn btn-danger btn-sm" onclick='del_drug_history(this)' value="{{$drug_hist->id}}" >
                                                <i class="fa fa-trash"></i> Delete</button></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!--   Medical history   -->


                        {{--<div class="tab-pane fade in" id="medical_history" >--}}
                            {{--<table id="table_diagnosis"   class="tab-content" >--}}
                                {{--<thead class="thead-inverse">--}}
                                {{--<tr>--}}
                                    {{--<th>Drug</th>--}}
                                    {{--<th>From </th>--}}
                                    {{--<th>To</th>--}}
                                    {{--<th>Disease</th>--}}
                                    {{--<th>Currentyl taking</th>--}}

                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tr>--}}


                                    {{--<TD><INPUT type="text" class="form-control" name ="" id=""  placeholder="Status"  /></TD>--}}
                                    {{--<TD><INPUT type="date" class="form-control" name ="" id=""></TD>--}}
                                    {{--<TD><INPUT type="date" class="form-control" name ="" id=""/></TD>--}}
                                    {{--<TD><INPUT type="text" class="form-control" name="" id="" placeholder="Disease"  /></TD>--}}
                                    {{--<TD><INPUT type="checkbox" class="form-control" name=""   id=""   /></TD></tr>--}}

                                {{--<tr><td>--}}
                                        {{--<button id='medical_id' class='btn medical_id'> <i>Save</i> </button>--}}
                                    {{--</td></tr>--}}
                            {{--</table>--}}

                            {{--<table id="table_diagnosis2"  class="table table-form">--}}
                                {{--<thead class="thead-inverse">--}}
                                {{--<tr>--}}
                                    {{--<th>Drug</th>--}}
                                    {{--<th>From</th>--}}
                                    {{--<th>To</th>--}}
                                    {{--<th>Disease</th>--}}
                                    {{--<th>Currently taking</th>--}}
                                    {{--<th>Edit</th>--}}
                                    {{--<th>Delete</th>--}}
                                {{--</tr>--}}

                                {{--</thead>--}}
                                {{--<tbody id='medical_detail'>--}}
                                {{--@foreach($drug_history as $drug_hist)--}}
                                    {{--<tr >--}}
                                        {{--<TD><label>{{$drug_hist->drug_taken}}</label></TD>--}}
                                        {{--<TD><label>{{$drug_hist->from_date}}</label></TD>--}}
                                        {{--<TD><label>{{$drug_hist->to_date}}</label></TD>--}}
                                        {{--<TD><label>{{$drug_hist->disease}}</label></TD>--}}
                                        {{--<TD><label>{{$drug_hist->currently_taking}}</label></TD>--}}

                                        {{--<td><button class="btn btn-primary" onclick='edit_medical_history(this)' value="{{$drug_hist->id}}"><span class="icon-pencil5">Edit  </span></button></td>--}}
                                        {{--<td><button class="btn btn-danger " onclick=' del_diagnosis(this)'  value="{{$drug_hist->id}}" ><span class="icon-pencil5"> Delete</span></button></td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}



                        <!-- Perscription  -->


                        <div class="tab-pane fade in" id="prescription" >
<br/>
                            <table id="table_prescription"   class="tab-content table" >
                                <thead class="thead-inverse">
                                <tr>
                                    <th>Drug</th>
                                    <th>Perscriber</th>
                                    <th>Date</th>
                                    <th>Perscriber position</th>

                                </tr>
                                </thead>
                                <tr>


                                    <TD><select class="form-control" id="drug_perscribed"  name="drug_perscribed" >
                                            <option></option>
                                            @foreach ($items as $item)
                                                <option value="{{$item->item_name}}" id="item" name="{{$item->id}}">{{$item->item_name}}</option>
                                            @endforeach
                                        </select>
                                    </TD>

                                    <TD><INPUT type="text" class="form-control" name="perscriber"   id="perscriber" placeholder="perscriber"  /></TD>
                                    <TD><INPUT type="date" class="form-control" name ="perscriber_date" id="perscriber_date"/></TD>
                                    <TD><select type="text" class="form-control" name ="perscriber_pos" id="perscriber_pos"  placeholder="Status"  >
                                            <option></option>
                                            <option>Medical Practitioner</option>
                                            <option>Nurse Practitioner</option>
                                            <option>intern Practitioner</option>
                                            <option>others</option>

                                    </TD>
                                <td>
                                <button id='perscription_id' class='btn perscription_id btn-primary'> <i>Save</i> </button>
                                </td>
                                </tr>
                            </table>

                            <table id="myTable2"  class='table table-form'>
                                <thead class="thead-inverse">
                                <tr>

                                    <th>Drug</th>
                                    <th>Perscriber</th>
                                    <th>Date</th>
                                    <th>Perscriber Position</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>

                                </thead>

                                <tbody id="perscription_detail" >
                                @foreach($drug_perscription as $perscription)
                                    <tr>
                                        <TD>{{$perscription->drug}}</TD>
                                        <TD>{{$perscription->perscriber}}</TD>
                                        <TD> {{$perscription->date}}</TD>
                                        <TD>{{$perscription->perscriber_position}}</TD>
                                        <td><button class="btn btn-success btn-sm" onclick='edit_perscription(this)' value="{{$perscription->id}}"><i class="fa fa-edit"></i> Edit</button></td>
                                        <td><button class="btn btn-danger  btn-sm" onclick= 'del_perscription(this)' value="{{$perscription->id}}" >
                                                <i class="fa fa-trash"></i> Delete</button></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>





                        </div>



                        <!-- SOAP  -->


                        <div class="tab-pane fade in" id="soap" >
<br/>
                            <table id="table_soap"   class="tab-content table" >
                                <thead class="thead-inverse">
                                <tr>
                                    <th>Date</th>
                                    <th>Subjective</th>
                                    <th>Objective</th>
                                    <th>Assessment</th>
                                    <th>Plan</th>

                                </tr>
                                </thead>
                                <tr>
                                    <TD><input type='date' class="form-control" id="soap_date"  name="soap_date" placeholder="date" ></TD>
                                    <TD><input type='text' class="form-control" id="subjective"  name="subjective" placeholder="Subjective" ></TD>
                                    <TD><input type="text" class="form-control" name="objective"   id="objective" placeholder="Objective"  /></TD>
                                    <TD><input type="text" class="form-control" name ="assessment" id="assessment" placeholder="Assessment"/></TD>
                                    <TD><input type="text" class="form-control" name ="plan" id="plan"  placeholder="Plan"  /></TD>
                            <td>
                            <button id='soap_id' class='btn soap_id btn-primary'> <i>Save</i> </button>
                            </td>
                                </tr>
                            </table>



                            <table id="soap_table2"  class='table table-form'>
                                <thead class="thead-inverse">
                                <tr>

                                    <th>Date</th>
                                    <th>Subjective</th>
                                    <th>Objective</th>
                                    <th>Assessment</th>
                                    <th>Plan</th>
                                    <th>Edit</th>

                                    <th>Delete</th>
                                </tr>

                                </thead>

                                <tbody id="soap_detail" >
                                @foreach($soaps as $soap)
                                    <tr >


                                        <TD>{{$soap->date}}</TD>
                                        <TD>{{$soap->subjective}}</TD>
                                        <TD>{{$soap->objective}}</TD>
                                        <TD> {{$soap->assessment}}</TD>
                                        <TD>{{$soap->plan}}</TD>
                                        <td><button class="btn btn-success btn-sm" onclick='edit_soap(this)' value="{{$soap->id}}"><i class="fa fa-edit"></i> Edit</button></td>
                                        <td><button class="btn btn-danger  btn-sm" onclick= 'del_soap(this)' value="{{$soap->id}}" >
                                                <i class="fa fa-trash"></i> Delete</button></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>





                        </div>


                        <!-- Appointment  -->


                        <div class="tab-pane fade in" id="appointment" >
<br/>
                            <table id="table_appointment"   class="tab-content table table-condensed" >
                                <thead class="thead-inverse">
                                <tr>
                                    <th>Appointment Date</th>
                                    <th>Reason</th>


                                </tr>
                                </thead>
                                <tr>



                                    <TD><INPUT type="date" class="form-control" name="appointed_date" id="appointed_date"   /></TD>
                                    <TD><INPUT type="text" size='80' class="form-control" name="appointment_reason"   id="appointment_reason" placeholder="Appointemnt Reason"  /></TD>
<td>                                <button id='appointment_id' class='btn appointment_id btn-primary'> <i>Save</i> </button>
</td>
                                </tr>
                            </table>

<br>


                            <table id="myTable2"  class='table table-form table-striped table-condensed'>
                                <thead class="thead-inverse">
                                <tr>

                                    <th>Appointment Date</th>
                                    <th>Reason</th>
                                    <th>Delete</th>
                                </tr>

                                </thead>

                                <tbody id="appointment_detail" >
                                @foreach($appointments as $appointment)
                                    <tr >

                                        <TD>{{$appointment->appointment_date}}</TD>
                                        <TD>{{$appointment->appointment_reason}}</TD>
                                        <td><button class="btn btn-danger btn-sm" onclick= 'del_appointment(this)' value="{{$appointment->id}}" >
                                                <i class="fa fa-trash"></i> Delete</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>





                        </div>





                        <!--   Allergy   -->

                        <div class="tab-pane fade in" id="allergy" >

<br/>
                            <table id="table_allergy" style="width:70%;"   class="tab-content table" >
                                <thead class="thead-inverse">
                                <tr>

                                    <th>Drug</th>
                                    <th>Allergy</th>


                                </tr>
                                </thead>
                                <tr>

                                    <TD><select class="form-control" id="Drug_allergy"  name="Drug_allergy" >
                                            <option></option>
                                            @foreach ($items as $item)
                                                <option value="{{$item->item_name}}" id="item" name="{{$item->id}}">{{$item->item_name}}</option>
                                            @endforeach
                                        </select>
                                    </TD>

                                    <TD><INPUT type="text" class="form-control" name="allergy_caused"  size='60' id="allergy_caused" placeholder="Allergy"  /></TD>

                                <td>                                 <button id='allergy_btn' class='btn allergy_btn btn-primary'> <i>Save</i> </button>
                                </td>
                            </table>

<br/>

                            <table id="myTable2"  class='table table-form'>
                                <thead class="thead-inverse">
                                <tr>
                                    <th>Drug</th>
                                    <th>Allergy</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>

                                </thead>

                                <tbody id="allergy_detail" >
                                @foreach($allergys as $allergy)
                                    <tr >

                                        <TD>{{$allergy->drug}}</TD>
                                        <TD>{{$allergy->allergy}}</TD>
                                        <td><button class="btn btn-success btn-sm" onclick='edit_allergy(this)' value="{{$allergy->id}}"><i class="fa fa-edit"></i> Edit</button></td>
                                        <td><button class="btn btn-danger btn-sm" onclick='del_allergy(this)' value="{{$allergy->id}}" >
                                                <i class="fa fa-trash"></i> Delete</button></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>


                        <!--     Vital  Signs     -->

                        <div class="tab-pane fade in active" id="vital_signs">
<br/>
                            <table id="myTable1" name="test[]"  class="tab-content table"  >
                                <thead class="thead-inverse">
                                <tr>
                                    <th>Date</th>
                                    <th COLSPAN="2" ><center>Blood Pressure</center> </th>
                                    <th></th>
                                    <th>Glucose</th>
                                    <th>Pulse</th>
                                    <th>Temp</th>
                                    <th>Weight</th>
                                </tr>
                                </thead>
                                <tr >


                                    <TD><INPUT type="date" class="form-control" name ="date_vital" id="date_vital" placeholder="Date"  /></TD>
                                    <TD><INPUT type="text" class="form-control" name="bp_sys" id="bp_sys" placeholder="Bp-SYS"  /></TD><td>/</td>
                                    <TD><INPUT type="text" class="form-control" name="bp_dys"   id="bp_dys" placeholder="Bp-DYS"  /></TD>
                                    <TD><INPUT type="text" class="form-control" name ="blood_glu" id="blood_glu"  placeholder="Glucose"  /></TD>
                                    <TD><INPUT type="text" class="form-control" name="pulse" id="pulse" placeholder="Pulse"  /></TD>
                                    <TD><INPUT type="text" class="form-control" name="temp"   id="temp" placeholder="Temp"  /></TD>
                                    <TD><INPUT type="text" class="form-control" name="weight"   id="weight" placeholder="Kg"  /></TD>

                                    <td> </td>
                                    <td>
                                        <button id="vital_signs_but" class='btn vital_signs_but btn-primary'> <i>Save</i>  </button>
                                    </td></tr>
                            </table>

<br/><br/>
                            <table id="myTable2"  class='table table-bordered table-striped'>
                                <thead class="thead-inverse">
                                <tr>
                                    <th>Date</th>
                                    <th>Blood Pressure </th>
                                    <th>Glucose</th>
                                    <th>Pulse</th>
                                    <th>Temp</th>
                                    <th>Weight</th>
                                    <th>Edit</th>

                                    <th>Delete</th>
                                </tr>

                                </thead>

                                <tbody id="vital_signs_detail" >
                                @foreach($vital_signs as $sign)
                                    <tr >


                                        <TD>{{$sign->date}}</TD>
                                        <TD>{{$sign->bp_sys}}/ {{$sign->bp_dys}}</TD>
                                        <TD>{{$sign->sugar}}</TD>
                                        <TD>{{$sign->pulse}}</TD>
                                        <TD>{{$sign->temp}}</TD>
                                        <TD>{{$sign->weight}}</TD>
                                        <td><button class="btn btn-success btn-sm" onclick='edit_vital(this)' value="{{$sign->id}}"><i class="fa fa-edit"></i> Edit</button></td>
                                        <td><button class="btn btn-danger delete_vital_btn btn-sm" onclick='del_vital(this)' value="{{$sign->id}}" ><i class="fa fa-trash"></i> Delete</button></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>


                    </div>
                </div>


                </form>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function () {

            $('#vital_signs').tab('show');
        });


        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });



        //this is ajax for diaily vital signs
        $(".vital_signs_but").click(function(e){

//console.log('hi');
//alert('hi');
            id= document.getElementById('customer_id').value;
            date_vital = document.getElementById('date_vital').value;
            bp_sys = document.getElementById('bp_sys').value;
            bp_dys = document.getElementById('bp_dys').value;
            blood_glu = document.getElementById('blood_glu').value;
            pulse = document.getElementById('pulse').value;
            temp = document.getElementById('temp').value;
            weight = document.getElementById('weight').value;


            $.ajax({

                type:'GET',

                url:"{{ route('add_new_vital_sign') }}",

                data:{id:id,date_vital:date_vital,bp_sys:bp_sys,temp:temp,bp_dys:bp_dys,blood_glu:blood_glu,pulse:pulse,weight:weight},

                success:function(data){

                    document.getElementById('vital_signs_detail').innerHTML=data.vital

                }
            });


        })



        //end of vital signs

        //this is for allergy
        $(".allergy_btn").click(function(e){

//console.log('hi');
//alert('hi');
            id= document.getElementById('customer_id').value;
            allergy = document.getElementById('allergy_caused').value;
            Drug_allergy = document.getElementById('Drug_allergy').value;


            $.ajax({

                type:'GET',

                url:"{{ route('add_new_drug_allergy') }}",

                data:{id:id,allergy:allergy,Drug_allergy:Drug_allergy},

                success:function(data){

                    document.getElementById('allergy_detail').innerHTML=data.allergy_data

                }
            });
        })

        //end of allergy
        //perscriberw

        $(".perscription_id").click(function(e){

//console.log('hi');
//alert('hi');
            id= document.getElementById('customer_id').value;
            drug_perscribed = document.getElementById('drug_perscribed').value;
            perscriber = document.getElementById('perscriber').value;
            perscriber_date = document.getElementById('perscriber_date').value;
            perscriber_pos = document.getElementById('perscriber_pos').value;

            $.ajax({

                type:'GET',

                url:"{{ route('add_perscription') }}",

                data:{id:id,drug_perscribed:drug_perscribed,perscriber:perscriber,perscriber_date:perscriber_date,perscriber_pos:perscriber_pos},

                success:function(data){

                    document.getElementById('perscription_detail').innerHTML=data.perscription

                }
            });
        })




        //end of perscriber
        //SOAP

        $(".soap_id").click(function(e){

//console.log('hi');
//alert('hi');
            id= document.getElementById('customer_id').value;
            subjective = document.getElementById('subjective').value;
            objective = document.getElementById('objective').value;
            assessment = document.getElementById('assessment').value;
            plan = document.getElementById('plan').value;
            soap_date = document.getElementById('soap_date').value;

            $.ajax({

                type:'GET',

                url:"{{ route('add_soap') }}",

                data:{id:id,subjective:subjective,objective:objective,assessment:assessment,plan:plan,soap_date:soap_date},

                success:function(data){
                    console.log(data.soap)
                    document.getElementById('soap_detail').innerHTML=data.soap

                }
            });
        })




        //end of perscriber

        //end of soap
        //Appointment

        $(".appointment_id").click(function(e){

//console.log('hi');
//alert('hi');
            id= document.getElementById('customer_id').value;
            appointed_date = document.getElementById('appointed_date').value;
            appointment_reason = document.getElementById('appointment_reason').value;


            $.ajax({

                type:'GET',

                url:"{{ route('add_appointment') }}",

                data:{id:id,appointed_date:appointed_date,appointment_reason:appointment_reason},

                success:function(data){

                    document.getElementById('appointment_detail').innerHTML=data.appointment
                    console.log(data.appointment)

                }
            });
        })




        //end of Appointment
        ///this is for medical history


        //end of medical history


        // this is for  durg history
        $(".drug_id").click(function(e){

//console.log('hi');
            id= document.getElementById('customer_id').value;
            drug_name = document.getElementById('drug_history_drug').value;
            from_date = document.getElementById('from_date').value;
            to_date = document.getElementById('to_date').value;
            drug_history_disease = document.getElementById('drug_history_disease').value;
            currently_taking=document.getElementById('currently_taking').value


            $.ajax({

                type:'GET',

                url:"{{ route('add_new_drug_history') }}",

                data:{id:id,drug_name:drug_name,from_date:from_date,to_date:to_date,drug_history_disease:drug_history_disease,currently_taking:currently_taking},

                success:function(data){

                    document.getElementById('drug_detail').innerHTML=data.drug_his

                }
            });
        })
        ///for diagnosis
        $(".diagnosis_id").click(function(e){

//console.log('hi');
            id= document.getElementById('customer_id').value;
            date_diagnosis = document.getElementById('date_diagnosis').value;
            disease_diagnosis = document.getElementById('disease_diagnosis').value;
            description_diagnosis = document.getElementById('description_diagnosis').value;
            status_diagnosis = document.getElementById('status_diagnosis').value;
            $.ajax({

                type:'GET',

                url:"{{ route('add_new_diagnosis') }}",

                data:{id:id,date_diagnosis:date_diagnosis,disease_diagnosis:disease_diagnosis,description_diagnosis:description_diagnosis,status_diagnosis:status_diagnosis},

                success:function(data){

                    document.getElementById('diagnosis_detail').innerHTML=data.diagno

                }
            });
        })



    </script>
    <script>
        function test(){


            id= document.getElementById('customer_id').value;
            date_diagnosis = document.getElementById('date_diagnosis').value;
            disease_diagnosis = document.getElementById('disease_diagnosis').value;
            description_diagnosis = document.getElementById('description_diagnosis').value;
            status_diagnosis = document.getElementById('status_diagnosis').value;
            $.ajax({

                type:'GET',

                url:"{{ route('add_new_diagnosis') }}",

                data:{id:id,date_diagnosis:date_diagnosis,disease_diagnosis:disease_diagnosis,description_diagnosis:description_diagnosis,status_diagnosis:status_diagnosis},

                success:function(data){

                    document.getElementById('diagnosis_detail').innerHTML=data.diagno

                }
            });

        }

    </script>
    <script>

        x=document.getElementById('gend').value;

        if (x=='male'){
            document.getElementById('male').checked=true;
        }
        else{
            document.getElementById('female').checked=true;
            y=document.getElementById('preg').value

            if(document.getElementById('preg').value=='pregnant'||document.getElementById('preg').value=='yes'){
                document.getElementById('pregnant').checked=true;
                document.getElementById('pregnancy').hidden=false
                document.getElementById('blood_type').hidden=false
                document.getElementById('tri_tr').hidden=false
            }
            else{
                document.getElementById('pregnancy').checked=false;
            }
        }

    </script>

    <script>
        if(document.getElementById('reg_cust').value=='yes'){
            document.getElementById('regular_customer_check').checked=true
        }
        if ( document.getElementById('female').checked){
            document.getElementById('pregnancy').hidden=false
            if ( document.getElementById('pregnant').checked){
                document.getElementById('tri_tr').hidden=false
                document.getElementById('blood_type').hidden=false

            }

        }
        function gen(o){
            if (o.value=='female'){
                document.getElementById('pregnancy').hidden=false
                if ( document.getElementById('pregnant').checked){
                    document.getElementById('tri_tr').hidden=false
                    document.getElementById('blood_type').hidden=false

                }

            }
            else{
                document.getElementById('pregnancy').hidden=true
                document.getElementById('tri_tr').hidden=true
                document.getElementById('blood_type').hidden=true

            }
        }

        function preg_checker(o){
            if (o.checked){
                document.getElementById('tri_tr').hidden=false
                document.getElementById('blood_type').hidden=false

            }
            else{
                document.getElementById('tri_tr').hidden=true
                document.getElementById('blood_type').hidden=true
                o.checked=false

            }
        }
    </script>
    <script>
        ////all functions with in the script are used for deleting row

        function del_vital(o){
            id= o.value;
            customer=document.getElementById('customer_id').value;


            $.ajax({

                type:'GET',

                url:"{{ route('delete_vital_sign') }}",

                data:{id:id,customer:customer},

                success:function(data){

                    document.getElementById('vital_signs_detail').innerHTML=data.vital
//   //clearData();

                }
            });

        }
        //// this is for deleting a row in daily vital
        $(".delete_vital_btn").click(function(e){
            id= this.value;
            customer=document.getElementById('customer_id').value;


            $.ajax({

                type:'GET',

                url:"{{ route('delete_vital_sign') }}",

                data:{id:id,customer:customer},

                success:function(data){

                    document.getElementById('vital_signs_detail').innerHTML=data.vital
//   //clearData();

                }
            });
        })



        ///end of daily vital

        //// this is for deleting a row in Allergy
        function del_allergy(o){

            id= o.value;
            customer=document.getElementById('customer_id').value;


            $.ajax({

                type:'GET',

                url:"{{ route('delete_allergy_sign') }}",

                data:{id:id,customer:customer},

                success:function(data){

                    document.getElementById('allergy_detail').innerHTML=data.allergy_data
//   //clearData();

                }
            });
        }
        //end of Allergy


        //// this is for deleting a row in Drug prescripiton
        function del_perscription(o){

            id= o.value;
            customer=document.getElementById('customer_id').value;


            $.ajax({

                type:'GET',

                url:"{{ route('delete_perscription') }}",

                data:{id:id,customer:customer},

                success:function(data){

                    document.getElementById('perscription_detail').innerHTML=data.perscription
//   //clearData();

                }
            });

        }

        //end of drug persription
        //delete soap
        function del_soap(o){

            id= o.value;
            customer=document.getElementById('customer_id').value;


            $.ajax({

                type:'GET',

                url:"{{ route('delete_soap') }}",

                data:{id:id,customer:customer},

                success:function(data){

                    document.getElementById('soap_detail').innerHTML=data.soap
//   //clearData();

                }
            });

        }

        //end of soap deletion
        //// this is for deleting a row in Appointment
        function del_appointment(o){

            id= o.value;
            customer=document.getElementById('customer_id').value;


            $.ajax({

                type:'GET',

                url:"{{ route('delete_appointment') }}",

                data:{id:id,customer:customer},

                success:function(data){

                    document.getElementById('appointment_detail').innerHTML=data.appointment
//   //clearData();

                }
            });

        }

        //end of Appointment


        //// this is for deleting a row in Drug History
        function del_drug_history(o){

            id= o.value;
            customer=document.getElementById('customer_id').value;


            $.ajax({

                type:'GET',

                url:"{{ route('delete_drug_history') }}",

                data:{id:id,customer:customer},

                success:function(data){

                    document.getElementById('drug_detail').innerHTML=data.drug_his
//   //clearData();

                }
            });
        }
        ///end of drug history

        //// this is for deleting a row in Diagnosis
        function del_diagnosis(o){
            id= o.value;
            customer=document.getElementById('customer_id').value;


            $.ajax({

                type:'GET',

                url:"{{ route('delete_diagnosis') }}",

                data:{id:id,customer:customer},

                success:function(data){

                    document.getElementById('diagnosis_detail').innerHTML=data.diagno
//   //clearData();

                }
            });
        }
        $(".edit_vital_btn").click(function(e){
            alert('inside  edit vital button')})
    </script>

    <script>
        //all the fucntions written with in this script are used for editing the customer data
        function edit_diagnosis(o){
            alert(o.value)


        }


    </script>

@endsection
