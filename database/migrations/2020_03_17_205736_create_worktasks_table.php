<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorktasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worktasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('workplan_id');
            $table->string('process');
            $table->integer('wt');
            $table->text('description')->nullable();
            $table->text('ect1')->nullable();
            $table->text('ect2')->nullable();
            $table->boolean('completed')->default(false);
            $table->string('wr_user');
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
        Schema::dropIfExists('worktasks');
    }
}
