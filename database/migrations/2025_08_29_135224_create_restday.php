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
        Schema::create('restday', function (Blueprint $table) {
            $table->id();
            $table->string('EmployeeCodeKey')->unique();
            $table->foreignId('employee_id')->reference('id')->on('employees');
            $table->string('RestDay');
            $table->string('Remarks')->nullable();
            $table->integer('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restday');
    }
};
