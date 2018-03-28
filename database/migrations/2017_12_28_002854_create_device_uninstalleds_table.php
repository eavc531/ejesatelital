<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceUninstalledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_uninstalleds', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name');
           $table->string('sim');
           $table->string('imei');
           $table->integer('vehicle_id')->unsigned();
           $table->foreign('vehicle_id')->references('id')->on('vehicles');
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
        Schema::dropIfExists('device_uninstalleds');
    }
}
