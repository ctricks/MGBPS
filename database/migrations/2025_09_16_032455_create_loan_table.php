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
            $table->integer('EmployeeID');
            $table->integer('Loantype');
            $table->timestamp('LoanDate');
            $table->decimal('Amount', 9, 2)->default(0.00);
            $table->integer('NoOfPayment');
            $table->decimal('AmountDeduction', 9, 2)->default(0.00);
            $table->decimal('SemiMonthlyInterest', 9, 2)->default(0.00);
            $table->decimal('TotalInterest', 9, 2)->default(0.00);
            $table->decimal('InterestBalance', 9, 2)->default(0.00);
            $table->decimal('Balance', 9, 2)->default(0.00);
            $table->string('Status')->default('New');
            $table->integer('ApprovedBy')->default(-1);
            $table->timestamp('ApprovedDate')->nullable();
            $table->integer('CreatedBy')->default(-1);
            $table->integer('isActive')->default(1);
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
