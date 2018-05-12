<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    private $table_name = 'products';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('product_id', true);
        //     $table->string('product_code', 10)->nullable();
        //     $table->string('product_name', 60);

        //     $table->integer('is_active')->default(1);

        //     $table->integer('category_id')->unsigned();
        //     $table->integer('type_id')->unsigned();   

        //     $table->integer('is_brand_new')->default(0);
        //     $table->integer('is_refill')->default(0);
        //     $table->integer('is_repaint')->default(0);

        //     $table->integer('added_by_id')->unsigned();

        //      $table->text('item_description')->nullable();

        //     $table->timestamps();
        // });

        // Schema::table($this->table_name, function (Blueprint $table) 
        // {
        //     $table->foreign('category_id')->references('category_id')->on('product_category')->onDelete('cascade');
        //     $table->foreign('type_id')->references('type_id')->on('product_type')->onDelete('cascade');
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
