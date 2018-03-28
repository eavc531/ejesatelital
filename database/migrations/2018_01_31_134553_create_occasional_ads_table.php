<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOccasionalAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occasional_ads', function (Blueprint $table) {
           $table->increments('id');
           $table->string('type');
           $table->string('description');
           $table->string('plate')->nullable();
           $table->bigInteger('payment');
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
        Schema::dropIfExists('occasional_ads');
    }
}
