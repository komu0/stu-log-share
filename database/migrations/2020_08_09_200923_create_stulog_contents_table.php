<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStulogContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stulog_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stulog_id');
            $table->unsignedBigInteger('tag_id');
            $table->double('study_time');
            $table->string('comment')->nullable();
            $table->timestamps();
            
            $table->unique(['stulog_id', 'tag_id']); 
            
            $table->foreign('stulog_id')->references('id')->on('stulogs')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('restrict');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stulog_contents');
    }
}
