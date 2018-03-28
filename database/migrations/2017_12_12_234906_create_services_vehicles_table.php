<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_vehicles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('services_id')->unsigned();
            $table->foreign('services_id')->references('id')->on('services');

            $table->integer('vehicles_id')->unsigned();
            $table->foreign('vehicles_id')->references('id')->on('vehicles');

            $table->integer('customers_id')->unsigned();
            $table->foreign('customers_id')->references('id')->on('customers');


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
        Schema::dropIfExists('services_vehicles');
    }
}
