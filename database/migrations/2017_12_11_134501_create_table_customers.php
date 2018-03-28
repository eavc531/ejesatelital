<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers',function (Blueprint $table){
           $table->increments('id');
           $table->string('name');
           $table->string('idNumber',50)->unique();
           $table->string('address');
           $table->biginteger('phone1')->nullable();
           $table->biginteger('phone2')->nullable();
           $table->string('email',50)->unique();
           $table->string('email2',50)->nullable();
           $table->string('city');
           $table->string('role')->default('Cliente');
           $table->string('password')->default('1234');
           $table->integer('seller_id');
           $table->string('statePayment')->nullable();
           $table->dateTime('paymentTimely')->nullable('nada');
           $table->string('stateUser')->default('Habilitado');
           $table->string('addFor')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
