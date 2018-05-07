<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Inventory;
use App\Sale;
use App\Client;


class UserController extends Controller
{

    //Convert date format
    public static function dtform($date,$format,$delimS,$delimF){

        if(!empty($date)){
            $dateFinal = '';
            if($format == 'm'.$delimS.'d'.$delimS.'Y'){
                $dateFinal_exp = explode($delimS,$date);
                $dateFinal = $dateFinal_exp[2].$delimF.$dateFinal_exp[0].$delimF.$dateFinal_exp[1];
            }else if($format == 'Y'.$delimS.'m'.$delimS.'d'){

                $dateFinal_exp = explode($delimS,$date);
                $dateFinal = $dateFinal_exp[1].$delimF.$dateFinal_exp[2].$delimF.$dateFinal_exp[0];
            }
              return $dateFinal;

        }
        else
            return;
    
    }


    //Checks if the unique itemid is in the inventory or sold table
    public function checkTable($itemid){

        if (DB::table('inventories')->where('itemid', '=', $itemid)->exists()) {
            return 'inventories';
        }
        else {
            return 'sales';
        }
    }


    //Validates user input and builds array for Inventory Model
    public function validateInventory(Request $request){

        $this->validate($request, [
            'custid' => 'required|alpha|size:3',
            'sku' => 'required|integer',
            'loc' => 'required|string',
            'title' => 'required|string',
            'received' => 'nullable|date_format:"m/d/Y"',
            'qty' => 'required|integer',
            'platform' => 'nullable|string',
            'status' => 'required',
            'listed' => 'required|nullable|date_format:"m/d/Y"|after:received',
        ]);

        $item = array(
            'custid' => strtoupper($request->input('custid')),
            'sku' => $request->input('sku'),
            'loc' => strtoupper($request->input('loc')),
            'itemid' => strtoupper($request->input('custid')).'-'.$request->input('sku').'-'.strtoupper($request->input('loc')).'-'.strtoupper($request->get('status')),
            'title' => $request->input('title'),
            'received' => self::dtform($request->input('received'),"m/d/Y","/","-"),
            'qty' => $request->input('qty'),
            'platform' => strtoupper($request->input('platform')),
            'status' => $request->get('status'),
            'listed' => self::dtform($request->input('listed'),"m/d/Y","/","-"),
        );

        return $item;
    }

    //Validates user input and builds array for Sale Model
    public function validateSale(Request $request){

        $this->validate($request, [
            'custid' => 'required|alpha|size:3',
            'sku' => 'required|integer',
            'loc' => 'required|string',
            'title' => 'required|string',
            'received' => 'nullable|date_format:"m/d/Y"',
            'qty' => 'required|integer',
            'platform' => 'nullable|required|string',
            'status' => 'required',
            'listed' => 'required|nullable|date_format:"m/d/Y"|after:received',
            'sold' => 'required|nullable|date_format:"m/d/Y"|after:listed',
            'salesid' => 'nullable|integer',
            'saleamt' => "required|regex:/^\d*(\.\d{1,2})?$/|min:0.00",
            'costs' => "required|regex:/^\d*(\.\d{1,2})?$/|min:0.00|between:0.00,saleamt",
            'pct' => 'required|numeric|between:0.00,100.00',
        ]);

        $item = array(
            'custid' => strtoupper($request->input('custid')),
            'sku' => $request->input('sku'),
            'loc' => strtoupper($request->input('loc')),
            'itemid' => strtoupper($request->input('custid')).'-'.$request->input('sku').'-'.strtoupper($request->input('loc')).'-'.strtoupper($request->get('status')),
            'title' => $request->input('title'),
            'received' => self::dtform($request->input('received'),"m/d/Y","/","-"),
            'qty' => $request->input('qty'),
            'platform' => strtoupper($request->input('platform')),
            'status' => $request->get('status'),
            'listed' => self::dtform($request->input('listed'),"m/d/Y","/","-"),
            'sold' => self::dtform($request->input('sold'),"m/d/Y","/","-"),
            'salesid' => $request->input('salesid'),
            'fee' => $request->input('pct'),
            'saleamt' => $request->input('saleamt'),
            'costs' => $request->input('costs'),
            'consignfee' => $request->input('saleamt') * ($request->input('pct') / 100.00),
            'due' => $request->input('saleamt') - $request->input('costs') - ($request->input('saleamt') * ($request->input('pct') / 100.00)),
        );

        if ($item['due'] < 0.00){
            $item['due'] = 0.00;
        }

        return $item;
    }



