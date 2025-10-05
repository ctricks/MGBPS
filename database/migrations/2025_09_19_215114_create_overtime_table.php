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
        Schema::create('overtime', function (Blueprint $table) {
            $table->id();
            $table->string('OvertimeKey')->unique();
            $table->string('EmployeeCode');
            $table->date('OTDate');
            $table->timestamp('ActualIN');
            $table->timestamp('ActualOUT');
            $table->decimal('ActualOTHours');
            $table->decimal('OTHoursApproved')->default(0.00);
            $table->decimal('FiledOTHours');
            $table->decimal('Multiplier')->default(0.00);
            $table->decimal('HourlyRate')->default(0.00);
            $table->decimal('OTPay')->default(0.00);
            $table->string('Remarks')->nullable();
            $table->integer('OverTimeTypeID');
            $table->string('Status');
            $table->integer('CreatedBy');
            $table->integer('ApprovedBy')->nullable()->default(-1);
            $table->integer('UpdatedBy')->nullable()->default(-1);
            $table->timestamp('ApprovedDate')->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime');
    }
};
