<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRisksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risks', function (Blueprint $table) {
            $table->id();
            $table->date('accident_date')->nullable();
            $table->time('accident_time')->nullable();
            $table->string('place', 100)->nullable();
            $table->string('in_person', 50)->nullable();
            $table->string('name_in', 50)->nullable();
            $table->string('risk_type', 100)->nullable();
            $table->longText('risk_detail')->nullable();
            $table->string('other_detail', 100)->nullable();
            $table->string('file_path')->nullable();
            $table->string('correction')->nullable();
            $table->integer('impact_perform')->nullable();
            $table->integer('impact_property')->nullable();
            $table->string('suggestion', 200)->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('risks');
    }
}
