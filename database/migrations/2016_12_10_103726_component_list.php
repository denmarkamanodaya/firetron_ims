<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComponentList extends Migration
{
    private $table_name = 'components';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('component_id', true);
        //     $table->string('component_code', 10)->nullable();
        //     $table->string('component_name', 100);

        //     $table->integer('component_category_id')->unsigned();

        //     $table->integer('added_by_id')->unsigned();

        //     $table->timestamps();
        // });

        // Schema::table($this->table_name, function (Blueprint $table) 
        // {
        //     $table->foreign('component_category_id')->references('category_id')->on('component_category')->onDelete('cascade');
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
