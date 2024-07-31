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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('duration', 10);
            $table->string('client', 50)->nullable();
            $table->string('project', 50)->nullable();
            $table->string('task', 50)->nullable();
            $table->integer('billing_method')->comment('1=Billing, 2=Non-Billing, 3=Mockup')->nullable();
            $table->string('description', 255)->nullable();
            $table->integer('leave_type')->nullable()->comment('1=Sick Leave, 2=Earned Leave, 3=Casual Leave, 4=Optional Leave, 5=Compensatory Leave, 6=Short Leave, 7=Optional Holiday');
            $table->integer('type')->comment('1=Present, 2=Leave, 3=Idle')->nullable();
            $table->unsignedInteger('status')->default(1)->comment('0=Inactive, 1=Active');
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
        Schema::dropIfExists('timesheets');
    }
};
