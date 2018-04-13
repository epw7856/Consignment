<?php

use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales')->insert([
            'custid' => 'BML',
            'itemid' => 'BML-1-A1-LISTED',
            'title' => 'Justin Boots Chocolate Puma L2562 Size 10 Women Leather',
            'status' => 'LISTED',
            'listed' => '2018-02-12',
            'sold' => '2018-04-12',
            'salesid' => '344632',
            'fee' => '25.43',
            'saleamt' => '89.00',
            'costs' => '12.00',
            'consignfee' => '18.00',
            'due' => '48.00',
        ]);

        DB::table('sales')->insert([
            'custid' => 'SMT',
            'itemid' => 'SMT-3-D6-LISTED',
            'title' => 'Justin Boots Chocolate Puma L2562 Size 10 Women Leather',
            'status' => 'LISTED',
            'listed' => '2018-02-12',
            'sold' => '2018-04-12',
            'salesid' => '344632',
            'fee' => '25.10',
            'saleamt' => '89.00',
            'costs' => '12.00',
            'consignfee' => '18.00',
            'due' => '48.00',
        ]);
    }
}
