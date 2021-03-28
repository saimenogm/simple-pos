<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class JournalItemController extends Controller
{
    //

    public function index()
    {
        $data = [];


   $data['journal_items'] = DB::table('journal_items')
            ->join('accounts', 'accounts.id', '=', 'journal_items.account_id')
            ->get();
     
        return view('journal_items/index', $data);
        
    }

}
