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
        Schema::create('employees', function (Blueprint $table) {

               $table->id();
               $table->unsignedBigInteger('user_id')->nullable();
               $table->foreign('user_id')->references('id')-> on('users')->onDelete('cascade');
               $table->string('emp_id')->unique();
               $table->string('name');
               $table->string('email')->unique();
               $table->string('phone')->nullable();
               $table->string('department')->nullable();
               $table->string('designation')->nullable();
               $table->date('join_date')->nullable();
               $table->decimal('salary',10,2)->nullable();
               $table->enum('status',['active','inactive','resigned'])->default('active');
               $table->date('resignation_date')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
