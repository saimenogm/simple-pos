<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account as Account;

use App\Sale as Sale;


class AccountsController extends Controller
{
    //

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function index()
    {
        $data = [];

        $data['accounts'] = $this->account->all();
        return view('accounts/index', $data);
    }

    public function newAccount(Request $request, Account $account)
    {
        $data = [];

        if( $request->isMethod('post') )
        {
            //$client_data = $this->client->find($client_id);

            $account = new Account();

            //$AccountCategory_id = $request->input('category');

            //$AccountCategory = $this->AccountCategory->find($AccountCategory_id);

            $account->account_name = $request->input('account_name');
            $account->description = $request->input('description');
            $account->account_code = $request->input('account_code');
            $account->account_type = $request->input('account_type');

            //$account->accountCategory()->associate($accountCategory); 
     

            $account->save();
        }
        return redirect('accounts');

    }

    public function account_report(Request $request)
    {
        //$data = Customer::get();
        $data['accounts'] = $this->account->all();

        //dd($data);
        $pdf = PDF::loadView('reports/account_report', $data);
        //return $pdf->download('customers.pdf');

        $pdf->save(storage_path().'_filename.pdf');

        // Finally, you can download the file using download function
        return $pdf->stream('customers.pdf');
        //$pdf->render();
        //$pdf->stream();
        
    }

    public function createAccount(Request $request, Account $account)
    {
        $data = [];
        //$data['account'] = $this->account->all();
        //dd($data);
        //$data['accountsCategorys'] = $this->accountCategory->all();
        return view('accounts/form', $data);
    }

    public function show($account_id)
    {
        $data = []; 
        $data['account_id'] = $account_id;
        $data['modify'] = 1;
        $account_data = $this->account->find($account_id);
        $data['account_name'] = $account_data->account_name;
        $data['account_code'] = $account_data->account_code;
        $data['account_type'] = $account_data->account_type;
        $data['description'] = $account_data->description;
        return view('accounts/detail', $data);
    }


    public function modify( Request $request, $account_id, Account $account )
    {
        $data = [];
   


        if( $request->isMethod('post') )
        {
            //dd($data);
            $this->validate(
                $request,
                [
                    
                ]
            );
            

            $account = $this->account->find($account_id);

            $account->account_name = $request->input('account_name');
            $account->description = $request->input('description');
            $account->account_code = $request->input('account_code');
            $account->account_type = $request->input('account_type');
            $account->save();

            return redirect('accounts');
        }
        
        return view('accounts/detail', $data);
    }
}
