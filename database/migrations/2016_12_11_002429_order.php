<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Order extends Migration
{
    private $table_name = 'orders';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('order_id', true);
        //     // $table->string('purchase_order');
        //     $table->integer('app_number')->unsigned();
        //     $table->integer('is_active')->default(1)->unsigned();
        //     $table->timestamps();
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
