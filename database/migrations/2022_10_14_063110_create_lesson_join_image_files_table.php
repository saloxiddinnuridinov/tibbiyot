<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonJoinImageFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_join_image_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lesson_id");
            $table->foreign("lesson_id")->references("id")->on("lessons");
            $table->unsignedBigInteger("image_file_id");
            $table->foreign("image_file_id")->references("id")->on("image_files");
            $table->unique(["lesson_id", "image_file_id"]);
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
        Schema::dropIfExists('lesson_join_image_files');
    }
}
