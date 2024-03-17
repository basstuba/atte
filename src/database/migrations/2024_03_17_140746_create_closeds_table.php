<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('time_id')->constrained('times')->onDelete('cascade');
            $table->time('break_start')->nullable();
            $table->time('break_end')->nullable();
            $table->time('break_time')->nullable();
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
        Schema::dropIfExists('closeds');
    }
}
