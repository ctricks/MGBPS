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
        Schema::create('payroll', function (Blueprint $table) {
            $table->id();
            $table->string('PayrollKey')->unique();
            $table->string('EmployeeCode');
            $table->integer('Cutoff_id');
            $table->double('TotalWorkingDays',8,2)->nullable()->default(0.00);
            $table->double('TotalWorkingHours', 8, 2)->nullable()->default(0.00);
            $table->double('RegularOTHours', 8, 2)->nullable()->default(0.00);
            $table->double('BasicPay',8,2)->nullable()->default(0.00);
            $table->double('RegularOTPay', 8, 2)->nullable()->default(0.00);
            $table->double('SundayRestDayOT', 8, 2)->nullable()->default(0.00);
            $table->double('SRDOTExceedingHours',8,2)->nullable()->default(0.00);
            $table->double('LegalOT', 8, 2)->nullable()->default(0.00);
            $table->double('LOTExceedingHours', 8, 2)->nullable()->default(0.00);
            $table->double('SpecialNonWorkingOT',8,2)->nullable()->default(0.00);
            $table->double('SPNWExceedinHours', 8, 2)->nullable()->default(0.00);
            $table->double('DayOffLegalOT', 8, 2)->nullable()->default(0.00);
            $table->double('DOLOExceedingHours',8,2)->nullable()->default(0.00);
            $table->double('DayOffSpecialOT', 8, 2)->nullable()->default(0.00);
            $table->double('DOSOExceedingHours', 8, 2)->nullable()->default(0.00);
            $table->double('NightDiff',8,2)->nullable()->default(0.00);
            $table->double('AllowanceTaxable', 8, 2)->nullable()->default(0.00);
            $table->double('AllowanceECola', 8, 2)->nullable()->default(0.00);
            $table->double('OthersTaxable',8,2)->nullable()->default(0.00);
            $table->double('OtherNonTaxable2', 8, 2)->nullable()->default(0.00);
            $table->double('OtherNonTaxable3', 8, 2)->nullable()->default(0.00);
            $table->double('Adjustment', 8, 2)->nullable()->default(0.00);
            $table->double('Others', 8, 2)->nullable()->default(0.00);
            $table->double('Absences',8,2)->nullable()->default(0.00);
            $table->double('HalfDay', 8, 2)->nullable()->default(0.00);
            $table->double('Lates', 8, 2)->nullable()->default(0.00);
            $table->double('Undertime',8,2)->nullable()->default(0.00);
            $table->double('SSS', 8, 2)->nullable()->default(0.00);
            $table->double('PHILHEALTH', 8, 2)->nullable()->default(0.00);
            $table->double('HDMF',8,2)->nullable()->default(0.00);
            $table->double('TAX', 8, 2)->nullable()->default(0.00);
            $table->double('SSSLoans', 8, 2)->nullable()->default(0.00);
            $table->double('HDMFLoans',8,2)->nullable()->default(0.00);
            $table->double('OtherLoans', 8, 2)->nullable()->default(0.00);
            $table->string('Status')->default('For Approval');
            $table->integer('PreparedBy')->default(-1);
            $table->timestamp('PreparedDate')->nullable();
            $table->integer('ApprovedBy')->default(-1);
            $table->timestamp('ApprovedDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll');
    }
};
