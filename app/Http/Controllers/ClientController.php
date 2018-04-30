<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Inventory;
use App\Sale;
use App\Client;


class ClientController extends Controller
{


    public function queryClients(){

        $client = DB::table('clients')
        ->select('*')
        ->get();

        return $client;

    }
	//Query for all registered users and display manage-customers view
    public function view(){

        $client = self::queryClients();
        return view('manage-customers', ['client' => $client]);

    }

    public function fill($username){

        $client = self::queryClients();

        $pick = DB::table('clients')
        ->select('*')
        ->where('username', $username)
        ->first();

        return view('manage-customers', ['client' => $client, 'pick' => $pick]);

    }

    public function edit(Request $request){

        $this->validate($request, [
            'name' => 'nullable',
        	'username' => 'required|exists:clients,username',
            'custid' => 'nullable|alpha|size:3',
        ]);

        $username = $request->input('username');
        $client = array(
            'name' => $request->input('name'),
            'username' => $username,
            'custid' => strtoupper($request->input('custid')),    
        );

        try {
                DB::table('clients')
                ->where('username', $username)
                ->update($client);
                return redirect('/manage-customers')->with('info', 'Customer updated successfully!');
            }
        catch (\Exception $e) {
                return back()->with('error', 'Update unsuccessful!');
        }

    }

    public function delete($username){

        try {
                DB::table('clients')
                ->where('username', $username)
                ->delete();
                return redirect('/manage-customers')->with('info', 'Customer deleted successfully!');
            }
        catch (\Exception $e) {
                return back()->with('error', 'Delete unsuccessful!');
        }

        
    }

    
}
