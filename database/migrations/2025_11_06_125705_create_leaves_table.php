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
    Schema::create('leaves', function (Blueprint $table) {
        $table->id();
        $table->string('emp_id'); // links to employees table
        $table->string('leave_type');
        $table->date('start_date');
        $table->date('end_date');
        $table->text('reason')->nullable();
        $table->string('status')->default('Pending'); // Pending, Approved, Rejected
        $table->timestamps();

        $table->foreign('emp_id')->references('emp_id')->on('employees')->onDelete('cascade');
    });
} 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
};
