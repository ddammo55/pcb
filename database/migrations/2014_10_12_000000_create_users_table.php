<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');    #id
            $table->string('name');     #이름
            $table->string('email')->unique();  #이메일
            $table->timestamp('email_verified_at')->nullable(); # 이메일인증
            $table->string('password');             # 패스워드
            $table->integer('level')->default(1);  # 레벨
            $table->string('profile_image')->nullable(); //프로필 이미지 필드
            $table->integer('Employee_number')->nullable();  # 사원번호
            $table->string('position')->nullable();  # 직책
            $table->string('date_of_entry')->nullable();  # 입사일
            $table->string('task')->nullable();  # 업무
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
