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
        Schema::create('sssreference', function (Blueprint $table) {
            $table->id();
            $table->decimal('StartRangeComp', 19, 2)->default(0.00);
            $table->decimal('EndRangeComp', 19, 2)->default(0.00);
            $table->decimal('EC', 9, 2)->nullable()->default(0.00);
            $table->decimal('MPF', 9, 2)->nullable()->default(0.00);
            $table->decimal('MSCTOTAL', 9, 2)->nullable()->default(0.00);
            $table->decimal('EMPLOYERREGSSS', 9, 2)->nullable()->default(0.00);
            $table->decimal('EMPLOYERMPF', 9, 2)->nullable()->default(0.00);
            $table->decimal('EMPLOYEREC', 9, 2)->nullable()->default(0.00);
            $table->decimal('EMPLOYERTOTAL', 9, 2)->nullable()->default(0.00);
            $table->decimal('EMPLOYEEREGSS', 9, 2)->nullable()->default(0.00);
            $table->decimal('EMPLOYEEMPF', 9, 2)->nullable()->default(0.00);
            $table->decimal('EMPLOYEETOTAL', 9, 2)->nullable()->default(0.00);
            $table->decimal('TOTAL', 9, 2)->nullable()->default(0.00);
            $table->integer('CreatedBy')->nullable()->default(-1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sssreference');
    }
};
