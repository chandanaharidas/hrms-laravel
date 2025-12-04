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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // reference your employees table
            $table->unsignedBigInteger('employee_id');
            $table->date('date');
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->string('status')->default('Present'); // Present / Absent / Late / etc
            $table->text('note')->nullable();
            $table->timestamps();

            $table->unique(['employee_id', 'date']); // one row per employee per date
            // optional FK:
            // $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
