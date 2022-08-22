<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_id');
            $table->string('type');
            $table->string('code')->nullable();
            $table->string('method');
            $table->string('reference')->nullable();
            $table->string('merchant_ref')->nullable();
            $table->string('pay_code')->nullable();
            $table->dateTime('time_limit')->nullable();
            $table->string('status')->default('UNPAID');
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
        Schema::dropIfExists('transaction_payments');
    }
}
