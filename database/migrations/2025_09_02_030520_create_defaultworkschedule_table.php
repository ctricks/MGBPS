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
        Schema::create('defaultworkschedule', function (Blueprint $table) {
            $table->id();
            $table->string('KeySchedule',255)->unique();
            $table->timestamp('StartTime');
            $table->timestamp('EndTime');
            $table->integer('GracePeriodMins')->default(0);
            $table->integer('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defaultworkschedule');
    }
};
