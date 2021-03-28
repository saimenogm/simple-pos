<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JournalController extends Controller
{
    //

    public function index()
    {
        $data = [];

        $users = DB::table('sales')
            ->join('customers', 'customers.id', '=', 'sales.customer')
            ->get();

   $data['journals'] = DB::table('journals')
            ->join('customers', 'customers.id', '=', 'journals.partner')
            ->get();
     
        return view('journals/index', $data);
        
    }

}
