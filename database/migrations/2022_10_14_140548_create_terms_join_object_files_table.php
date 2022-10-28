<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsJoinObjectFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_join_object_files', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger("term_id");
            $table->foreign("term_id")->references("id")->on("terms");
            $table->unsignedBigInteger("object_file_id");
            $table->foreign("object_file_id")->references("id")->on("object_files");
            $table->unique(["term_id", "object_file_id"]);
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
        Schema::dropIfExists('terms_join_object_files');
    }
}
