<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('student_id')->nullable();
            $table->integer('item');
            $table->double('total');
            $table->double('fee')->default(0);
            $table->double('discount')->default(0);
            $table->double('grand_total');
            $table->string('voucher')->nullable();
            $table->integer('status')->default(0); // pending, paid, failed, canceled
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
        Schema::dropIfExists('transactions');
    }
}
