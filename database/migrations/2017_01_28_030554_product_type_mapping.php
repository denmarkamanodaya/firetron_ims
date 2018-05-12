<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductTypeMapping extends Migration
{
    private $table_name = 'product_type_meta';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('product_type_id', true);
        //     $table->integer('product_id')->unsigned();
        //     $table->string('type_name');
        // });

        // Schema::table($this->table_name, function (Blueprint $table) 
        // {
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
