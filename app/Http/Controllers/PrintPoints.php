<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PdfReport;
use PDF;


class PrintPoints extends Controller
{
    //

    public function midterm()
    {
        $pdf = PDF::loadView('school/mid_term_report');
        $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('sales.pdf');
    }

    public function achievement()
    {
        $pdf = PDF::loadView('school/over_all_achievement_report');
        $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('sales.pdf');
    }

    public function roaster()
    {

        $pdf = PDF::loadView('school/roaster');
        $pdf->setPaper('A4', 'landscape');
        $pdf->save(storage_path().'_filename.pdf');
        return $pdf->stream('sales.pdf');
    }

}
