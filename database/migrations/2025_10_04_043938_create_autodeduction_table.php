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
        Schema::create('autodeduction', function (Blueprint $table) {
            $table->id();
            $table->string('autodeductionkey')->unique();
            $table->string('EmployeeCode');
            $table->date('AD_Date');
            $table->string('DeductionName');
            $table->decimal('Amount', 5, 2)->nullable()->default(0.00);
            $table->decimal('PaidAmount',5,2)->nullable()->default(0.00);
            $table->date('DateProcess')->nullable();
            $table->integer('ProcessedBy')->nullable()->defaul(-1);
            $table->string('Remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autodeduction');
    }
};
