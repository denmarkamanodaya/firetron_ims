<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderMeta extends Migration
{
    private $table_name = 'order_meta';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('order_meta_id', true);
        //     $table->integer('order_id')->unsigned();
        //     $table->integer('product_id')->unsigned();
        //     $table->string('product_code');
        //     $table->string('product_name');
        //     $table->string('service_type');
        // });

        // Schema::table($this->table_name, function (Blueprint $table) 
        // {
        //     $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
        //     $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop($this->table_name);
    }
}
