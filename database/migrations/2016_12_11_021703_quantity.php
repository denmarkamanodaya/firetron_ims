<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Quantity extends Migration
{
    private $table_name = 'quantity';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('quantity_id', true);
        //     $table->string('code_id')->unique();
        //     $table->decimal('quantity', 10, 2);
        //     $table->integer('added_by_id')->unsigned();
        //     $table->timestamps();
        // });

        // Schema::table($this->table_name, function (Blueprint $table) 
        // {
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
