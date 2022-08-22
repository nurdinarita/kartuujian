<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTryoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_tryouts', function (Blueprint $table) {
            $table->id();
            $table->integer('tryout_id');
            $table->integer('user_id');
            $table->integer('student_id')->nullable();
            $table->string('key')->nullable();
            $table->integer('status')->default(0); // 0 belum dikerjakan, 1 mengerjakan, 2 selesai
            $table->dateTime('start_at')->nullable();
            $table->dateTime('finish_at')->nullable();
            $table->integer('remaining_time')->default(0);
            $table->integer('twk_score')->default(0);
            $table->integer('tui_score')->default(0);
            $table->integer('tkp_score')->default(0);
            $table->integer('total_score')->default(0);
            $table->integer('last_question')->default(0);
            $table->text('note')->nullable();
            $table->tinyInteger('is_free')->default(1); // 0, 1
            $table->tinyInteger('is_graduated')->default(0); // 0, 1
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
        Schema::dropIfExists('student_tryouts');
    }
}
