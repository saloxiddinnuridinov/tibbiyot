<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonJoinObjectFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_join_object_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lesson_id");
            $table->foreign("lesson_id")->references("id")->on("lessons");
            $table->unsignedBigInteger("object_file_id");
            $table->foreign("object_file_id")->references("id")->on("object_files");
            $table->unique(["lesson_id", "object_file_id"]);
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
        Schema::dropIfExists('lesson_join_object_files');
    }
}
