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
            $table->string('objective', 255)->nullable(); //จัดเก็บขอรับการสนับสนุนสื่อต่างๆเพื่อใช้ทำอะไร
            $table->string('requester', 100)->nullable(); //จัดเก็บเบิกให้กับ
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
