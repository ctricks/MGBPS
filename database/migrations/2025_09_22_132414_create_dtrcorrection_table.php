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
        Schema::create('dtrcorrection', function (Blueprint $table) {
            $table->id();
            $table->string('dtrcorrectionkey')->unique();
            $table->string('employeecode');
            $table->date('date');
            $table->time('IN');
            $table->time('OUT');
            $table->string('DType');
            $table->string('Remarks');
            $table->integer('CreatedBy');
            $table->integer('ApprovedBy')->default(-1);
            $table->timestamp('ApprovedDate')->nullable();
            $table->integer('UpdatedBy')->default(-1);
            $table->string('Status')->default('For Approval');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtrcorrection');
    }
};