    public function insert(Request $request){
    	
        $item = self::validateInventory($request);

        $inventory = new Inventory;
        $inventory->custid = $item['custid'];
        $inventory->sku = $item['sku'];
        $inventory->loc = $item['loc'];
        $inventory->itemid = $item['itemid'];
        $inventory->title = $item['title'];
        $inventory->received = $item['received'];
        $inventory->qty = $item['qty'];
        $inventory->platform = $item['platform'];
        $inventory->status = $item['status'];
        $inventory->listed = $item['listed'];

        try {
            $inventory->save();
            return redirect('/home-admin')->with('info', 'Item added successfully!');
        }
        catch (\Exception $e) {
            return back()->with('error', 'Item already exists in Inventory Database!');
        }


    }

    public function update($itemid){

        $inventory = DB::table(self::checkTable($itemid))
            ->select('*')
            ->where('itemid', $itemid)
            ->first();
        
        return view('update', ['itemid' => $inventory]);
    }

    public function edit(Request $request, $itemid){
        
        //If item exists in Inventory Model and is not set to sold in the form. Update entry in Inventory Model
        if ((self::checkTable($itemid) == 'inventories') && ($request->get('status') != 'SOLD')){

            $item = self::validateInventory($request);
        
            try {
                DB::table(self::checkTable($itemid))
                ->where('itemid', $itemid)
                ->update($item);
                return redirect('/home-admin')->with('info', 'Item updated successfully!');
            }
            catch (\Exception $e) {
                return back()->with('error', 'Update unsuccessful!');
            }

        }

        //If item exists in Inventory Model and is set to sold in the form. Add to Sale Model and delete from Inventory Model
        else if ((self::checkTable($itemid) == 'inventories') && ($request->get('status') == 'SOLD')){

            $item = self::validateSale($request);

            $sale = new Sale;
            $sale->custid = $item['custid'];
            $sale->sku = $item['sku'];
            $sale->loc = $item['loc'];
            $sale->itemid = $item['itemid'];
            $sale->title = $item['title'];
            $sale->received = $item['received'];
            $sale->qty = $item['qty'];
            $sale->platform = $item['platform'];
            $sale->status = $item['status'];
            $sale->listed = $item['listed'];
            $sale->sold = $item['sold'];
            $sale->salesid = $item['salesid'];
            $sale->fee = $item['fee'];
            $sale->saleamt = $item['saleamt'];
            $sale->costs = $item['costs'];
            $sale->consignfee = $item['consignfee'];
            $sale->due = $item['due'];
            
            try {
                $sale->save();
            }
            catch (\Exception $e) {
                return back()->with('error', 'Item already exists in Sold Inventory Database. Update unsuccessful!');
            }


            try {
                DB::table('inventories')
                ->where('itemid', $itemid)
                ->delete();
                return redirect('/home-admin')->with('info', 'Item updated successfully!');
            }
            catch (\Exception $e) {
                return back()->with('error', 'Item could not be deleted from Inventory Database!');
            }

        }

        //If item exists in Sale Model and is not set to sold in the form. Add to Inventory Model and delete from Sale Model
        else if ((self::checkTable($itemid) == 'sales') && ($request->get('status') != 'SOLD')){

            $item = self::validateInventory($request);

            $inventory = new Inventory;
            $inventory->custid = $item['custid'];
            $inventory->sku = $item['sku'];
            $inventory->loc = $item['loc'];
            $inventory->itemid = $item['itemid'];
            $inventory->title = $item['title'];
            $inventory->received = $item['received'];
            $inventory->qty = $item['qty'];
            $inventory->platform = $item['platform'];
            $inventory->status = $item['status'];
            $inventory->listed = $item['listed'];

            try {
                $inventory->save();
            }
            catch (\Exception $e) {
                return back()->with('error', 'Item already exists in Inventory Database. Update unsuccessful!');
            }


            try {
                DB::table('sales')
                ->where('itemid', $itemid)
                ->delete();
                return redirect('/home-admin')->with('info', 'Item updated successfully!');
            }
            catch (\Exception $e) {
                return back()->with('error', 'Item could not be deleted from Sold Inventory Database!');
            }

        }

        //If item exists in Sale Model and is set to sold in the form. Update entry in Sale Model
        else if ((self::checkTable($itemid) == 'sales') && ($request->get('status') == 'SOLD')){

            $item = self::validateSale($request);
        
            try {
                DB::table(self::checkTable($itemid))
                ->where('itemid', $itemid)
                ->update($item);
                return redirect('/home-admin')->with('info', 'Item updated successfully!');
            }
            catch (\Exception $e) {
                return back()->with('error', 'Update unsuccessful!');
            }

        }

        //Fall through - display error message
        else{

            return redirect('/home-admin')->with('error', 'Error encountered. Try operation again.');

        }

        
    }

    public function delete($itemid){

        try {
            DB::table(self::checkTable($itemid))
            ->where('itemid', $itemid)
            ->delete();
            return redirect('/home-admin')->with('info', 'Item Deleted Successfully!');
        }
        catch (\Exception $e) {
            return redirect('/home-admin')->with('error', 'Delete unsuccessful! Try again.');
        }

        
    }

}
