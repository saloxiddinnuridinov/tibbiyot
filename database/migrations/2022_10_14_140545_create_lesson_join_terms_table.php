<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonJoinTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_join_terms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lesson_id");
            $table->foreign("lesson_id")->references("id")->on("lessons");
            $table->unsignedBigInteger("term_id");
            $table->foreign("term_id")->references("id")->on("terms");
            $table->unique(["lesson_id", "term_id"]);
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
        Schema::dropIfExists('lesson_join_terms');
    }
}
