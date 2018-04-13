<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

        if (!is_null($custid)){

            $listed = DB::table('inventories')
            ->select('*')
            ->where([['custid', '=', $custid],['status', '!=', 'SOLD'],])
            ->get();
            
            $sold = DB::table('sales')
            ->select('*')
            ->where([['custid', '=', $custid],['status', '=', 'SOLD'],])
            ->get();

        }
        else{

            $listed = null; $sold = null;
        }

        //Amt Sold, Profit
        $amt = 0; $profit = 0;
        if (!is_null($sold)){
            foreach ($sold as $item){
                $amt += $item->saleamt;
                $profit += $item->due;
            }
        }
        
        return view('home', ['listed' => $listed, 'sold' => $sold, 'amt' => $amt, 'profit' => $profit]);

    }

    public function adminindex()
    {
        
        $listed = DB::table('inventories')
        ->select('*')
        ->where('status', 'LISTED')
        ->orWhere('status', 'BUNDLE')
        ->get();
        
        $sold = DB::table('sales')
        ->select('*')
        ->where('status', 'SOLD')
        ->get();

        //Amt Sold, Consignment Profit, Amount Due
        $amt = 0; $profit = 0; $due = 0;
        if (!is_null($sold)){
            foreach ($sold as $item){
                $amt += $item->saleamt;
                $profit += $item->consignfee;
                $due += $item->due;
            }
        }


        return view('home-admin', ['listed' => $listed, 'sold' => $sold, 'amt' => $amt, 'profit' => $profit, 'due' => $due]);
    }

    
}
