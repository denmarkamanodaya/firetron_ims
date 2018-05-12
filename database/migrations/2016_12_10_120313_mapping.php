<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mapping extends Migration
{
    private $table_name = 'mapping';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('bnm_id', true);
        //     $table->string('mapping_type');
        //     $table->integer('product_id')->unsigned();
        //     $table->integer('component_id')->unsigned();
        //     $table->decimal('component_value', 10, 2);
        //     $table->integer('added_by_id')->unsigned();
        // });

        // Schema::table($this->table_name, function (Blueprint $table) 
        // {
        //     $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        //     $table->foreign('component_id')->references('component_id')->on('components')->onDelete('cascade');
        //     $table->foreign('added_by_id')->references('user_id')->on('rbac_users')->onDelete('cascade');
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
