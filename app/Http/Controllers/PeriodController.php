<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period as Period;


class PeriodController extends Controller
{
    //

    public function __construct(Period $period )
    {
        $this->period = $period;
    }

    public function index()
    {
        $data = [];

        $data['periods'] = $this->period->all();
        //dd($data['periods']);
        return view('periods/index', $data);
    }

    public function newPeriod(Request $request, Period $period)
    {
        $data = [];
        $data['period_name'] = $request->input('period_name');
        $data['start_date'] = $request->input('start_date');
        $data['end_date'] = $request->input('end_date');

        if( $request->isMethod('post') )
        {
            //dd($data);
            
            $this->validate(
                $request,
                [
                    
                ]
            );
            

            $period->insert($data);

            return redirect('periods');
        }
        
        return view('periods/form', $data);

    }


    public function modify( Request $request, $period_id, Period $period )
    {
        $data = [];

        $data['period_name'] = $request->input('period_name');
        $data['start_date'] = $request->input('start_date');
        $data['end_date'] = $request->input('end_date');

        if( $request->isMethod('post') )
        {
            //dd($data);
            $this->validate(
                $request,
                [
                    
                ]
            );
            

            $period_data = $this->period->find($period_id);

            $period_data->period_name = $request->input('period_name');
            $period_data->start_date = $request->input('start_date');
            $period_data->end_date = $request->input('end_date');

            $period_data->save();

            return redirect('periods');
        }
        
        return view('period/detail', $data);
    }

    public function show($period_id)
    {
        $data = []; $data['period_id'] = $period_id;
        $data['modify'] = 1;
        $period_data = $this->period->find($period_id);
        $data['period_name'] = $period_data->period_name;
        $data['start_date'] = $period_data->start_date;
        $data['end_date'] = $period_data->end_date;
        
        return view('periods/detail', $data);
    }

    public function createPeriod(Request $request, Period $period)
    {
        
        return view('periods/form');

    }


    public function create()
    {
            return view('periods/create');
    }
}
