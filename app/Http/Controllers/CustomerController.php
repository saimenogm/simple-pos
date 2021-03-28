<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer as Customer;

use Illuminate\Support\Facades\DB;
use App\Sale as Sale;

use PdfReport;
use PDF;


class CustomerController extends Controller
{
    public function __construct(Customer $customer, Sale $sale)
    {
        $this->customer = $customer;
        $this->sale = $sale;
    }

    public function index()
    {
        $data = [];

        $data['customers'] = $this->customer->all ();

        $data['customers'] = DB::table ('customers')
            ->where ('customers.regular_customer','=','no' )
            ->orWhere ('customers.regular_customer','=',null )
            ->select ('customers.*')
            ->get ();
        return view ('customers/index', $data);
//        $data['from_date'] = '01-02-2019';
//        $data['end_date'] = '30-02-2019';
        //return view('customers/index_customers', $data);

    }

    public function customer_list_all()
    {
        $data = [];

        $customers = $this->customer->all ();

        $total_list = "";

        foreach ($customers as $customer){
            $total_list.="<option value='".$customer->id."'>".$customer->customer_name."</option>";
        }

        $customers_list = $total_list;

        return response ()->json (['customers' => $customers_list]);

    }

    public function newCustomer(Request $request, Customer $customer)
    {
        //$request->input ('regular_customer_check'));
        $data = [];
        $data['customer_name'] = $request->input ('customer_name');
        $data['mobile'] = $request->input ('mobile');
        $data['remark'] = $request->input ('remark');
//        $data['gender'] = $request->input ('gender');
//        $data['trimester'] = $request->input ('trimester');
//        $data['zone'] = $request->input ('zone');
//        $data['city'] = $request->input ('city');
//        $data['blood_type'] = $request->input ('blood_');
//        $data['pregnant'] = $request->input ('pregnant');
//        $data['age'] = $request->input ('age');
//        $data['regular_customer'] = $request->input ('regular_customer_check');
//        $data['contact_person'] = $request->input ('contact_person');


        // For holding balance

        if ($request->input ('balance_type') == "unpaid") {
            $balance = $request->input ('balance_amount');
        } else if ($request->input ('balance_type') == "overpaid") {
            $balance = -1 * $request->input ('balance_amount');
        }

        $data['balance'] = $balance;

        if ($request->isMethod ('post')) {
            //dd($data);

            $this->validate (
                $request,
                [
                ]
            );


            $customer->insert ($data);

            return redirect ('customers/');
        }

        return view ('customers/form', $data);

    }

    public function addCustomerNew(Request $request)
    {
        $input = $request->all ();

        try {

            $data['customer_name'] = $request->customer_name;

            DB::table('customers')->insert(
                ['customer_name' => $request->customer_name,
                    'remark'=>$request->remark,
                    'telephone'=>$request->telephone,
                    'address'=>$request->address,
                    'city'=>$request->address,
                    'account_receivable'=>0.00,
                    'account_payable'=>0.00
                ]
            );

            $customers = $this->customer->all ();

            $total_list = "";

            foreach ($customers as $customer){
                $total_list.="<option value='".$customer->id."'>".$customer->customer_name."</option>";
            }

            $customers_list = $total_list;

            return response ()->json (['success' => $customers_list]);

        } catch (\Exception $e) {

            DB::rollBack ();
            return response ()->json (['success' => $e, 'item' => 'error' . $e]);
        }

//        if($request->input('balance_type')=="unpaid")
//        {
//            $balance = $request->input('balance_amount');
//        }else if($request->input('balance_type')=="overpaid")
//        {
//            $balance = -1* $request->input('balance_amount');
//        }
//
//        $data['balance'] = $balance;
//
//        if( $request->isMethod('post') )
//        {
//            $customer->insert($data);
//
//            return redirect('customers/');
//        }
//
//        return view('customers/form', $data);

    }

