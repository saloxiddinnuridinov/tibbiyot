<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermJoinVideoFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_join_video_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("term_id");
            $table->foreign("term_id")->references("id")->on("terms");
            $table->unsignedBigInteger("video_file_id");
            $table->foreign("video_file_id")->references("id")->on("video_files");
            $table->unique(["term_id", "video_file_id"]);
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
        Schema::dropIfExists('term_join_video_files');
    }
}
