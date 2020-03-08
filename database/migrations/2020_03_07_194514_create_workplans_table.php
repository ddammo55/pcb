<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workplans', function (Blueprint $table) {
            $table->bigIncrements('id');   #아이디
            $table->string('work_no');  #작업넘버
            $table->string('title')->nullable(); #제목
            $table->string('project_name'); #프로젝트네임
            $table->string('project_code')->nullable(); #프로젝트코드
            $table->string('board_name')->nullable();   #보드네임
            $table->string('assy')->nullable(); #assy네임
            $table->integer('ea');  #수량
            $table->string('set_set')->nullable();  #편성
            $table->string('start_product_date')->nullable(); #작업시작일
            $table->string('end_product_date')->nullable();  #작업완료일
            $table->string('status')->default("진행"); #진행상황
            $table->integer('material_settiog')->default(0); #자재준비
            $table->integer('smt')->default(0); #설비공수
            $table->integer('dip')->default(0); #dip공수
            $table->integer('aoi')->default(0); #aoi공수
            $table->integer('wave')->default(0); #웨이브솔더링, 컷팅 공수
            $table->integer('touchup')->default(0); #터치업 공수
            $table->integer('item_inspection')->default(0); #단품검사 공수
            $table->integer('coting')->default(0); #코팅 공수
            $table->integer('ass')->default(0); #assy 공수
            $table->integer('packing')->default(0); #포장 공수
            $table->integer('ready')->default(0); #준비 공수
            $table->integer('ect1')->default(0); #기타1
            $table->integer('ect2')->default(0); #기타2
            $table->integer('wo')->default(0);
            $table->integer('per')->default(0);
            $table->text('memo')->nullable();  #메모
            $table->integer('con')->default(0); #1은 완료 0은 작업중
            $table->string('wr_user'); #글쓴이
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
        Schema::dropIfExists('workplans');
    }
}
