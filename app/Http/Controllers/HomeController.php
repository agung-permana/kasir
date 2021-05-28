<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Temporder;
use App\Charts\Daily;
use App\Charts\Monthly;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime("-1 days"));
        $income_today = Order::where('created_at', 'LIKE', "$today%")->sum('total');
        $income_yesterday = Order::where('created_at', 'LIKE', "$yesterday%")->sum('total');
        $product = Product::count();
        
        // buat date
        $startDate = date('Y-m-d', mktime(0,0,0, date('m'), 1, date('Y')));

        $data = array();
        $income = array();

        for ($i=$startDate; $i <= $today ; $i++) { 
            $data = substr($i, 8, 2);
            $paid = Order::where('created_at', 'LIKE', "$i$")->sum('total');
            $income[] = $paid;
        }

        // // chart harian
        // $chart_daily = New Daily;
        // $chart_daily->labels($date);
        // $chart_daily->dataset('Grafik Penjualan Bulan ini', 'line', $income);

        // // buat bulanan
        // $month = array();
        // $income_monthly = array();
        // for ($i=1; $i <= 12 ; $i++) { 
        //     $month[] = Date::parse(mktime(0, 0, 0, $i, 1, date('Y')))->format('F');
        //     $paid_monthly = Order::select('created_at')->whereBetween('created_at', array(date('Y-m-d', mktime(0,0,0, $i, 1, date('Y'))), date('Y-m-d', mktime(0,0,0, $i, 1, 32, date('Y'))) ))->sum('total');

        //     $income_monthly[] = $paid_monthly;
        // }

        // // chart bulanan
        // $chart_monthly = New Monthly;
        // $chart_monthly->labels($month);
        // $chart_monthly->dataset('Grafik Penjualan Perbulan', 'line', $income_monthly);

        $temp_orders = Temporder::all();
        
        if(Auth::user()->hasRole('kasir')) {
            return view('dashboard', compact('temp_orders'));
        }

        if(Auth::user()->hasRole('owner')) {
            return view('home', compact('categories', 'income_today', 'income_yesterday', 'product'));
        }

    }

    public function search(Request $request)
    {
        $search = $request->term;
        $data = Product::where('name', 'LIKE', '%'. $search. '%')
        ->take(10)
        ->get();
        $result=array();
        foreach ($data as $key => $value) {
            $result[]=['price'=>$value->price,'id'=>$value->id, 'value'=>$value->name];
        }
        return response()->json($result);
    }

    
}
