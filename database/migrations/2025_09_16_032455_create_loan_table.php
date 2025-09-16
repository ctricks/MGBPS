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
        Schema::create('loan', function (Blueprint $table) {
            $table->id();
            $table->string('Employeecode');
            $table->integer('Loantype');
            $table->date('LoanDate');
            $table->decimal('Amount', 5, 2)->default(0.00);
            $table->integer('NoOfPayment');
            $table->decimal('AmountDeduction', 5, 2)->default(0.00);
            $table->decimal('SemiMonthlyInterest', 5, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan');
    }
};
