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
        Schema::create('employee_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_code', 10)->nullable();
            $table->string('salutation', 5);
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('phone', 10);
            $table->string('address', 255);
            $table->string('designation', 50);
            $table->string('department', 30);
            $table->date('date_of_joining');
            $table->date('date_of_birth');
            $table->tinyInteger('gender')->comment('1=Male, 2=Female, 3=Other');
            $table->string('blood_group')->nullable();
            $table->boolean('marital_status')->comment('0=Single, 1=Married');
            $table->string('location')->nullable();
            $table->string('image')->nullable();
            $table->string('department_head')->nullable();
            $table->string('reporting_manager')->nullable();
            $table->string('role_id')->nullable();
            $table->integer('notice_period')->nullable();
            $table->string('entity')->nullable();
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
        Schema::dropIfExists('employee_reports');
    }
};
