<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('student_tryout_id');
            $table->integer('tryout_id');
            $table->integer('question_id');
            $table->integer('question_number')->default(1);
            $table->string('question_type')->nullable();
            $table->text('answer')->nullable();
            $table->tinyInteger('correct')->default(0);
            $table->integer('point')->default(0);
            $table->tinyInteger('doubt')->default(0);
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
        Schema::dropIfExists('student_answers');
    }
}
