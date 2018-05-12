<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Commission extends Migration
{
    private $table_name = 'commission';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create($this->table_name, function (Blueprint $table) 
        // {
        //     $table->increments('commission_id', true);
        //     $table->integer('agent_id')->unsigned();
        //     $table->integer('app_number');
        //     $table->decimal('amount', 10, 2)->unsigned();
        //     $table->integer('is_paid')->default(0)->unsigned();
        // $table->integer('is_active')->default(0)->unsigned();

        //     $table->timestamps();
        // });

        // Schema::table($this->table_name, function (Blueprint $table) 
        // {
        //     $table->foreign('agent_id')->references('agent_id')->on('agent')->onDelete('cascade');
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
