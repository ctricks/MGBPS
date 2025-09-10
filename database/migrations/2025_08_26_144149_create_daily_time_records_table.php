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
        Schema::create('daily_time_records', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code');
            $table->date('date');
            $table->time('in_1')->nullable();
            $table->time('out_1')->nullable();
            $table->time('in_2')->nullable();
            $table->time('out_2')->nullable();
            $table->time('in_3')->nullable();
            $table->time('out_3')->nullable();
            $table->time('Final_IN')->nullable();
            $table->time('Final_OUT')->nullable();
            $table->time('StartTime')->nullable();
            $table->time('EndTime')->nullable();
            $table->string('DType', 100)->nullable()->default('');
            $table->double('WorkingHours',8,2)->default(0.00);
            $table->double('NightDiffHours',8,2)->default(0.00);
            $table->double('OTHours',8,2)->default(0.00);
            $table->double('Leaves',8,2)->default(0.00);
            $table->double('Absent',8,2)->default(0.00);
            $table->double('Late',8,2)->default(0.00);
            $table->double('Undertime',8,2)->default(0.00);
            $table->integer('Cutoff')->nullable()->default(-1);
            $table->timestamp('ProcessedDate')->nullable();
            $table->integer('ProcessedBy')->nullable()->default(-1);
            $table->integer('LastUpdateBy')->nullable()->default(-1);
            $table->timestamp('LastUpdateDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_time_records');
    }
};
