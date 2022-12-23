<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermJoinImageFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_join_image_files', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger("term_id");
            $table->foreign("term_id")->references("id")->on("terms");
            $table->unsignedBigInteger("image_file_id");
            $table->foreign("image_file_id")->references("id")->on("image_files");
            $table->unique(["term_id", "image_file_id"]);
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
        Schema::dropIfExists('term_join_image_files');
    }
}
