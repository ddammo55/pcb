<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');                   #아이디
            $table->string('serial_name')->unique();       #시리얼번호
            $table->string('board_name');                  #보드명
            $table->date('product_date');             #생산일
            $table->date('shipment')->nullable();                 #출하일
            $table->string('user_id')->nullable();              #유저아이디
            $table->integer('aoi_top_part_num')->default(0)->nullable();               #AOI_top_부품수량
            $table->integer('aoi_top_df_num')->default(0)->nullable();                 #AOI_top_불량수량
            $table->integer('aoi_top_df_01')->default(0)->nullable();                  #미삽
            $table->integer('aoi_top_df_02')->default(0)->nullable();                  #미납
            $table->integer('aoi_top_df_03')->default(0)->nullable();                  #쇼트
            $table->integer('aoi_top_df_04')->default(0)->nullable();                  #역삽
            $table->integer('aoi_top_df_05')->default(0)->nullable();                  #오삽
            $table->integer('aoi_top_df_06')->default(0)->nullable();                  #리드뜸
            $table->integer('aoi_top_df_07')->default(0)->nullable();                  #리드부식
            $table->integer('aoi_top_df_08')->default(0)->nullable();                  #모로섬
            $table->integer('aoi_top_df_09')->default(0)->nullable();                  #뒤집힘
            $table->integer('aoi_top_df_10')->default(0)->nullable();                  #틀어짐
            $table->integer('aoi_top_df_11')->default(0)->nullable();                  #냉땜
            $table->integer('aoi_top_df_12')->default(0)->nullable();                  #크랙
            $table->integer('aoi_bot_part_num')->default(0)->nullable();               #AOI_BOT_부품수량
            $table->integer('aoi_bot_df_num')->default(0)->nullable();                 #AOI_BOT_불량수량
            $table->integer('aoi_bot_df_01')->default(0)->nullable();                  #미삽
            $table->integer('aoi_bot_df_02')->default(0)->nullable();                  #미납
            $table->integer('aoi_bot_df_03')->default(0)->nullable();                  #쇼트
            $table->integer('aoi_bot_df_04')->default(0)->nullable();                  #역삽
            $table->integer('aoi_bot_df_05')->default(0)->nullable();                  #오삽
            $table->integer('aoi_bot_df_06')->default(0)->nullable();                  #리드뜸
            $table->integer('aoi_bot_df_07')->default(0)->nullable();                  #리드부식
            $table->integer('aoi_bot_df_08')->default(0)->nullable();                  #모로섬
            $table->integer('aoi_bot_df_09')->default(0)->nullable();                  #뒤집힘
            $table->integer('aoi_bot_df_10')->default(0)->nullable();                  #틀어짐
            $table->integer('aoi_bot_df_11')->default(0)->nullable();                  #냉땜    
            $table->integer('aoi_bot_df_12')->default(0)->nullable();                  #크랙
            $table->string('element')->nullable();                     #관리소자
            $table->date('element_date')->nullable();             #관리입고일
            $table->integer('quantity')->default(1);                       #수량
            $table->integer('coting_t')->default(0);                       #코팅두께
            $table->integer('coting_inp')->default(0);                     #코팅외관검사
            $table->string('shipment_daily')->nullable();                 #출하내역
            $table->integer('con')->default(0);                 #출하내역입력 0 = x , 1 = o
            $table->integer('set_set')->nullable();                        #편성
            $table->integer('faulty')->default(0);                         #불량
            $table->string('remarks')->nullable();                     #불량내역
            $table->string('type')->nullable();                        #타입
            $table->string('note')->nullable();                        #메모
            $table->string('ship_user')->nullable();                        #인계자
            $table->string('receiver')->nullable();                        #인수자
            $table->string('receiver_team')->nullable();                    #인수팀
            $table->string('mod_user')->nullable();                     #수정한유저
            $table->ipAddress('mark_ip')->nullable();                  #등록아이피
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
        Schema::dropIfExists('products');
    }
}
