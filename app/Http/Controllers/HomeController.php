<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Carbon;


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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $username = Auth::user()->username;

        $custid = DB::table('clients')
        ->where('username', $username)
        ->value('custid');

        $date = Input::get('filterDate');
        $today = Carbon::now()->format('Y/m/d');
        $startWeek = Carbon::now()->startOfWeek()->format('Y/m/d');
        $endWeek = Carbon::now()->endOfWeek()->format('Y/m/d');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        if (!is_null($custid)){

                $listed = DB::table('inventories')
                ->select('*')
                ->where('custid', '=', $custid);
                
                $sold = DB::table('sales')
                ->select('*')
                ->where('custid', '=', $custid);

                if ($date == 'Current Year'){
                    $listed = $listed->whereYear('listed', $currentYear)->get();
                    $sold = $sold->whereYear('sold', $currentYear)->get();
                } 
                else if ($date == 'Current Month'){
                    $listed = $listed->whereYear('listed', $currentYear)->whereMonth('listed', $currentMonth)->get();
                    $sold = $sold->whereYear('sold', $currentYear)->whereMonth('sold', $currentMonth)->get();
                }
                else if ($date == 'Current Week'){
                    $listed = $listed->whereBetween('listed', [$startWeek, $endWeek])->get();
                    $sold = $sold->whereBetween('sold', [$startWeek, $endWeek])->get();
                }
                else{
                    $listed = $listed->get();
                    $sold = $sold->get();
                }
            
        }
        else{

            $listed = null; $sold = null;
        }

        //# Items Sold, Gross Amount Sold, Sell Through %, Total Profit
        $amt = 0; $profit = 0; $sellthru = 0;
        if (!is_null($sold)){
            if (!is_null($listed) && (count($listed) > 0)){
                $sellthru = count($sold) / count($listed);
            }
            else {
                $sellthru = 0;
            }
            foreach ($sold as $item){
                $amt += $item->saleamt;
                $profit += $item->consignfee;
            }
        }
        else {
            $sellthru = 0;
        }
        
        //return view('home', ['listed' => $listed, 'sold' => $sold, 'amt' => $amt, 'profit' => $profit, 'sellthru' => $sellthru, 'date' => $date]);

    }

    public function adminindex()
    {
        
        $cust = DB::table('clients')
        ->select('name')
        ->get();

        $date = Input::get('filterDate');
        $today = Carbon::now()->format('Y/m/d');
        $startWeek = Carbon::now()->startOfWeek()->format('Y/m/d');
        $endWeek = Carbon::now()->endOfWeek()->format('Y/m/d');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

       
            $listed = DB::table('inventories')
            ->select('*')
            ->orderby('listed', 'desc');
            
            $sold = DB::table('sales')
            ->select('*')
            ->orderby('sold', 'desc');

            if ($date == 'Current Year'){
                $listed = $listed->whereYear('listed', $currentYear)->get();
                $sold = $sold->whereYear('sold', $currentYear)->get();
            } 
            else if ($date == 'Current Month'){
                $listed = $listed->whereYear('listed', $currentYear)->whereMonth('listed', $currentMonth)->get();
                $sold = $sold->whereYear('sold', $currentYear)->whereMonth('sold', $currentMonth)->get();
            }
            else if ($date == 'Current Week'){
                $listed = $listed->whereBetween('listed', [$startWeek, $endWeek])->get();
                $sold = $sold->whereBetween('sold', [$startWeek, $endWeek])->get();
            }
            else{
                $listed = $listed->get();
                $sold = $sold->get();
            }

        $customer = Input::get('filterCustomer');
        
        if (($customer != 'All Customers') && (!is_null($customer)) && ($customer != 'default')){

            $custid = DB::table('clients')
            ->select('custid')
            ->where('name', '=', $customer)
            ->first()
            ->custid;

            $listed = $listed->where('custid', '=', $custid);
            $sold = $sold->where('custid', '=', $custid);

        }

        //# Items Sold, Gross Amount Sold, Sell Through %, Total Profit
        $amt = 0; $profit = 0; $sellthru = 0;
        if (!is_null($sold)){
            if (!is_null($listed) && (count($listed) > 0)){
                $sellthru = count($sold) / count($listed);
            }
            else {
                $sellthru = 0;
            }
            foreach ($sold as $item){
                $amt += $item->saleamt;
                $profit += $item->consignfee;
            }
        }
        else {
            $sellthru = 0;
        }


        return view('home-admin', ['listed' => $listed, 'sold' => $sold, 'amt' => $amt, 'profit' => $profit, 'sellthru' => $sellthru, 'cust' => $cust, 'date' => $date, 'customer' => $customer]);
        
    }


}
