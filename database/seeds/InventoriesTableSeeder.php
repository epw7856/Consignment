<?php

use Illuminate\Database\Seeder;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventories')->insert([
            'custid' => 'SMT',
            'sku' => '34',
            'loc' => 'C1',
            'itemid' => 'SMT-1-A41-LISTED',
            'title' => 'Justin Boots Chocolate Puma L2562 Size 10 Women Leather',
            'received' => '2018-06-12',
            'qty' => '1',
            'platform' => 'EBAY',
            'status' => 'LISTED',
        ]);

    }
}
