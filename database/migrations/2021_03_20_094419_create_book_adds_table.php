<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookAddsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_adds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('book_id')->nullable();
            $table->date('book_date')->nullable();
            $table->integer('book_volume')->nullable();
            $table->string('book_file', 50)->nullable();
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
        Schema::dropIfExists('book_adds');
    }
}
