<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePbasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('project_name')->nullable();  #프로젝트

            $table->string('board_name')->nullable();  #보드명
           
            $table->string('assy_name')->nullable();  #assy_name

            $table->longText('content')->nullable();  #에디터

            $table->string('wr_user')->nullable();  #작성한 유저
            
            $table->string('division')->nullable();  #pba:1 , assy:2

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
        Schema::dropIfExists('pbas');
    }
}