    public function modify( Request $request, $customer_id, Customer $customer )
    {
        if( $request->isMethod('post') )
        {

            $customer_data = $this->customer->find($customer_id);

            $customer_data->customer_name = $request->input('customer_name');
            $customer_data->mobile= $request->input('mobile');
            $customer_data->remark= $request->input('remark');
            $customer_data->gender = $request->input('gender');
            $customer_data->trimester = $request->input('trimester');
            $customer_data->address = $request->input('address');
            $customer_data->city= $request->input('city');
            $customer_data->zone= $request->input('zone');
            $customer_data->blood_type = $request->input('blood_');
            $customer_data->pregnant = $request->input('pregnant');
            $customer_data->regular_customer = $request->input('regular_customer_check');
            $customer_data->age = $request->input('age');

            if($request->input('balance_type')=="unpaid")
            {
                $balance = $request->input('balance_amount');
            }else if($request->input('balance_type')=="overpaid")
            {
                $balance = -1* $request->input('balance_amount');
            }

            //$customer_data->balance_type =$request->input('balance_type');
            $customer_data->balance = $balance;

            $customer_data->save();
            $data = [];

            $data['customers'] = $this->customer->all();

            return view('customers/index', $data);

        }

        return view('customers/detail', $data);
    }

    public function show($customer_id,Request $request)
    {

        $data = [];
        $data['customer_id'] = $customer_id;
        $data['modify'] = 1;
        $customer_data = $this->customer->find($customer_id);
        //dd($customer_data );

        $data['customer_name'] = $customer_data->customer_name;
        $data['zone'] = $customer_data->zone;
        $data['city'] = $customer_data->city;
        $data['mobile'] = $customer_data->mobile;
        $data['remark'] = $customer_data->remark;
        $data['age'] = $customer_data->age;
        $data['gender'] = $customer_data->gender;
        $data['blood_type'] = $customer_data->blood_type;
        $data['tri'] = $customer_data->trimester;
        $data['preg'] = $customer_data->pregnant;
        $data['regular_customer'] = $customer_data->regular_customer;
        $data['contact_person'] = $customer_data->contact_person;


        if($customer_data->balance>=0)
        {
            $data['balance_amount'] =  abs($customer_data->balance);
            $data['balance_type'] = 'unpaid';
        }
        else if($customer_data->balance<0)
        {
            $data['balance_amount'] =  abs($customer_data->balance);
            $data['balance_type'] = 'overpaid';
        }
        $data['vital_signs']=DB::table('vital_signs')
            ->where('vital_signs.customer',$customer_id)
            ->get();
        $data['diagnosis_list']=DB::table('patient_diagnosis')
            ->where('patient_diagnosis.customer',$customer_id)
            ->get();

        $data['drug_history']=DB::table('drug_history')
            ->where('drug_history.customer',$customer_id)
            ->get();
        $data['allergys']=DB::table('drug_allergy')
            ->where('drug_allergy.customer',$customer_id)
            ->get();
        $data['drug_perscription']=DB::table('drug_perscription')
            ->where('drug_perscription.customer',$customer_id)
            ->get();
        $data['soaps']=DB::table('soap')
            ->where('soap.customer',$customer_id)
            ->get();
        $data['items']=DB::table('items')
            ->get();
        $data['appointments']=DB::table('appointment_date')
            ->where('appointment_date.customer',$customer_id)
            ->get();


        if($customer_data->regular_customer=='yes'){
            return view('customers/detail', $data);
        }else{
            return view('customers/detail_normal', $data);
        }


    }

    public function createCustomer(Request $request, Customer $customer)
    {

        return view('customers/form');

    }

    public function create()
    {
        return view('customers/create');
    }

    public function reporter(Request $request)
    {
        //$data = Customer::get();
        $data['customers'] = $this->customer->all();
        //dd($data);

        $data['from_date']='01-02-2019';
        $data['end_date']='30-02-2019';

        $pdf = PDF::loadView('customers/index_customers', $data);
        //return $pdf->download('customers.pdf');
        //$link = asset('css/additional_styles.css');
        //$pdf->set_base_path($link);

        $pdf->save(storage_path().'_filename.pdf');

        // Finally, you can download the file using download function
        return $pdf->stream('customers.pdf');
        //$pdf->render();
        //$pdf->stream();

    }

    public function reporter2(Request $request)
    {
        require_once "C:\xampp\htdocs\temp\sape\config";
        $dompdf = new DOMPDF();

        $html ="
            <html>
            <head>
            <link type='text/css' href='localhost/exampls/style.css' rel='stylesheet' />
            </head>
            <body>
            <table>
            <tr >
                <td class='abc'>testing table</td>
                </tr>
            <tr>
            <td class='def'>Testng header</td>
            </tr>
            </table>
            </body>
            </html>";

        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->set_base_path('localhost/exampls/style.css');
        $dompdf->stream("hello.pdf");
    }

