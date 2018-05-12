<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Agent extends Migration
{
    private $table_name = 'agent';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('agent_id', true);
        //     $table->string('full_name');
        //     $table->integer('is_active')->default(1)->unsigned();
            
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
