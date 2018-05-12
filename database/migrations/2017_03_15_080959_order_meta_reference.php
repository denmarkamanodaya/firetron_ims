<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderMetaReference extends Migration
{
    private $table_name = 'order_meta_reference';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('order_meta_reference_id', true);
        //     $table->integer('app_number')->nullable();
        //     $table->string('product_code');
        //     $table->string('item_code');
        //     $table->string('item_name');
        //     $table->decimal('item_value');
        //     $table->string('mapping_type');
        //     $table->string('item_type');
        //     $table->string('build_type');
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
