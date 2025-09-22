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
            $table->integer('EmployeeID');
            $table->timestamp('ActualIN');
            $table->timestamp('ActualOUT');
            $table->decimal('ActualOTHours');
            $table->decimal('OTHoursApproved');
            $table->string('Remarks');
            $table->integer('OverTimeTypeID');
            $table->integer('CreatedBy');
            $table->integer('ApprovedBy')->default(-1);
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
