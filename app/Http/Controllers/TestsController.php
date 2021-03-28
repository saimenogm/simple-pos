<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use QrCode;

class TestsController extends Controller
{
    //
    public function get_qr(){

        $data['qr'] = QrCode::size(200)->generate('ABCD-12-57-uiop; name:sigmen');
        return view('test/qr',$data);

    }

}
