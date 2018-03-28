<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
           $table->increments('id');
           $table->string('notification');
           $table->string('execute');
           $table->string('validate')->default('no');
           $table->string('customer_id')->nullable();
           $table->string('seller_id')->nullable();
           $table->string('For')->nullable();
           $table->string('Extra')->nullable();

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
        Schema::dropIfExists('notifications');
    }
}
