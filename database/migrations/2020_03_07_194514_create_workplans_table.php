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

            $table->integer('s1')->nullable();
            $table->integer('s2')->nullable();
            $table->integer('s3')->nullable();
            $table->integer('s4')->nullable();
            $table->integer('s5')->nullable();
            $table->integer('s6')->nullable();
            $table->integer('s7')->nullable();
            $table->integer('s8')->nullable();
            $table->integer('s9')->nullable();

            $table->integer('d1')->nullable();
            $table->integer('d2')->nullable();
            $table->integer('d3')->nullable();
            $table->integer('d4')->nullable();
            $table->integer('d5')->nullable();
            $table->integer('d6')->nullable();
            $table->integer('d7')->nullable();
            $table->integer('d8')->nullable();
            $table->integer('d9')->nullable();
            $table->integer('d10')->nullable();
            $table->integer('d11')->nullable();
            $table->integer('d12')->nullable();
            $table->integer('d13')->nullable();
            $table->integer('d14')->nullable();
            $table->integer('d15')->nullable();

            $table->integer('t1')->nullable();
            $table->integer('t2')->nullable();
            $table->integer('t3')->nullable();
            $table->integer('t4')->nullable();
            $table->integer('t5')->nullable();
            $table->integer('t6')->nullable();
            $table->integer('t7')->nullable();
            $table->integer('t8')->nullable();
            $table->integer('t9')->nullable();
            $table->integer('t10')->nullable();
            $table->integer('t11')->nullable();
            $table->integer('t12')->nullable();
            $table->integer('t13')->nullable();
            $table->integer('t14')->nullable();
            $table->integer('t15')->nullable();
            $table->integer('t16')->nullable();
            $table->integer('t17')->nullable();
            $table->integer('t18')->nullable();
            $table->integer('t19')->nullable();
            $table->integer('t20')->nullable();
            $table->integer('t21')->nullable();
            $table->integer('t22')->nullable();
            $table->integer('t23')->nullable();
            $table->integer('t24')->nullable();

            $table->integer('a1')->nullable();
            $table->integer('a2')->nullable();
            $table->integer('a3')->nullable();
            $table->integer('a4')->nullable();
            $table->integer('a5')->nullable();
            $table->integer('a6')->nullable();
            $table->integer('a7')->nullable();
            $table->integer('a8')->nullable();
            $table->integer('a9')->nullable();
            $table->integer('a10')->nullable();
            $table->integer('a11')->nullable();
            $table->integer('a12')->nullable();
            $table->integer('a13')->nullable();
            $table->integer('a14')->nullable();
            $table->integer('a15')->nullable();
            $table->integer('a16')->nullable();
            $table->integer('a17')->nullable();
            $table->integer('a18')->nullable();
            $table->integer('a19')->nullable();
            $table->integer('a20')->nullable();
            $table->integer('a21')->nullable();
            $table->integer('a22')->nullable();
            $table->integer('a23')->nullable();
            $table->integer('a24')->nullable();
            $table->integer('a25')->nullable();
            $table->integer('a26')->nullable();
            $table->integer('a27')->nullable();
            $table->integer('a28')->nullable();
            $table->integer('a29')->nullable();
            $table->integer('a30')->nullable();

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
