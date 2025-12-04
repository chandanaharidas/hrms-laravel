<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('h_r_messages', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('emp_id');
        $table->string('subject');
        $table->text('message');
        $table->timestamps();

        $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade');
    });
} 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('h_rmessages');
    }
};
