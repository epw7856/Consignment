<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('custid');
            $table->integer('sku');
            $table->string('loc');
            $table->string('itemid')->unique();
            $table->string('title', 200);
            $table->date('received')->nullable();
            $table->integer('qty');
            $table->string('platform')->nullable();
            $table->string('status');
            $table->date('listed')->nullable();
            $table->date('sold')->nullable();
            $table->integer('salesid')->nullable();
            $table->decimal('fee', 5, 2);
            $table->decimal('saleamt', 8, 2);
            $table->decimal('costs', 8, 2);
            $table->decimal('consignfee', 8, 2);
            $table->decimal('due', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
