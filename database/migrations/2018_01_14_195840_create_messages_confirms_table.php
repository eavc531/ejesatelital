<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesConfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_confirms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('medioPayment');
            $table->dateTime('dateConfirmPayment');
            $table->string('Banco')->nullable();
            $table->string('nroReferencia')->nullable();
            $table->string('mensaje')->nullable();
            $table->integer('invoice_id');
            $table->string('invoiceperiod');
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
        Schema::dropIfExists('messages_confirms');
    }
}
