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
        Schema::create('jobs', function (Blueprint $table) {
      
            $table->id();
            $table->string('title');
             $table->string('department');
             $table->text('description');
             $table->integer('total vaccancies')->default(0);
              $table->integer('filled  vaccancies')->default(0);
              $table->integer('remaining  vaccancies')->default(0);
              $table->string('status')->default('Active');
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
        Schema::dropIfExists('jobs');
    }
};
