
        <style>
.header{
    font-weight:bolder;
    font-weight:900; 
    color:black;
    font: 28px;
    width:260px; left:0; margin-left:auto; right:0; margin-right:auto;
}

.sub_header{
    text-align:center;
    font-weight:bolder;
    width:300px; left:0; margin-left:-20px; right:0; margin-right:auto;
}
#ts td { background:white; } /* Background of all cells */
#t1 .odd td { background:#ddd; } /* Alternating Row Background */
#t1 td.c3 { background:darkgreen; color:white; } /* Column Background */
#t1 .odd { background:#eee; }
#t1 {cell-padding:0px; cellspacing:0px;}

.collapsed { border-collapse:collapse; }

.auto-layout { table-layout:auto; }
.stretched { width:100%; }

</style>


<div>                                

<div>
                                <div class="header">
                                    <strong>Selamawit Pharmacy</strong>
                                </div>

                                <div class="sub_header">
                                <h3>Customer's Visits Report</h3>
                                </div>

                                <div class="print-date" style="float:right">
Print Date: 28/02/2020
<br/>
                                </div>
                            </div>
    <br/><br/>

                            <U><B>Customer Information</B></U>
                            <br>

                            <table>
                                <tr><td><B>Customer:</B></td><td> {{$customer_name}} </td><td><B>Mobile No:</B></td><td> {{$mobile}} </td></tr>
                                <tr><td><B>Age: </B></td><td>{{$age}} </td><td><B>Gender:</B></td><td> {{$gender}} </td></tr>
                                <tr><td><B>Address: </B></td><td>{{$city}}  </td><td><B>Remark:</B></td><td> {{$remark}} </td></tr>
                            </table>
                            </p>
                            <br/>

                            <div class="sub_header">
                            <br/>
                                <U>Vital Signs Report</U>
                            </div>

<br/>
                                <table id="t1" class="collapsed auto-layout stretched" >
                                    <thead>
                                        <tr>
                                        <th>Date </th>
                                        <th>Blood Pressure </th>
                                        <th>Glucose </th>
                                        <th>Pulse </th>
                                        <th>Temp </th>
                                        <th>Weight </th>
                                        </tr>
                                    </thead>     
                                                                   
                                    <tbody>
                                    @foreach($vital_signs as $sign)
                                        <tr >
                                    <TD><label >{{$sign->date}}</label></TD>
                                    <TD><label >{{$sign->bp_sys}} / {{$sign->bp_dys}}</label></TD>
                                    <TD><label >{{$sign->sugar}}</label></TD>
                                    <TD><label >{{$sign->pulse}}</label></TD>
                                    <TD><label>{{$sign->temp}}</label></TD>
                                    <TD><label>{{$sign->weight}}</label></TD>
                                    </tr>
                                    @endforeach
                                    </tbody>

                                </table>

    <table>

<div>
<div class="sub_header">

<br/><br/>
                                <U>Drug History Report</U> 

                                </div>
                                <br/>
                                <table id="t1" class="collapsed auto-layout stretched" >
                                    <thead>
                                        <tr>
                                        <th>Drug </th>
                                        <th>From Date </th>
                                        <th>To Date </th>
                                        <th>Disease </th>
                                        <th>Drug Taking </th>
                                        </tr>
                                    </thead>     
                                                                   
                                    <tbody>
                                    @foreach($drug_history as $drug_hist)
    <tr >
            <TD><label>{{$drug_hist->drug_taken}}</label></TD>
            <TD><label>{{$drug_hist->from_date}}</label></TD>
            <TD><label>{{$drug_hist->to_date}}</label></TD>
            <TD><label>{{$drug_hist->disease}}</label></TD>
            <TD><label>{{$drug_hist->currently_taking}}</label></TD>

            </tr>
            @endforeach </tbody>

<table>
</div>
</table>



    <table>

        <div>
            <div class="sub_header">

                <br/><br/>
                <U>Perscriptions Report</U>

            </div>
            <br/>
            <table id="t1" class="collapsed auto-layout stretched" >
                <thead>
                <tr>
                    <th>Date </th>
                    <th>Drug </th>
                    <th>Perscriber </th>
                    <th>Perscriber Position </th>
                </tr>
                </thead>

                <tbody>
                @foreach($drug_perscription as $perscription)
                    <tr >

                        <TD><label>{{$perscription->date}}</label></TD>
                        <TD><label>{{$perscription->drug}}</label></TD>
                        <TD><label>{{$perscription->perscriber}}</label></TD>
                        <TD><label>{{$perscription->perscriber_position}}</label></TD>

                    </tr>
                @endforeach </tbody>

                <table>
        </div>
    </table>


    <table>

        <div>
            <div class="sub_header">

                <br/><br/>
                <U>SOAP (Progress) Report</U>

            </div>
            <br/>
            <table id="t1" class="collapsed auto-layout stretched" >
                <thead>
                <tr>
                    <th>Date </th>
                    <th>Subjective </th>
                    <th>Objective </th>
                    <th>Assesment </th>
                    <th>Plan </th>
                </tr>
                </thead>

                <tbody>
                @foreach($soaps as $soap)
                    <tr >
                        <TD><label>{{$soap->date}}</label></TD>
                        <TD><label>{{$soap->subjective}}</label></TD>
                        <TD><label>{{$soap->objective}}</label></TD>
                        <TD><label>{{$soap->assessment}}</label></TD>
                        <TD><label>{{$soap->plan}}</label></TD>
                    </tr>
                @endforeach </tbody>

                <table>
        </div>
    </table>


    <table>

        <div>
            <div class="sub_header">

                <br/><br/>
                <U>Drug Allergies Report</U>

            </div>
            <br/>
            <table id="t1" class="collapsed auto-layout stretched" >
                <thead>
                <tr>
                    <th>Drug </th>
                    <th>Allergy </th>
                </tr>
                </thead>

                <tbody>
                @foreach($allergys as $allergy)
                    <tr >
                        <TD><label>{{$allergy->drug}}</label></TD>
                        <TD><label>{{$allergy->allergy}}</label></TD>
                    </tr>
                @endforeach </tbody>

                <table>
        </div>
    </table>


    <div class="footer">
<br/><br/><br/>
        Printed By: Simon Okubagiorgis
    </div>

</div>
