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
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leave_type')->comment('1=Sick Leave, 2=Earned Leave, 3=Casual Leave, 4=Optional Leave, 5=Compensatory Leave, 6=Short Leave, 7=Optional Holiday');
            $table->date('applied_on')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('no_of_days');
            $table->string('reason', 255);
            $table->string('manager')->nullable();
            $table->boolean('is_saved')->default(0)->nullable();
            $table->boolean('is_submitted')->default(0)->nullable();
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
        Schema::dropIfExists('leaves');
    }
};
