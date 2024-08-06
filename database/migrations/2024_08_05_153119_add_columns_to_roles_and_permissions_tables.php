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
        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedInteger('status')->default(1)->comment('0=Inactive, 1=Active');
            $table->unsignedInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->string('group', 60)->nullable();
            $table->unsignedInteger('status')->default(1)->comment('0=Inactive, 1=Active');
            $table->unsignedInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn(['status', 'created_by', 'updated_by', 'deleted_at']);
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn(['status', 'created_by', 'updated_by', 'deleted_at']);
        });
    }
};
