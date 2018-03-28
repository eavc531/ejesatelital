<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

      public function up()
      {

      Schema::create('vehicles',function (Blueprint $table){
        $table->increments('id');
        $table->string('name')->nullable();
        $table->string('plate');
        $table->string('year')->nullable();
        $table->string('description')->nullable();
        $table->integer('customer_id')->unsigned();
        $table->foreign('customer_id')->references('id')->on('customers');
        $table->timestamps();
      });
 }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