    public function sales_report(Request $request)
    {
        //$data = Customer::get();
        $data['sales'] = $this->sale->all();
        //dd($data);
        $pdf = PDF::loadView('reports/sales_report', $data);
        //return $pdf->download('customers.pdf');

        $pdf->save(storage_path().'_filename.pdf');

        // Finally, you can download the file using download function
        return $pdf->stream('customers.pdf');
        //$pdf->render();
        //$pdf->stream();

    }

    public function delete_customer(Request $request,$customer_id)
    {
        $customer_data = $this->customer->find($customer_id);
        $customer_data->delete();
        $data = [];

        $data['customers'] = $this->customer->all();

        return view('customers/index', $data);
    }


    ### Pharma Data ###

    public function index_regular()
    {
        $data = [];

        $data['customers'] = DB::table ('customers')
            ->Where ('regular_customer', 'yes')
            ->get ();

        return view ('customers/regular_customer_index', $data);


    }

    public function add_appointment(Request $request)
    {

        $data = [];

        $total_amount = 0.00;

        $input = $request->all ();

        try {

            //$customer_id = $request->customer_id;
            $id = $request->id;
            $appointed_date = $request->appointed_date;
            $appointment_reason = $request->appointment_reason;
            $user = auth ()->user ();

            DB::table ('appointment_date')->insert (
                ['customer' => $id,
                    'appointment_date' => $appointed_date,
                    'appointment_reason' => $appointment_reason,

                ]
            );


            $appointments = DB::table ('appointment_date')
                ->where ('customer', '=', $id)
                ->get ();

            $return_data = "";

            foreach ($appointments as $appointment) {
                $return_data .= "<tr><td>" . $appointment->appointment_date . "</td>";
                $return_data .= "<td>" . $appointment->appointment_reason . "</td>";
                $return_data .= "<td><button class='btn btn-danger delete_appointment_btn' onclick= 'del_appointment(this)' value='" . $appointment->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['appointment' => $return_data]);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['appointment' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['appointment' => 'generic', 'item' => 'item_success']);


    }

    //Appointment Delete

    public function delete_appointment(Request $request)
    {

        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('appointment_date')->where ('id', '=', $id)->delete ();

            $appointments = DB::table ('appointment_date')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($appointments as $appointment) {
                $return_data .= "<tr><td>" . $appointment->appointment_date . "</td>";
                $return_data .= "<td>" . $appointment->appointment_reason . "</td>";
                $return_data .= "<td><button class='btn btn-danger' onclick= 'del_appointment(this)' value='" . $appointment->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['appointment' => $return_data]);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['appointment' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['appointment' => 'generic', 'item' => 'item_success']);

    }

    public function add_diagnosis(Request $request)
    {

        $data = [];

        $total_amount = 0.00;

        $input = $request->all ();

        try {

            //$customer_id = $request->customer_id;
            $id = $request->id;
            $date_diagnosis = $request->date_diagnosis;
            $disease_diagnosis = $request->disease_diagnosis;
            $description_diagnosis = $request->description_diagnosis;
            $status_diagnosis = $request->status_diagnosis;
            $user = auth ()->user ();

            DB::table ('patient_diagnosis')->insert (
                ['customer' => $id,
                    'date' => $date_diagnosis,
                    'diagnosis' => $disease_diagnosis,
                    'description' => $description_diagnosis,
                    'status' => $status_diagnosis,
                ]
            );


            $diagnosis = DB::table ('patient_diagnosis')
                ->where ('customer', '=', $id)
                ->get ();

            $return_data = "";

            foreach ($diagnosis as $diagno) {
                $return_data .= "<tr><td>" . $diagno->date . "</td>";
                $return_data .= "<td>" . $diagno->diagnosis . "</td>";
                $return_data .= "<td>" . $diagno->description . "</td>";
                $return_data .= "<td>" . $diagno->status . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_diagnosis(this)' value='" . $diagno->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm'  onclick='del_diagnosis(this)' value='" . $diagno->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";


            }

            return response ()->json (['diagno' => $return_data]);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['diagno' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['diagno' => 'generic', 'item' => 'item_success']);


    }

    public function add_perscription(Request $request)
    {

        $data = [];

        $total_amount = 0.00;

        $input = $request->all ();

        try {

            //$customer_id = $request->customer_id;
            $id = $request->id;
            $drug_perscribed = $request->drug_perscribed;
            $perscriber = $request->perscriber;
            $perscriber_date = $request->perscriber_date;
            $perscriber_pos = $request->perscriber_pos;
            $user = auth ()->user ();

            DB::table ('drug_perscription')->insert (
                ['customer' => $id,
                    'drug' => $drug_perscribed,
                    'date' => $perscriber_date,
                    'perscriber' => $perscriber,
                    'perscriber_position' => $perscriber_pos,
                ]
            );


            $perscriptions = DB::table ('drug_perscription')
                ->where ('customer', '=', $id)
                ->get ();

            $return_data = "";

            foreach ($perscriptions as $perscription) {
                $return_data .= "<tr><td>" . $perscription->drug . "</td>";
                $return_data .= "<td>" . $perscription->perscriber . "</td>";
                $return_data .= "<td>" . $perscription->date . "</td>";
                $return_data .= "<td>" . $perscription->perscriber_position . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_perscription(this)' value='" . $perscription->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm delete_perscription_btn' onclick= 'del_perscription(this)' value='" . $perscription->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['perscription' => $return_data]);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['perscription' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['perscription' => 'generic', 'item' => 'item_success']);


    }

    // soap

    public function add_soap(Request $request)
    {

        $data = [];

        $total_amount = 0.00;

        $input = $request->all ();

        try {

            //$customer_id = $request->customer_id;
            $id = $request->id;
            $subjective = $request->subjective;
            $objective = $request->objective;
            $assessment = $request->assessment;
            $plan = $request->plan;
            $soap_date = $request->soap_date;

            $user = auth ()->user ();

            DB::table ('soap')->insert (
                ['customer' => $id,
                    'date' => $soap_date,
                    'subjective' => $subjective,
                    'objective' => $objective,
                    'assessment' => $assessment,
                    'plan' => $plan,
                ]
            );


            $soaps = DB::table ('soap')
                ->where ('customer', '=', $id)
                ->get ();

            $return_data = "";

            foreach ($soaps as $soap) {
                $return_data .= "<tr><td>" . $soap->date . "</td>";
                $return_data .= "<td>" . $soap->subjective . "</td>";
                $return_data .= "<td>" . $soap->objective . "</td>";
                $return_data .= "<td>" . $soap->assessment . "</td>";
                $return_data .= "<td>" . $soap->plan . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_soap(this)' value='" . $soap->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm delete_perscription_btn' onclick= 'del_soap(this)' value='" . $soap->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['soap' => $return_data]);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['soap' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['soap' => 'generic', 'item' => 'item_success']);


    }

    public function add_new_drug_allergy(Request $request)
    {


        $input = $request->all ();

        try {

            //$customer_id = $request->customer_id;
            $id = $request->id;
            $allergy = $request->allergy;
            $Drug_allergy = $request->Drug_allergy;

            $user = auth ()->user ();

            DB::table ('drug_allergy')->insert (
                ['customer' => $id,
                    'allergy' => $allergy,
                    'drug' => $Drug_allergy,

                ]
            );


            $allergys = DB::table ('drug_allergy')
                ->where ('customer', '=', $id)
                ->get ();

            $return_data = "";

            foreach ($allergys as $allergy) {

                $return_data .= "<tr><td>" . $allergy->drug . "</td>";
                $return_data .= "<td>" . $allergy->allergy . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_allergy(this)' value='" . $allergy->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger delete_allergy_btn btn-sm'  onclick='del_allergy(this)' value='" . $allergy->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";
                // $return_data.="<td><button value=".$vital->id."onclick='edit_vital(this);'class='hollow button' ><span class='icon-pencil5'>Edit  </span></button></td>";
                // $return_data.="<td><button value=".$vital->id." onclick='delete_vital(this);' class='hollow button'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['allergy_data' => $return_data, 'id=>$id']);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['allergy_data' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['allergy_data' => 'generic', 'item' => 'item_success']);


    }

    public function add_new_drug_history(Request $request)
    {
        $input = $request->all ();

        try {

            //$customer_id = $request->customer_id;
            $id = $request->id;
            $drug_name = $request->drug_name;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $drug_history_disease = $request->drug_history_disease;
            $currently_taking = $request->currently_taking;

            $user = auth ()->user ();

            DB::table ('drug_history')->insert (
                ['customer' => $id,
                    'drug_taken' => $drug_name,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'disease' => $drug_history_disease,
                    'currently_taking' => $currently_taking,
                ]
            );


            $drug_historys = DB::table ('drug_history')
                ->where ('customer', '=', $id)
                ->get ();

            $return_data = "";

            foreach ($drug_historys as $drug_history) {

                $return_data .= "<tr><td>" . $drug_history->drug_taken . "</td>";
                $return_data .= "<td>" . $drug_history->from_date . "</td>";
                $return_data .= "<td>" . $drug_history->to_date . "</td>";
                $return_data .= "<td>" . $drug_history->disease . "</td>";
                $return_data .= "<td>" . $drug_history->currently_taking . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_drug_history(this)' value='" . $drug_history->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm' onclick='del_drug_history(this)' value='" . $drug_history->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";
                // $return_data.="<td><button value=".$vital->id."onclick='edit_vital(this);'class='hollow button' ><span class='icon-pencil5'>Edit  </span></button></td>";
                // $return_data.="<td><button value=".$vital->id." onclick='delete_vital(this);' class='hollow button'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['drug_his' => $return_data, 'id=>$id']);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['drug_his' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['drug_his' => 'generic', 'item' => 'item_success']);
    }

    public function customer_history($customer_id, Request $request)
    {
        $data = [];
        $data['customer_id'] = $customer_id;
        $data['modify'] = 1;
        $customer_data = $this->customer->find ($customer_id);
        //dd($customer_data );

        $data['customer_name'] = $customer_data->customer_name;
        $data['address'] = $customer_data->address;
        $data['city'] = $customer_data->city;
        $data['mobile'] = $customer_data->mobile;
        $data['remark'] = $customer_data->remark;
        $data['age'] = $customer_data->age;
        $data['gender'] = $customer_data->gender;
        $data['blood_type'] = $customer_data->blood_type;
        $data['tri'] = $customer_data->trimester;
        $data['preg'] = $customer_data->pregnant;
        $data['regular_customer'] = $customer_data->regular_customer;

        if ($customer_data->balance >= 0) {
            $data['balance_amount'] = abs ($customer_data->balance);
            $data['balance_type'] = 'unpaid';
        } else if ($customer_data->balance < 0) {
            $data['balance_amount'] = abs ($customer_data->balance);
            $data['balance_type'] = 'overpaid';
        }
        $data['vital_signs'] = DB::table ('vital_signs')
            ->where ('vital_signs.customer', $customer_id)
            ->get ();
        $data['drug_history'] = DB::table ('drug_history')
            ->where ('drug_history.customer', $customer_id)
            ->get ();

        $data['diagnosis_list'] = DB::table ('patient_diagnosis')
            ->where ('patient_diagnosis.customer', $customer_id)
            ->get ();

        $data['allergys'] = DB::table ('drug_allergy')
            ->where ('drug_allergy.customer', $customer_id)
            ->get ();
        $data['drug_perscription'] = DB::table ('drug_perscription')
            ->where ('drug_perscription.customer', $customer_id)
            ->get ();

        $data['soaps'] = DB::table ('soap')
            ->where ('soap.customer', $customer_id)
            ->get ();

        $data['items'] = DB::table ('items')
            ->get ();
        $data['appointments'] = DB::table ('appointment_date')
            ->where ('appointment_date.customer', $customer_id)
            ->get ();


        $pdf = PDF::loadView ('reports/customer_history_report', $data);
        $pdf->save (storage_path () . '_filename.pdf');
        return $pdf->stream ('sales.pdf');
    }

    public function add_vital_sign(Request $request)
    {

        $data = [];

        $total_amount = 0.00;

        $input = $request->all ();

        try {

            //$customer_id = $request->customer_id;
            $id = $request->id;
            $date_vital = $request->date_vital;
            $bp_sys = $request->bp_sys;
            $bp_dys = $request->bp_dys;
            $blood_glu = $request->blood_glu;
            $temp = $request->temp;
            $pulse = $request->pulse;
            $spo2 = $request->spo2;
            $weight = $request->weight;

            $user = auth ()->user ();

            DB::table ('vital_signs')->insert (
                ['customer' => $id,
                    'date' => $date_vital,
                    'bp_sys' => $bp_sys,
                    'bp_dys' => $bp_dys,
                    'temp' => $temp,
                    'sugar' => $blood_glu,
                    'pulse' => $pulse,
                    'weight' => $weight,
                ]
            );


            $vitals = DB::table ('vital_signs')
                ->where ('customer', '=', $id)
                ->get ();

            $return_data = "";

            foreach ($vitals as $vital) {

                $return_data .= "<tr><td>" . $vital->date . "</td>";
                $return_data .= "<td>" . $vital->bp_sys . "/" . $vital->bp_dys . "</td>";
                $return_data .= "<td>" . $vital->sugar . "</td>";
                $return_data .= "<td>" . $vital->pulse . "</td>";
                $return_data .= "<td>" . $vital->temp . "</td>";
                $return_data .= "<td>" . $vital->weight . "</td>";
                $return_data .= "<td><button class='btn btn-success'onclick='edit_vital(this)' value='" . $vital->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger delete_vital_btn'  onclick='del_vital(this)'  value='" . $vital->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";
                // $return_data.="<td><button value=".$vital->id."onclick='edit_vital(this);'class='hollow button' ><span class='icon-pencil5'>Edit  </span></button></td>";
                // $return_data.="<td><button value=".$vital->id." onclick='delete_vital(this);' class='hollow button'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['vital' => $return_data, 'id=>$id']);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['vital' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['vital' => 'generic', 'item' => 'item_success']);
    }

    //for deleting vital rows
    public function delete_vital(Request $request)
    {
        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('vital_signs')->where ('id', '=', $id)->delete ();

            $vitals = DB::table ('vital_signs')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($vitals as $vital) {

                $return_data .= "<tr><td>" . $vital->date . "/</td>";
                $return_data .= "<td>" . $vital->bp_sys . "/" . $vital->bp_dys . "</td>";
                $return_data .= "<td>" . $vital->sugar . "</td>";
                $return_data .= "<td>" . $vital->pulse . "</td>";
                $return_data .= "<td>" . $vital->temp . "</td>";
                $return_data .= "<td>" . $vital->weight . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_vital(this)' value='" . $vital->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm' onclick='del_vital(this)' value='" . $vital->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

                // $return_data.="<td><button value=".$vital->id."onclick='edit_vital(this);'class='hollow button' ><span class='icon-pencil5'>Edit  </span></button></td>";
                // $return_data.="<td><button value=".$vital->id." onclick='delete_vital(this);' class='hollow button'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['vital' => $return_data, 'id=>$id']);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['vital' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['vital' => 'generic', 'item' => 'item_success']);
    }


    ///for deleting Allergy
    public function delete_allergy_sign(Request $request)
    {

        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('drug_allergy')->where ('id', '=', $id)->delete ();

            $allergys = DB::table ('drug_allergy')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($allergys as $allergy) {

                $return_data .= "<tr><td>" . $allergy->allergy . "</td>";
                $return_data .= "<td>" . $allergy->drug . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_allergy(this)' value='" . $allergy->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm' onclick='del_allergy(this)' value='" . $allergy->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";
                // $return_data.="<td><button value=".$vital->id."onclick='edit_vital(this);'class='hollow button' ><span class='icon-pencil5'>Edit  </span></button></td>";
                // $return_data.="<td><button value=".$vital->id." onclick='delete_vital(this);' class='hollow button'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['allergy_data' => $return_data, 'id=>$id']);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['allergy_data' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['allergy_data' => 'generic', 'item' => 'item_success']);


    }
/// End of Delete allergy

//delete soap function

    public function delete_soap(Request $request)
    {

        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('soap')->where ('id', '=', $id)->delete ();

            $soaps = DB::table ('soap')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($soaps as $soap) {
                $return_data .= "<tr><td>" . $soap->date . "</td>";
                $return_data .= "<td>" . $soap->subjective . "</td>";
                $return_data .= "<td>" . $soap->objective . "</td>";
                $return_data .= "<td>" . $soap->assessment . "</td>";
                $return_data .= "<td>" . $soap->plan . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_soap(this)' value='" . $soap->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm' onclick= 'del_soap(this)' value='" . $soap->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['soap' => $return_data]);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['soap' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['soap' => 'generic', 'item' => 'item_success']);

    }

    //end of soap deletion
///This is for diagnosis
    public function delete_perscription(Request $request)
    {

        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('drug_perscription')->where ('id', '=', $id)->delete ();

            $perscriptions = DB::table ('drug_perscription')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($perscriptions as $perscription) {
                $return_data .= "<tr><td>" . $perscription->drug . "</td>";
                $return_data .= "<td>" . $perscription->perscriber . "</td>";
                $return_data .= "<td>" . $perscription->date . "</td>";
                $return_data .= "<td>" . $perscription->perscriber_position . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_perscription(this)' value='" . $perscription->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm' onclick= 'del_perscription(this)' value='" . $perscription->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['perscription' => $return_data]);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['perscription' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['perscription' => 'generic', 'item' => 'item_success']);

    }

    ///Drug History
    public function delete_drug_history(Request $request)
    {

        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('drug_history')->where ('id', '=', $id)->delete ();

            $drug_historys = DB::table ('drug_history')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($drug_historys as $drug_history) {

                $return_data .= "<tr><td>" . $drug_history->drug_taken . "</td>";
                $return_data .= "<td>" . $drug_history->from_date . "</td>";
                $return_data .= "<td>" . $drug_history->to_date . "</td>";
                $return_data .= "<td>" . $drug_history->disease . "</td>";
                $return_data .= "<td>" . $drug_history->currently_taking . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_drug_history(this)' value='" . $drug_history->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm' onclick='del_drug_history(this)' value='" . $drug_history->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";
                // $return_data.="<td><button value=".$vital->id."onclick='edit_vital(this);'class='hollow button' ><span class='icon-pencil5'>Edit  </span></button></td>";
                // $return_data.="<td><button value=".$vital->id." onclick='delete_vital(this);' class='hollow button'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['drug_his' => $return_data, 'id=>$id']);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['drug_his' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['drug_his' => 'generic', 'item' => 'item_success']);

    }

///for diagnosis
    public function delete_diagnosis(Request $request)
    {

        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('patient_diagnosis')->where ('id', '=', $id)->delete ();

            $diagnosis = DB::table ('patient_diagnosis')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($diagnosis as $diagno) {
                $return_data .= "<tr><td>" . $diagno->date . "</td>";
                $return_data .= "<td>" . $diagno->diagnosis . "</td>";
                $return_data .= "<td>" . $diagno->description . "</td>";
                $return_data .= "<td>" . $diagno->status . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_diagnosis(this)' value='" . $diagno->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm' onclick='del_diagnosis(this)' value='" . $diagno->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";


            }

            return response ()->json (['diagno' => $return_data]);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['diagno' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['diagno' => 'generic', 'item' => 'item_success']);
    }

///the code below is used for editing the patient datas

    public function edit_vital(Request $request)
    {
        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('vital_signs')->where ('id', '=', $id)->delete ();

            $vitals = DB::table ('vital_signs')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($vitals as $vital) {

                $return_data .= "<tr><td>" . $vital->date . "</td>";
                $return_data .= "<td>" . $vital->bp_sys . "</td>";
                $return_data .= "<td>" . $vital->bp_dys . "</td>";
                $return_data .= "<td>" . $vital->sugar . "</td>";
                $return_data .= "<td>" . $vital->pulse . "</td>";
                $return_data .= "<td>" . $vital->temp . "</td>";
                $return_data .= "<td>" . $vital->weight . "</td>";
                $return_data .= "<td><button class='btn btn-success btn-sm' onclick='edit_vital(this)' value='" . $vital->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger  btn-sm' onclick='del_vital(this)' value='" . $vital->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

                // $return_data.="<td><button value=".$vital->id."onclick='edit_vital(this);'class='hollow button' ><span class='icon-pencil5'>Edit  </span></button></td>";
                // $return_data.="<td><button value=".$vital->id." onclick='delete_vital(this);' class='hollow button'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['vital' => $return_data, 'id=>$id']);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['vital' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['vital' => 'generic', 'item' => 'item_success']);

    }

    ///for deleting Allergy
    public function edit_allergy_sign(Request $request)
    {

        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('drug_allergy')->where ('id', '=', $id)->delete ();

            $allergys = DB::table ('drug_allergy')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($allergys as $allergy) {

                $return_data .= "<tr><td>" . $allergy->allergy . "</td>";
                $return_data .= "<td>" . $allergy->drug . "</td>";
                $return_data .= "<td><button class='btn btn-primary' onclick='edit_allergy(this)' value='" . $allergy->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger delete_allergy_btn' onclick='del_allergy(this)' value='" . $allergy->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";
                // $return_data.="<td><button value=".$vital->id."onclick='edit_vital(this);'class='hollow button' ><span class='icon-pencil5'>Edit  </span></button></td>";
                // $return_data.="<td><button value=".$vital->id." onclick='delete_vital(this);' class='hollow button'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['allergy_data' => $return_data, 'id=>$id']);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['allergy_data' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['allergy_data' => 'generic', 'item' => 'item_success']);


    }
/// End of Delete allergy

///This is for diagnosis
    public function edit_perscription(Request $request)
    {

        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('drug_perscription')->where ('id', '=', $id)->delete ();

            $perscriptions = DB::table ('drug_perscription')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($perscriptions as $perscription) {
                $return_data .= "<tr><td>" . $perscription->drug . "</td>";
                $return_data .= "<td>" . $perscription->perscriber . "</td>";
                $return_data .= "<td>" . $perscription->date . "</td>";
                $return_data .= "<td>" . $perscription->perscriber_position . "</td>";
                $return_data .= "<td><button class='btn btn-edit btn-sm' onclick='edit_perscription(this)' value='" . $perscription->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger btn-sm' onclick= 'del_perscription(this)' value='" . $perscription->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['perscription' => $return_data]);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['perscription' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['perscription' => 'generic', 'item' => 'item_success']);

    }

    ///Drug History
    public function edit_drug_history(Request $request)
    {

        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('drug_history')->where ('id', '=', $id)->delete ();

            $drug_historys = DB::table ('drug_history')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($drug_historys as $drug_history) {

                $return_data .= "<tr><td>" . $drug_history->drug_taken . "</td>";
                $return_data .= "<td>" . $drug_history->from_date . "</td>";
                $return_data .= "<td>" . $drug_history->to_date . "</td>";
                $return_data .= "<td>" . $drug_history->disease . "</td>";
                $return_data .= "<td>" . $drug_history->currently_taking . "</td>";
                $return_data .= "<td><button class='btn btn-primary' onclick='edit_drug_history(this)' value='" . $drug_history->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger' onclick='del_drug_history(this)' value='" . $drug_history->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";
                // $return_data.="<td><button value=".$vital->id."onclick='edit_vital(this);'class='hollow button' ><span class='icon-pencil5'>Edit  </span></button></td>";
                // $return_data.="<td><button value=".$vital->id." onclick='delete_vital(this);' class='hollow button'><span class='icon-pencil5'> Delete</span></button></td></tr> ";

            }

            return response ()->json (['drug_his' => $return_data, 'id=>$id']);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['drug_his' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['drug_his' => 'generic', 'item' => 'item_success']);


    }

///for diagnosis
    public function edit_diagnosis(Request $request)
    {

        try {

            $id = $request->id;
            $customer = $request->customer;
            DB::table ('patient_diagnosis')->where ('id', '=', $id)->delete ();

            $diagnosis = DB::table ('patient_diagnosis')
                ->where ('customer', '=', $customer)
                ->get ();

            $return_data = "";

            foreach ($diagnosis as $diagno) {
                $return_data .= "<tr><td>" . $diagno->date . "</td>";
                $return_data .= "<td>" . $diagno->diagnosis . "</td>";
                $return_data .= "<td>" . $diagno->description . "</td>";
                $return_data .= "<td>" . $diagno->status . "</td>";
                $return_data .= "<td><button class='btn btn-primary' onclick='edit_diagnosis(this)' value='" . $diagno->id . "'><span class='icon-pencil5'>Edit  </span></button></td>";
                $return_data .= "<td><button class='btn btn-danger' onclick='del_diagnosis(this)' value='" . $diagno->id . "'><span class='icon-pencil5'> Delete</span></button></td></tr> ";


            }

            return response ()->json (['diagno' => $return_data]);

        } catch (\Exception $e) {

            DB::rollBack ();
            //throw $e;
            return response ()->json (['diagno' => $e, 'item' => 'error' . $e]);
        }
        return response ()->json (['diagno' => 'generic', 'item' => 'item_success']);


    }



}
