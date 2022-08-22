<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTryoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tryouts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->integer('duration')->default(0);
            $table->integer('question')->default(0);
            $table->dateTime('date')->nullable();
            $table->tinyInteger('deleted')->default(0);
            $table->string('tags')->nullable();
            $table->double('price')->nullable();
            $table->tinyInteger('published')->nullable();
            $table->string('featured')->nullable();
            $table->integer('passing_grade')->default(0);
            $table->integer('twk_passing_grade')->default(0);
            $table->integer('tiu_passing_grade')->default(0);
            $table->integer('tkp_passing_grade')->default(0);
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
        Schema::dropIfExists('tryouts');
    }
}
