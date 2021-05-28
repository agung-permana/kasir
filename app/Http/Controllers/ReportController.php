<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $startDate = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));
        $endDate = date('Y-m-d');
        $income = new Order;
        return view('laporan/index', compact('startDate', 'endDate', 'income'));
    }

    public function periode(Request $request)
    {
        $startDate = null;
        $endDate = null;
        $income = new Order;
        
        if (!empty($request->daterange)){
            $startDate = substr($request->daterange, 0, 10);
            $endDate = substr($request->daterange, 13);
        }

        return view('laporan/periode', compact('startDate', 'endDate', 'income'));
    } 

}
