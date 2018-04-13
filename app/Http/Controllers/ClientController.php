<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Inventory;
use App\Sale;
use App\Client;


class ClientController extends Controller
{

	//Query for all registered users and display manage-clients view
    public function view(){

    	$client = DB::table('clients')
        ->select('*')
        ->get();

        return view('manage-clients', ['client' => $client]);

    }

    public function edit(Request $request){

        $this->validate($request, [
        	'username' => 'required|exists:clients,username',
            'custid' => 'nullable|alpha|size:3|unique:clients,custid',
        ]);

        $username = $request->username;
        $client = array(
            'custid' => strtoupper($request->input('custid')),    
        );

        try {
                DB::table('clients')
                ->where('username', $username)
                ->update($client);
                return redirect('/manage-clients')->with('info', 'Client updated successfully!');
            }
        catch (\Exception $e) {
                return back()->with('error', 'Update unsuccessful!');
        }

    }

    
}
