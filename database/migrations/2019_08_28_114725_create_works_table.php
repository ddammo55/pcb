<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('work_no');
            $table->string('title')->nullable();
            $table->string('project_name');
            $table->string('project_code')->nullable();
            $table->string('board_name')->nullable();
            $table->string('assy')->nullable();
            $table->integer('ea');
            $table->string('set_set')->nullable();
            $table->string('end_product_date')->nullable();
            $table->string('status')->default("진행");
            $table->integer('smt')->default(0);
            $table->integer('dip')->default(0);
            $table->integer('aoi')->default(0);
            $table->integer('wave')->default(0);
            $table->integer('cutting')->default(0);
            $table->integer('touchup')->default(0);
            $table->integer('coting')->default(0);
            $table->integer('ass')->default(0);
            $table->integer('packing')->default(0);
            $table->integer('ready')->default(0);
            $table->integer('ect1')->default(0);
            $table->integer('ect2')->default(0);
            $table->integer('wo')->default(0);
            $table->integer('per')->default(0);
            $table->text('memo')->nullable();
            $table->integer('con')->default(0);
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
        Schema::dropIfExists('works');
    }
}
