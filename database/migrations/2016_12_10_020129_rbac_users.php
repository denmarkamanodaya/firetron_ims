<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RbacUsers extends Migration
{
    private $table_name = 'rbac_users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('user_id', true);
        //     $table->string('user_username', 30);
        //     $table->string('user_last_name', 30);
        //     $table->string('user_first_name', 30);
        //     $table->integer('is_active')->unsigned();
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
