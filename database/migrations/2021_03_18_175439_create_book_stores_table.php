<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_stores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id_add')->nullable();
            $table->string('book_type', 50)->nullable();
            $table->string('name_book', 100)->nullable();
            $table->string('book_storage', 100)->nullable();
            $table->longText('book_detail', 255)->nullable();
            $table->string('book_from', 50)->nullable();
            $table->string('book_unit', 50)->nullable();
            $table->string('book_image', 50)->nullable();
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
        Schema::dropIfExists('book_stores');
    }
}
