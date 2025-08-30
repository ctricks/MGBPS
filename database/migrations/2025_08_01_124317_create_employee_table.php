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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employeenumber')->unique();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('Address')->nullable();
            $table->string('Telephone')->nullable();
            $table->timestamp('Birthday')->nullable();
            $table->foreignId('civil_status_id')->reference('id')->on('civil_status');
            $table->foreignId('gender_id')->reference('id')->on('gender');
            $table->foreignId('position_id')->reference('id')->on('position');
            $table->foreignId('department_id')->reference('id')->on('department');
            $table->foreignId('employee_status_id')->reference('id')->on('employee_status');
            $table->integer('WorkDays')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
