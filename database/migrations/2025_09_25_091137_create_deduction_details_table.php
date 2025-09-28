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
        Schema::create('deduction_details', function (Blueprint $table) {
            $table->id();
            $table->string('DeductionKey')->unique();
            $table->date('LoanDate');
            $table->string('Deduction');
            $table->integer('DeductionType')->default(-1);
            $table->double('Amount',2)->default(0.00);
            $table->double('AmountPaid',2)->default(0.00);
            $table->date('DateDeducted')->nullable();
            $table->integer('LoanReference')->default(-1);
            $table->integer('PaymentReference')->default(-1);
            $table->integer('ProcessedBy')->default(-1);
            $table->date('ProcessedDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deduction_details');
    }
};
