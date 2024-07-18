<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendences', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('day', 20)->nullable();
            $table->time('punch_in')->nullable();
            $table->string('attendence_marked', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->time('punch_out')->nullable();
            $table->time('hours')->nullable();
            $table->integer('A_R')->nullable(); // Assumed 'AR' means 'Actual Rest'
            $table->integer('L_R')->nullable(); // Assumed 'LR' means 'Lunch Rest'
            $table->integer('SHR_H')->nullable(); // Assumed 'SHR_H' means 'Short Hours'
            $table->integer('W_H')->nullable(); // Assumed 'W_H' means 'Worked Hours'
            $table->tinyInteger('status')->default(1)->comment('0=Inactive, 1=Active');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendences');
    }
};
