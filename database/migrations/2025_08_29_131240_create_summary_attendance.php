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
        Schema::create('summary_attendance', function (Blueprint $table) {
            $table->id();
            $table->string('employeecode');
            $table->date('StartDateCutoff');
            $table->date('EndDateCutoff');
            $table->double('RequiredWorkingHours', 8, 2)->default(0.00);
            $table->double('WorkHours', 8, 2)->default(0.00);
            $table->double('NDHours', 8, 2)->default(0.00);
            $table->double('ND8Hours', 8, 2)->default(0.00);
            $table->double('OTHours', 8, 2)->default(0.00);
            $table->double('OT8Hours', 8, 2)->default(0.00);
            $table->double('Absent', 8, 2)->default(0.00);
            $table->double('Late', 8, 2)->default(0.00);
            $table->double('Undertime', 8, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summary_attendance');
    }
};
