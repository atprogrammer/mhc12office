<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable(); //จัดเก็บ ID ผู้ขอเบิก(user)
            $table->string('in_person', 50)->nullable(); //จัดเก็บเบิกให้กับ
            $table->string('objective', 255)->nullable(); //จัดเก็บขอรับการสนับสนุนสื่อต่างๆเพื่อใช้ทำอะไร
            $table->string('requester', 100)->nullable(); //จัดเก็บเบิกให้กับ
            $table->bigInteger('st1')->nullable(); //จัดเก็บ สถานะ
            $table->bigInteger('st2')->nullable(); //จัดเก็บ สถานะ
            $table->bigInteger('st3')->nullable(); //จัดเก็บ สถานะ
            $table->bigInteger('st4')->nullable(); //จัดเก็บ สถานะ
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
        Schema::dropIfExists('ref_books');
    }
}
