<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('invoiceNumber');
            $table->biginteger('number');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('idNumberCustomer');
            $table->string('nameCustomer');
            $table->dateTime('dateIni');
            $table->string('invoiceperiod');
            $table->dateTime('paymentTimely');
            $table->string('nameSeller')->nullable();
            $table->string('registered')->nullable();
            $table->string('total');
            $table->string('statePayment')->default('Pendiente');
            $table->string('stateSend')->default('Sin Enviar');
            $table->string('paidOut')->nullable();
            $table->string('type')->default('Occasional');
            $table->string('months')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->dateTime('paymentDate')->nullable();
            $table->dateTime('lastMessage')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
