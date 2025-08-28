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
        Schema::create('raw_attendance', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DateKey')->unique();
            $table->timestamp('AttendanceDate')->nullable();
            $table->timestamp('TimeIn')->nullable();
            $table->timestamp('TimeOut')->nullable();
            $table->timestamp('DateUpload')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('UploadedBy')->reference('id')->on('users');            
            $table->foreignId('PostedBy')->reference('id')->on('users');
            $table->boolean('isPosted')->default(0);
            $table->timestamp('PostedDate')->nullable();
            $table->string('FilenameUpload')->nullable();
            $table->boolean('isActive')->default(1);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('UpdatedBy')->reference('id')->on('users');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_attendance');
    }
};
