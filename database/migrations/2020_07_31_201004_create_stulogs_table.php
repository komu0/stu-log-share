<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStulogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stulogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('content')->nullable();
            $table->string('thought')->nullable();
            $table->date('log_date');
            $table->time('study_time');
            $table->timestamps();
            
            //user_id1つにつきlogdateは1つなのでunique制約
            $table->unique(['user_id', 'log_date'],'unique_user_id_log_date'); 
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stulogs');
    }
}
