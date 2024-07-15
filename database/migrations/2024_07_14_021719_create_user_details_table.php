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
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('phone', 10);
            $table->string('address', 255);
            $table->enum('gender', ['Male', 'Female'])->comment('Gender of the user');
            $table->date('date_of_birth');
            $table->string('image', 150)->nullable();
            $table->string('role', 20)->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->string('skills', 255)->nullable();
            $table->string('hobbies', 255)->nullable();
            $table->text('about_me')->nullable();
            $table->text('experience')->nullable();
            $table->text('education_details')->nullable();
            $table->text('certifications')->nullable();
            $table->text('achievements')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=Inactive, 1=Active');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('user_id');
            $table->index('status');
            $table->index('created_by');
            $table->index('updated_by');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
